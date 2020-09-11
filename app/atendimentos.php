<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atendimentos extends Model
{
    
	public function paciente(){
		return $this->hasOne('App\clientes','id','cliente-id');
	}
	public function dataFormatada()
	{
		return date("d/m/Y", strtotime($this->data));
	}
}
