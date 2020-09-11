<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as objeto;
use Session;
use DB;
use App\configuracoes as config;
class Configuracoes extends Controller
{
	protected $campos = ['name','email'];
	public function index()
	{
		$config = config::find(1);
		$usuarios = \App\User::all();
		return view('modulos.configuracoes.index',compact('usuarios','config'));
	}
	public function buscaRapida($tipo,Request $request)
	{
		switch ($tipo) {
			case 'cliente':
			$clientes = \App\clientes::where('nome','LIKE','%'.$request['valor'].'%')
			->orwhere('CPF','LIKE','%'.$request['valor'].'%')->get();
			echo json_encode($clientes);
			break;
			case 'medico':
			$clientes = \App\guia::select('medicoSolicitante')->where('medicoSolicitante','LIKE','%'.$request['valor'].'%')->groupby('medicoSolicitante')->get();
			echo json_encode($clientes);
			break;

			case 'profissionalexecutante':
			$clientes = \App\guia::select('nomeProfissional','tipodocumentoProfissional','documentoProfissional')
			->where('nomeProfissional','LIKE','%'.$request['valor'].'%')
			->get();
			//$clientes = array_unique($clientes);

			echo json_encode($clientes);
			break;
			default:
				# code...
			break;
		}
	}
	public function cadastrarEditarUsuario($id = 0, Request $request)
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
			if (isset($request['password']) && $request['password'] != "") {
				if($request['password'] != ( isset($request['confirmpassword'])?$request['confirmpassword']:'' ) ){

					Session::flash('message', ['text'=>'Erro ao Salvar! Repita a senha corretamente', 'tipo' => 'erro']);

					return redirect()->back();
				}else{
					$objeto['password'] = bcrypt($request['password']);	
				}

			}

			if ($objeto->save()) {
				Session::flash('message', ['text'=>'Salvo com sucesso', 'tipo' => 'sucesso']);
			}else{
				Session::flash('message', ['text'=>'Erro ao salvar', 'tipo' => 'erro']);
			} 

		}

		return redirect()->back();
	}
	public function deletarUsuario($id)
	{
		$objeto = objeto::find($id);
		
		if ($objeto->delete()) {
			Session::flash('message', ['text'=>'Excluido com sucesso', 'tipo' => 'sucesso']);
		}else{
			Session::flash('message', ['text'=>'Erro ao excluir', 'tipo' => 'erro']);
		} 
	}
	public function cadastrarEditarDadosClinica(Request $request)
	{
		$config = config::find(1);
		$config['endereco'] = isset($request['dadosClinica'])?$request['dadosClinica']:''; 
		$config['CNES'] = isset($request['CNES'])?$request['CNES']:'';
		$config['estalecimento'] = isset($request['estalecimento'])?$request['estalecimento']:'';
		
		$config->save();

		if ($request->hasFile('logoPrefeitura')) {

			$destino = public_path('/imagens/logo.png');
			$arquivo_tmp = $_FILES['logoPrefeitura']['tmp_name'];
			move_uploaded_file( $arquivo_tmp, $destino  );

		}
		//dd($request);
		Session::flash('message', ['text'=>'Salvo com sucesso', 'tipo' => 'sucesso']);
		return redirect()->back();
	}
}
