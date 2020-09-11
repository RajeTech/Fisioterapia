<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\prontuario as objeto;
use Session;
use App\prontuarioServicos;
class Prontuario extends Controller
{
	protected $campos = ['chave','cid','quadroClinico','avaliacao','observacoes','cliente-id'];

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
			$resul = $objeto->save();
			$listadatas = [];
			foreach ($objeto->datas as $key => $value) {
				$listadatas[$value->id] = $value->id;
			}

			if (isset($request['prontuarioDatas'])) {
				foreach ($request['prontuarioDatas'] as $key => $prontDat) {
					if (isset($prontDat['id'])) {
						$id = $prontDat['id'];

						if(in_array($id, $listadatas)) unset($listadatas[$id]);

						$prontServ = prontuarioServicos::find($prontDat['id']);
					}else{
						$prontServ = new prontuarioServicos();
						$prontServ['prontuario-id'] = $objeto->id;
					}
				//	$prontServ['descricao'] = $prontDat['descricao'];

					$prontServ['data'] = $prontDat['data'];
					$prontServ->save();
				}
			}
			foreach ($listadatas as $key => $value) {
				$prontServ = prontuarioServicos::find($value);
				$prontServ->delete();
			}


			if ($resul) {
				Session::flash('message', ['text'=>'Prontuario salvo com sucesso', 'tipo' => 'sucesso']);
			}else{
				Session::flash('message', ['text'=>'Erro ao salvar Prontuario', 'tipo' => 'erro']);
			} 
		}
		return redirect()->back();
	}
		public function salvarDescricao($id,Request $request)
	{
		$prontServ = prontuarioServicos::find($id);
		$prontServ['descricao'] = $request['descricao'];
		echo json_encode(['resultado'=>$prontServ->save()]);
	}
	public function gerarExibirPeca($id,$exibir = false)
	{
		$title = 'prontuario';

		$objeto = objeto::find($id);
		$datas = '';
		
		foreach ($objeto->datas as $key => $value) {
			$datas .= ($key+1).'. '.((string) $value->data!=''? date('d/m/Y', strtotime($value->data)) :'').'<br>'.$value->descricao.'<br><br>';
		}

		$pecas = array(
			'data' => array(
				'variaveis' => array(
					'id'=>(string)$id,
					'pasta' =>  $title.'/'.$id,
					'datanascimento'=> (string) $objeto->paciente->DTnascimento!=''? date('d/m/Y', strtotime($objeto->paciente->DTnascimento)) :'',
					'cns'=>(string)$objeto->paciente->CNS,
					'chave'=>(string)$objeto->chave,
					'quadroclinico'=>(string)$objeto->quadroClinico,
					'acompanhante'=>(string) $objeto->paciente->acompanhante,
					'CID'=>(string)$objeto->cid,
					'datas'=>(string)$datas,
					'procedimentosolicitado'=>(string)$objeto->procedimentoSolicitado(),
					'tipoassistencia'=>(string)$objeto->tipoassistencia(),
					'medicosolicitante'=>(string)$objeto->medicosolicitante(),
					'dataautorizacao'=>(string)$objeto->dataFormatada(),
					'avaliacao'=>(string)$objeto->avaliacao(),
					'cpf'=>(string)$objeto->paciente->CPF,
					'telefone'=>(string)$objeto->paciente->telefone,
					'nome'=> (string)$objeto->paciente->nome,
					'endereco'=>(string)$objeto->paciente->ruaEndereco.', '.$objeto->paciente->numeroEndereco.', '.$objeto->paciente->bairroEndereco.', '.$objeto->paciente->cidadeEndereco,
					'dadosClinica'=>(string) Controller::config()->endereco
				)
			)
		);
		return \App\Http\Controllers\imprimir::jasper($title,$pecas,$exibir);
	}
	public function index()
	{
		$objetos = objeto::orderBy('id','desc');

		if (isset($request['filtro'])) {
			$objetos->where('nome','LIKE','%'.$request['filtro'].'%')->orwhere('CPF','LIKE','%'.$request['filtro'].'%')->orwhere('RG','LIKE','%'.$request['filtro'].'%');
		}
		$objetos = $objetos->paginate(10);
		return view('modulos.prontuario.index',compact('objetos'));
	}
	public function cadastrarEditarPagina()
	{
		return view('home');
	}
	public function cadastrarEditarFuncao()
	{
		return view('home');
	}
	public function excluir($id)
	{
		$objeto = objeto::find($id);
		if ($objeto->delete()) {
			Session::flash('message', ['text'=>'Prontuario deletado com sucesso', 'tipo' => 'sucesso']);
		}else{
			Session::flash('message', ['text'=>'Erro ao deletar prontuario', 'tipo' => 'erro']);
		} 
		return redirect()->back();
	}
}
