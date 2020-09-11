<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\atendimentos as objeto;
use Session;
use Auth;
class Atendimentos extends Controller
{
	protected $campos = ['data','cliente-id'];
	public function cadastrarEditar($id = 0, Request $request)
	{
		if (isset($request['cadastrar'])) {
			if ($id == 0) {
				$objeto = new objeto;
			}else{
				$objeto = objeto::find($id);
			}
			foreach ($this->campos as $key => $campo) {
				$objeto[$campo] = isset($request[$campo])?$request[$campo]:null;
			}
			if ($objeto->save()) {
				Session::flash('message', ['text'=>'Salvo com sucesso', 'tipo' => 'sucesso']);
			}else{
				Session::flash('message', ['text'=>'Erro ao salvar', 'tipo' => 'erro']);
			} 

		}

		return redirect()->back();
	}
	public function excluir($id)
	{
		$objeto = objeto::find($id);
		if ($objeto->delete()) {
			Session::flash('message', ['text'=>'Excluido com sucesso', 'tipo' => 'sucesso']);
		}else{
			Session::flash('message', ['text'=>'Erro ao excluir', 'tipo' => 'erro']);
		} 
		return redirect()->back();
	}
	public function gerarExibirPeca($exibir = false,Request $request)
	{
		$title = 'relaatendimento';

		$objetos = \App\guia::whereMonth('dataFeita',$request['mes'])->whereYear('dataFeita',$request['ano'])->orderBy('dataFeita','desc')->get();
		$meses = array(
			1 => 'Janeiro',
			'Fevereiro',
			'Março',
			'Abril',
			'Maio',
			'Junho',
			'Julho',
			'Agosto',
			'Setembro',
			'Outubro',
			'Novembro',
			'Dezembro'
		);
		$titulo = 'CLINICA SOULFISIO ATENDIMENTOS '.strtoupper($meses[$request['mes']]).'/'.$request['ano'];

		$campos = [];
		foreach ($objetos as $key => $guia) {
			$chave = $guia->paciente->nome.'-'.$guia->paciente->id.'-'.$guia->id;
				if ($guia->qtdSessoesRealizado1!=0) {
					$campos[$chave.'1'] = [
						'id'=>$guia->id
						,'autorizacao'=>$guia->dataFormatada()
						,'sus'=>$guia->paciente->CNS
						,'total'=>$guia->qtdSessoesRealizado1
						,'nome'=>$guia->paciente->nome
						,'procedimento'=> $guia->procedimentoSolicitado1
						,'chave'=>$guia->chave
					];
				}
				if ($guia->qtdSessoesRealizado2!=0) {
					$campos[$chave.'2'] = [
						'id'=>$guia->id
						,'autorizacao'=>$guia->dataFormatada()
						,'sus'=>$guia->paciente->CNS
						,'total'=>$guia->qtdSessoesRealizado2
						,'nome'=>$guia->paciente->nome
						,'procedimento'=> $guia->procedimentoSolicitado2
						,'chave'=>$guia->chave
					];
				}
				if ($guia->qtdSessoesRealizado3!=0) {
					$campos[$chave.'3'] = [
						'id'=>$guia->id
						,'autorizacao'=>$guia->dataFormatada()
						,'sus'=>$guia->paciente->CNS
						,'total'=>$guia->qtdSessoesRealizado3
						,'nome'=>$guia->paciente->nome
						,'procedimento'=> $guia->procedimentoSolicitado3
						,'chave'=>$guia->chave
					];
				}




		}
		ksort($campos);
		$dados = [];
		foreach ($campos as $key => $value) {
			$dados[] = $value;
		}
//dd($campos);
		$pecas = array(
			'data' => array(
				'variaveis' => array(
					'id'=>'relatorioatendimentos'
					,'pasta' =>(string)  $title.'/'.Auth::user()->id
					,'titulo'=>$titulo
					,'campos'=> $dados
				)
			)
		);

		return \App\Http\Controllers\imprimir::jasper($title,$pecas,true);
	}
}
