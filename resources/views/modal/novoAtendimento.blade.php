<?php 
$dadosModal = [];
$dadosModal['id'] =  isset($atendimento)?'atendimento'.$atendimento->id:'atendimento';

$dadosModal['data'] =  isset($atendimento)?$atendimento->data:date('Y-m-d');

$dadosModal['titulo'] = isset($atendimento)?'Edição de atendimento':'Cadastro de Novo atendimento';


$dadosModal['url'] = isset($atendimento)?'/atendimentos/cadastrarEditar/'.$atendimento->id:'/atendimentos/cadastrarEditar/';
?>
<div class="modal" role="dialog" id="{{$dadosModal['id']}}">
	<div class="modal-dialog " role="document">
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
						<div class="col-12">
							<label>Paciente</label>
							<select class="buscarCliente" name="cliente-id" style="width: 100%"></select>
						</div>
						<div class="col-12">
							<label>Data</label>
							<input type="date" class="form-control" name="data" value="{{$dadosModal['data']}}">
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