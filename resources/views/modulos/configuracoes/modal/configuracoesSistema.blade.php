<?php 
$dadosModal = [];
$dadosModal['id'] =  'modalConfiguracoes';
$dadosModal['url'] = '/configuracoes/cadastrarEditarDadosClinica';

$dadosModal['dadosClinica'] = isset($config)?$config->endereco:'SoulFisio - Clinica de Prevenção, Promoção e Reabilitação em Saúde.<br>Rua das Palmeiras, 302, Centauro, Eunápolis-Bahia<br>Tel: 73 3512-5665';


$dadosModal['CNES'] = isset($config)?$config->CNES:'';

$dadosModal['estalecimento'] = isset($config)?$config->estalecimento:'';

$dadosModal['titulo'] = 'Configurações do Sistema';

?>
<div class="modal" tabindex="-1" role="dialog" id="{{$dadosModal['id']}}">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title">{{$dadosModal['titulo']}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{$dadosModal['url']}}" method="post"  enctype="multipart/form-data">
				<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				
				<div class="modal-body">
					<div class="row">
						<div class="col-4">
							<label>Logo da Prefeitura</label>
							<input type="file" name="logoPrefeitura">
						</div>
						<div class="col-3">
							<img src="/imagens/logo.png" style="width: 203px;height: 61px;">
						</div>
						
						<div class="col-12">
							<label>Estalecimento(guia)</label>
							<textarea class="form-control" name="estalecimento">{{$dadosModal['estalecimento']}}</textarea>
						</div>
						<div class="col-12">
							<label>Dados da Clinica(Prontuario)</label>
							<textarea class="form-control" name="dadosClinica">{{$dadosModal['dadosClinica']}}</textarea>
						</div>
						<div class="col-4">
							<label>CNES</label>
							<input type="text"  name="CNES" class="form-control" value="{{$dadosModal['CNES']}}">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" name="cadastrar" class="btn btn-primary">Salvar</button>
				</div>

			</form>
		</div>
	</div>
</div>