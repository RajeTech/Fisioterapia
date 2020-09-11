<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\guia as objeto;
use Session;
class GuiasFisioterapia extends Controller
{
	protected $campos = ['dataFeita','chave','dataAutorizacao','CNES','medicoSolicitante','tipoAssitencia','procedimentoSolicitado1','inicial1','competencia1','qtdRealizado1','qtdSessoesRealizado1','procedimentoSolicitado2','inicial2','competencia2','qtdRealizado2','qtdSessoesRealizado2','procedimentoSolicitado3','inicial3','competencia3','qtdRealizado3','qtdSessoesRealizado3','justificativa','observacoes','nomeSolicitante','cpfSolicitante','cpfCnsSolicitante','cliente-id','nomeProfissional','tipodocumentoProfissional','documentoProfissional','numeroProntuario','chave2','dataAutorizacao2'];
	public function index()
	{
		$objetos = objeto::orderBy('id','desc');

		if (isset($request['filtro'])) {
			$objetos->where('nome','LIKE','%'.$request['filtro'].'%')->orwhere('CPF','LIKE','%'.$request['filtro'].'%')->orwhere('RG','LIKE','%'.$request['filtro'].'%');
		}
		$objetos = $objetos->paginate(10);
		return view('modulos.guias.index',compact('objetos'));
	}
	public static function mascara($val, $mask)
	{
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{

				if(isset($val[$k]))

					$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}
	public function cadastrarEditarPagina()
	{
		return view('home');
	}
	public function gerarExibirPeca($id,$exibir = false,$segundavia = false)
	{
		if ($segundavia) {
			$title = 'guiasus2';
		}else{
			$title = 'guiasus';
		}
		
		$objeto = objeto::find($id);
//__|__|__|__|__|__|__|__|__|__|__
		//
		//"(  ) 2ª Competência<br> (  ) 3ª Competência <br> (  ) 4ª Competência"
		//
		//"1-|__|__|/|__|__|/|__|__| ____________________________________________"

		$inicial1 = '( '.($objeto->inicial1==1?'X':'').' ) Inicial<br>( '.((string)$objeto->inicial1!='' && $objeto->inicial1==0?'X':'').' ) Continuidade';
		$inicial2 = '( '.($objeto->inicial2==1?'X':'').' ) Inicial<br>( '.((string)$objeto->inicial2!='' && $objeto->inicial2==0?'X':'').' ) Continuidade';
		$inicial3 = '( '.($objeto->inicial3==1?'X':'').' ) Inicial<br>( '.((string)$objeto->inicial3!='' && $objeto->inicial3==0?'X':'').' ) Continuidade';

		$competencia1 = '( '.($objeto->competencia1==2?'X':'').' ) 2ª Competência  ( '.($objeto->competencia1==3?'X':'').' ) 3ª Competência <br> ( '.($objeto->competencia1==4?'X':'').' ) 4ª Competência';

		$competencia2 = '( '.($objeto->competencia2==2?'X':'').' ) 2ª Competência';

		$competencia3 = '( '.($objeto->competencia3==2?'X':'').' ) 2ª Competência';

		$tipodocumentoexecutante = '( '.($objeto->tipodocumentoProfissional=='CNS'?'X':'').' ) CNS       ( '.($objeto->tipodocumentoProfissional=='CPF'?'X':'').' ) CPF';

		$pecas = array(
			'data' => array(
				'variaveis' => array(
					'id'=>$id
					,'numerodocumentoexecutante'=>(string)$objeto->documentoProfissional
					,'tipodocumentoexecutante'=>(string)$tipodocumentoexecutante
					,'nomeprofissionalexecutante'=>(string)$objeto->nomeProfissional
					,'justificativa'=>(string)$objeto->justificativa
					,'qtdsessoesrealizadas2'=>(string)$objeto->qtdSessoesRealizado2
					,'qtdsessoesrealizadas3'=>(string)$objeto->qtdSessoesRealizado3
					,'qtdsessoesrealizadas1'=>(string)$objeto->qtdSessoesRealizado1
					,'qtdrealizadaultima1'=>(string)$objeto->qtdRealizado1
					,'qtdrealizadaultima3'=>(string)$objeto->qtdRealizado3
					,'qtdrealizadaultima2'=>(string)$objeto->qtdRealizado2
					,'competencia1'=>(string)$competencia1
					,'competencia3'=>(string)$competencia3
					,'competencia2'=>(string)$competencia2
					,'inicial3'=>(string)$inicial3
					,'inicial1'=>(string)$inicial1
					,'inicial2'=>(string)$inicial2
					,'procedimentoSolicitado1'=>(string)$objeto->procedimentoSolicitado1
					,'procedimentoSolicitado3'=>(string)$objeto->procedimentoSolicitado3
					,'procedimentoSolicitado2'=>(string)$objeto->procedimentoSolicitado2
					,'dataNascimento'=>(string)$objeto->paciente->dataFormatada()
					,'sexo'=>(string)$objeto->paciente->sexo
					,'endereco'=>(string)(string)$objeto->paciente->ruaEndereco.', '.$objeto->paciente->numeroEndereco. ', '.$objeto->paciente->bairroEndereco
					,'municipio'=>(string) $objeto->paciente->cidadeEndereco
					,'numeroProntuario'=>(string)$objeto->numeroProntuario
					,'telefoneContato'=>(string)$objeto->paciente->telefone
					,'nomePessoa'=>(string)$objeto->paciente->nome
					,'nomeResponsavel'=>(string)$objeto->paciente->acompanhante
					,'numerosus'=>(string)$this->mascara($objeto->paciente->CNS, '# # # # # # # # # # # # # # #')
					,'CNES'=>(string)Controller::config()->CNES
					,'tipoAssitencia'=>(string)$objeto->tipoAssitencia
					,'dataautorizacao2'=>(string)$objeto->dataFormatada2()
					,'dataAutorizacao1'=>(string)$objeto->dataFormatada()
					,'observacoes'=>(string)$objeto->observacoes
					,'chaveAutorizacao1'=>(string)$objeto->chave
					,'chaveAutorizacao2'=>(string)$objeto->chave2
					,'estabelecimento'=>(string)Controller::config()->estalecimento
					,'medico'=>(string)$objeto->medicoSolicitante
					,'pasta' =>(string)  $title.'/'.$id
					,'img'=>public_path('/imagens/logo.png')
				)
			)
		);
		return \App\Http\Controllers\imprimir::jasper($title,$pecas,$exibir);
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
			$objeto->save();

			if ($request->hasFile('guiafisioterapia')){
				$nome = $_FILES['guiafisioterapia']['name'];
				$destino = public_path('/guiafisioterapia/'.$objeto->id.'/'.$nome );
				$arquivo_tmp = $_FILES['guiafisioterapia']['tmp_name'];
				move_uploaded_file( $arquivo_tmp, $destino );
				$objeto->guiafisioterapiaUpload = $nome;
			}

			if ($objeto->save()) {
				Session::flash('message', ['text'=>'Guia salvo com sucesso', 'tipo' => 'sucesso']);
			}else{
				Session::flash('message', ['text'=>'Erro ao salvar Guia', 'tipo' => 'erro']);
			} 

		}

		return redirect()->back();
	}
	public function excluir($id)
	{
		$objeto = objeto::find($id);
		if ($objeto->delete()) {
			Session::flash('message', ['text'=>'Guia deletada com sucesso', 'tipo' => 'sucesso']);
		}else{
			Session::flash('message', ['text'=>'Erro ao deletar Guia', 'tipo' => 'erro']);
		} 
		return redirect()->back();
	}
}
