<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\clientes as objeto;

use Session;
class Pacientes extends Controller
{
	protected $campos = ['nome','CPF','RG','CNS','telefone','DTnascimento','ruaEndereco','bairroEndereco','numeroEndereco','cidadeEndereco','sessoes','acompanhante','sexo'];
	public function index(Request $request)
	{
		$objetos = objeto::orderBy('id','desc');

		if (isset($request['filtro'])) {
			$objetos->where('nome','LIKE','%'.$request['filtro'].'%')->orwhere('CPF','LIKE','%'.$request['filtro'].'%')->orwhere('RG','LIKE','%'.$request['filtro'].'%');
		}
		$objetos = $objetos->paginate(20);
		return view('modulos.pacientes.index',compact('objetos'));
	}
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
				Session::flash('message', ['text'=>'Cliente salvo com sucesso', 'tipo' => 'sucesso']);
			}else{
				Session::flash('message', ['text'=>'Erro ao salvar cliente', 'tipo' => 'erro']);
			} 

		}

		return redirect()->back();
	}

	public function paginaPaciente($id = 0, Request $request)
	{
		$paciente = objeto::find($id);
		
		return view('modulos.pacientes.paginaPaciente',compact('paciente'));
	}

	public function excluir($id)
	{
		$objeto = objeto::find($id);
		if ($objeto->delete()) {
			Session::flash('message', ['text'=>'Cliente excluido com sucesso', 'tipo' => 'sucesso']);
		}else{
			Session::flash('message', ['text'=>'Erro ao excluir cliente', 'tipo' => 'erro']);
		} 
		return redirect()->back();
	}
}
