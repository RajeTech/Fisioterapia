<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
	public function guias(){
		return $this->hasMany('App\guia','cliente-id')->orderby('id','desc');
	}
	public function prontuarios(){
		return $this->hasMany('App\prontuario','cliente-id')->orderby('id','desc');
	}
	public function datas(){
		return $this->hasMany('App\atendimentos','cliente-id')->orderby('data','desc');
	}
	public function dataAutorizacaoPronturario()
	{
		$guia = guia::where('cliente-id',$this->id)->orderby('id','desc')->first();

		if ($guia!=null) {
			return $guia->dataAutorizacao;
		}else{
			return date('Y-m-d');
		}
	}
	public function guiachave()
	{
		$guia = guia::where('cliente-id',$this->id)->orderby('id','desc')->first();

		return $guia !=null?$guia->chave:'';
	}
	public function historicoProcedimentos()
	{
		$guia = guia::where('cliente-id',$this->id)->orderby('id','desc')->first();

		$procedimento = '';
		if ($guia!=null) {

			if ($guia->procedimentoSolicitado1 != "") {
				$procedimento .= $guia->procedimentoSolicitado1;
				$guiatext = guia::where('chave',$guia->chave)->where('inicial1',1)->first();

				if ($guiatext!=null) {
					$procedimento .= ' INICIAL - <b>'.$guiatext->qtdSessoesRealizado1.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia1',2)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 2º Comp.  <b>'.$guiatext->qtdSessoesRealizado1.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia1',3)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 3º Comp.  <b>'.$guiatext->qtdSessoesRealizado1.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia1',4)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 4º Comp.  <b>'.$guiatext->qtdSessoesRealizado1.'</b>';
				}

				$procedimento .='<br>';
			}
			if ($guia->procedimentoSolicitado2 != "") {
				$procedimento .= $guia->procedimentoSolicitado2;
				$guiatext = guia::where('chave',$guia->chave)->where('inicial2',1)->first();

				if ($guiatext!=null) {
					$procedimento .= ' INICIAL - <b>'.$guiatext->qtdSessoesRealizado2.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia2',2)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 2º Comp.  <b>'.$guiatext->qtdSessoesRealizado2.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia2',3)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 3º Comp.  <b>'.$guiatext->qtdSessoesRealizado2.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia2',4)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 4º Comp.  <b>'.$guiatext->qtdSessoesRealizado2.'</b>';
				}

				$procedimento .='<br>';
			}
			if ($guia->procedimentoSolicitado3 != "") {
				$procedimento .= $guia->procedimentoSolicitado3;
				$guiatext = guia::where('chave',$guia->chave)->where('inicial3',1)->first();

				if ($guiatext!=null) {
					$procedimento .= ' INICIAL - <b>'.$guiatext->qtdSessoesRealizado3.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia3',2)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 2º Comp.  <b>'.$guiatext->qtdSessoesRealizado3.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia3',3)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 3º Comp.  <b>'.$guiatext->qtdSessoesRealizado3.'</b>';
				}

				$guiatext = guia::where('chave',$guia->chave)->where('competencia3',4)->first();

				if ($guiatext!=null) {
					$procedimento .= ' / 4º Comp.  <b>'.$guiatext->qtdSessoesRealizado3.'</b>';
				}

				$procedimento .='<br>';
			}
		}


		return $procedimento;

	}

	public function datasMes()
	{
		$campos = [];
		foreach ($this->datas as $key => $data) {
			$mesAno = date("m/Y", strtotime($data->data));
			$campos[$mesAno][] = $data;
		}
		foreach ($campos as $mesAno => $value) {
			$ano = date("Y", strtotime($mesAno));
			$mes = date("m", strtotime($mesAno));
			$guia = guia::whereMonth('dataAutorizacao',$mes)->whereYear('dataAutorizacao',$ano)->first();

		}
		//dd($campos);

		/*
		<span class="badge badge-warning">Faltam 0</span>
               <span class="badge badge-success">Disponiveis 0</span>
               <span class="badge badge-secondary">Contador 0</span>
		*/
           }
           public function dataFormatada()
           {
           	return date("d/m/Y", strtotime($this->DTnascimento));
           }
       }
