<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JasperPHP\JasperPHP as JasperPHP;
use Exception;
use Session;
use Storage;
use Artisan;
class imprimir extends Controller
{
	public static function pdf($pasta,$pdf,Request $request)
	{
		$file = public_path()."/".$pasta.'/'.$pdf;

		if (!file_exists($file))
			return "Arquivo não existe, tente novamente! ";

		$file = explode('public', $file);
		return redirect($file[1]."?idvariou=".mt_rand ());

	}
	public static function exibir($arquivo,$variaveis,$url = false){

		$arquivo = strtolower($arquivo);

		$util = new util($variaveis,$arquivo);
		
		if($url) return $util->criarNomeArquivo();

		$output = $util->gerarUrl();
		$request = isset($_GET)?$_GET:[];

		if (isset($request['tipo']) && $request['tipo']=='html') {
			
			$file = $output . '.html';
			if (!file_exists($file))
				return "Arquivo não existe, tente novamente! ".$arquivo;

			$file = explode('public', $file);

			return redirect($file[1]."?idvariou=".mt_rand ());

		}else{

			$file = $output . '.pdf';
			if (!file_exists($file))
				return "Arquivo não existe, tente novamente! ".$arquivo;

			$file = explode('public', $file);
			return redirect($file[1]."?idvariou=".mt_rand ());

		}
	}
	public static function jasper($arquivo,$dadosVariaveis,$exibir=false) {
		$report = new JasperPHP;
		$principal_path = public_path()."/MyReports";
		//dd($salvar);
		$arquivo = strtolower($arquivo);
		//$arquivo = 'teste';
		$input = $principal_path."/$arquivo.jrxml";

		$output = public_path().'/'.$dadosVariaveis['data']['variaveis']['pasta'].'/';
		
		if (!is_dir($output)) {
			
			mkdir($output, 0777, true);
		}
		$output = public_path().'/'.$dadosVariaveis['data']['variaveis']['pasta'].'/'.$arquivo.'';
		
		$file = $output.'.pdf';
		$pasta = '';

//dd($nomeArquivo);
		$json = $output.'.json';
		//dd($json);
// PDF, XLS, DOC, RTF, ODF, etc.
	
		$format = array('pdf');

//dd($output);	
		$parametros = array();
// Cria o arquivo json
		$dados_json = json_encode($dadosVariaveis);
		//dd($dados_json);
// O parâmetro "a" indica que o arquivo será aberto para escrita
		$fp = fopen($json, "a");
// Escreve o conteúdo JSON no arquivo
		$escreve = fwrite($fp, $dados_json);
// Fecha o arquivo
		fclose($fp);

		$banco =  array(
			'username'=>'meujson',
			'data_file' => $json, 
			'driver' => 'json', 
			'json_query' => 'data.variaveis');


		$resposta = $report->process($input, $output, $format, $parametros, $banco)->execute();

		$file = $output . '.pdf';
		$path = $file;
	
		try {
        // caso o arquivo não tenha sido gerado retorno um erro 404
			if (!file_exists($file)) {
//dd($resposta);
				dd("nao existe ".$file);
				throw new Exception('Erro ao tentar gerar arquivo.');
			}


//caso tenha sido gerado pego o conteudo

			unlink($json);
		} catch (Exception $e) {	
			if (file_exists($path))
				unlink($path);

			if (file_exists($json))
				unlink($json);
			echo '<pre>';
			var_dump($e);
			echo '</pre>';
			return "Erro ao criar arquivo";
		}



		if ($exibir) {
			$file = explode('public', $file);
			return redirect($file[1]."?idvariou=".mt_rand ());
		}
		return true;
	}
}
