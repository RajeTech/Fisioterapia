<?php 
$dadosModal = [];
$dadosModal['id'] =  isset($usuario)?'modalusuariousuario'.$usuario->id:'modalusuariousuario';
$dadosModal['url'] = isset($usuario)?'/configuracoes/cadastrarEditarUsuario/'.$usuario->id:'/configuracoes/cadastrarEditarUsuario/';

$dadosModal['name'] = isset($usuario)?$usuario->name:'';

$dadosModal['email'] = isset($usuario)?$usuario->email:'';

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
			<form action="{{$dadosModal['url']}}" method="post">
				<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				
				<div class="modal-body">
					<div class="row">
						<div class="col-4">
							<label>Nome</label>
							<input type="text" name="name" class="form-control" value="{{$dadosModal['name']}}">
						</div>

						<div class="col-4">
							<label>Email</label>
							<input type="email" name="email" class="form-control" value="{{$dadosModal['email']}}">
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="col-4">
							<label>Senha</label>
							<input type="password" class="form-control" name="password" value="">
						</div>

						<div class="col-4">
							<label>Repita a Senha</label>
							<input type="password" class="form-control" name="confirmpassword" value="">
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
