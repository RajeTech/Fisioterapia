<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guia extends Model
{
	public function paciente(){
		return $this->hasOne('App\clientes','id','cliente-id');
	}
	
	public function dataFormatada()
	{
		if($this->dataAutorizacao!="")
			return date("d/m/Y", strtotime($this->dataAutorizacao));
		else
			return "";
	}
	public function dataFormatada2()
	{
		if($this->dataAutorizacao2!="")
			return date("d/m/Y", strtotime($this->dataAutorizacao2));
		else
			return "";
	}
	public function procedimentoSolicitado()
	{
		if ($this->procedimentoSolicitado1 != "") {
			$procedimento = $this->procedimentoSolicitado1;
		}
		if ($this->procedimentoSolicitado2 != "") {
			if($procedimento!="")$procedimento.=" / ";

			$procedimento = $this->procedimentoSolicitado1;
		}
		if ($this->procedimentoSolicitado3 != "") {
			if($procedimento!="")$procedimento.=" / ";
			
			$procedimento .= $this->procedimentoSolicitado3;
		}
		return $procedimento;
	}
	public function qtdSessoesRealizado()
	{
		$guiaOrdem = guia::where('chave',$this->chave)->where('id','<=',$this->id)->orderby('id','desc')->count();
		$procedimento = '';
		switch ($guiaOrdem) {
			case 1:
			$procedimento = $this->qtdSessoesRealizado1;
			break;
			case 2:
			$procedimento = $this->qtdSessoesRealizado2;
			break;
			case 3:
			$procedimento = $this->qtdSessoesRealizado3;
			break;
				case 4:
			$procedimento = $this->qtdSessoesRealizado1;
			break;
		}
		return $procedimento;

	}
	public function procedimentoSolicitadoGuia()
	{
		$guiaOrdem = guia::where('chave',$this->chave)->where('id','<=',$this->id)->orderby('id','desc')->count();
		$procedimento = '';
		switch ($guiaOrdem) {
			case 1:
			$procedimento = $this->procedimentoSolicitado1;
			break;
			case 2:
			$procedimento = $this->procedimentoSolicitado2;
			break;
			case 3:
			$procedimento = $this->procedimentoSolicitado3;
			break;
				case 4:
			$procedimento = $this->procedimentoSolicitado1;
			break;
		}
		return $procedimento;
	}
}
