<?php 
$dadosModal = [];
$dadosModal['id'] =  'modalusuario';
$dadosModal['url'] = isset($prontuario)?'/prontuarios/cadastrarEditar/'.$prontuario->id:'/prontuarios/cadastrarEditar/';

$dadosModal['dadosClinica'] = isset($prontuario)?$prontuario->chave:'SoulFisio - Clinica de Prevenção, Promoção e Reabilitação em Saúde.<br>Rua das Palmeiras, 302, Centauro, Eunápolis-Bahia<br>Tel: 73 3512-5665';

$dadosModal['titulo'] = 'Configurações do Sistema';
?>

@include('modulos.configuracoes.modal.usuario')

<div class="modal" tabindex="-1" role="dialog" id="{{$dadosModal['id']}}">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title">{{$dadosModal['titulo']}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

			<div class="modal-body">
				<div class="col-12 text-right">
					<a class="btn btn-sm btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#modalusuariousuario">Novo usuario <i class="fa fa-plus"></i></a>
				</div>
				<table class="table">
					<thead>
						<tr>
							<td>Nome</td>
							<td>Email</td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usuarios as $key => $value): ?>
							<tr>
								<td>{{$value->name}}</td>
								<td>{{$value->email}}</td>
								<td><button class="btn btn-default" data-toggle="modal" data-target="#modalusuariousuario{{$value->id}}"><i class="fa fa-edit"></i></button></td>
								<td><a href="/configuracoes/deletarUsuario/{{$value->id}}" class="btn btn-default"><i class="fa fa-remove"></i></a></td>
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
			</div>

		</div>
	</div>
</div>

<?php foreach ($usuarios as $key => $usuario): ?>
	@include('modulos.configuracoes.modal.usuario')
	<?php endforeach ?>