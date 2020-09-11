<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prontuario extends Model
{
    //prontuario-id
	public function datas(){
		return $this->hasMany('App\prontuarioServicos','prontuario-id');
	}
	public function paciente(){
		return $this->hasOne('App\clientes','id','cliente-id');
	}	
	public function guia()
	{
		return guia::where('chave',$this->chave)->first();
	}
	public function dataFormatada()
	{
		if ($this->guia()!=null) {
			return date("d/m/Y", strtotime($this->guia()->dataAutorizacao));
		}
		return '';
	}
	public function procedimentoSolicitado()
	{
		$procedimento = '';
		if ($this->guia()->procedimentoSolicitado1 != "") {
			$procedimento = $this->guia()->procedimentoSolicitado1;
		}
		if ($this->guia()->procedimentoSolicitado2 != "") {
			if($procedimento!="")$procedimento.=" / ";

			$procedimento .= $this->guia()->procedimentoSolicitado2;
		}
		if ($this->guia()->procedimentoSolicitado3 != "") {
			if($procedimento!="")$procedimento.=" / ";
			
			$procedimento .= $this->guia()->procedimentoSolicitado3;
		}
		return $procedimento;
	}
	public function ultimaData()
	{
		$datas = $this->datas;
		if ( count($datas)>0 ) {
			$data = $datas[count($datas)-1];
			if($data->data !=null) return  date("d/m/Y", strtotime($data->data));
			
		}
		return '';
	}
	public function tipoassistencia()
	{
		if ($this->guia()!=null) {
			return ($this->guia()->tipoAssitencia);
		}
		return '';
	}
	public function medicosolicitante()
	{
		if ($this->guia()!=null) {
			return ($this->guia()->medicoSolicitante);
		}
		return '';
	}

	public function avaliacao()
	{
		if ($this->guia()!=null) {
			return ($this->guia()->justificativa);
		}
		return '';
	}


}
