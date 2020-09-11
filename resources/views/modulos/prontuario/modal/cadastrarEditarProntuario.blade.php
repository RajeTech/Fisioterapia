<?php 
$dadosModal = [];
$dadosModal['id'] =  isset($prontuario)?'prontuario'.$prontuario->id:'prontuario';
$dadosModal['url'] = isset($prontuario)?'/prontuarios/cadastrarEditar/'.$prontuario->id:'/prontuarios/cadastrarEditar/';

$dadosModal['chave'] = isset($prontuario)?$prontuario->chave:$paciente->guiachave();
$dadosModal['cid'] = isset($prontuario)?$prontuario->cid:'';
$dadosModal['quadroClinico'] = isset($prontuario)?$prontuario->quadroClinico:'';
$dadosModal['avaliacao'] = isset($prontuario)?$prontuario->avaliacao:'';
$dadosModal['observacoes'] = isset($prontuario)?$prontuario->observacoes:'';



$dadosModal['titulo'] = isset($prontuario)?'Edição de Prontuario':'Cadastro de Novo Prontuario';
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
				<input type="hidden" name="cliente-id" value="{{$paciente->id}}">
				<div class="modal-body">
					<div class="row">
						<div class="col-3">
							<label>Chave de autorização (SENHA)</label>
							<input type="number" class="form-control" name="chave" value="{{$dadosModal['chave']}}">
						</div>

						<div class="col-3">
							<label>CID</label>
							<input type="text" class="form-control" name="cid" value="{{$dadosModal['cid']}}">
						</div>
						<div class="col-3">
							<label>Quadro Clinico</label>
							<input type="text" class="form-control" name="quadroClinico" value="{{$dadosModal['quadroClinico']}}">
						</div>
						<div class="col-12 hidden">
							<label>Avaliação</label>
							<input type="text" class="form-control" name="avaliacao" value="{{$dadosModal['avaliacao']}}">
						</div>
						<div class="col-12 hidden">
							<label>Observações</label>
							<textarea name="observacoes" class="form-control">{{$dadosModal['observacoes']}}</textarea>
						</div>
						<div class="col-12">
							<hr>
							<b>
							Prontuario Evolução</b>
							<hr>
						</div>
						<?php if (!isset($prontuario->id) || true): ?>
						<div class="col-12" style="background: #d9cfcf;">
							<small>Historico Guia</small>
							<br>
							<small>
								<?=$paciente->historicoProcedimentos()?>
							</small>
						</div>
						<?php endif ?>
						<div class="col-2">
							<label>Data Inicio</label>
							<input type="date" class="form-control" value="{{$paciente->dataAutorizacaoPronturario()}}" id="dataInicio{{$dadosModal["id"]}}" name="">
						</div>
						<div class="col-2">
							<label>Qtd de Campos</label>
							<div class="input-group">
								<input type="number" id="qtddatas{{$dadosModal["id"]}}" class="form-control" >
								<button class="btn btn-primary btn-sm" onclick="addProntuario('{{$dadosModal["id"]}}')" type="button">Gerar</button>
							</div>
						</div>
						<div class="col-2">
							<label><br></label>
							<button class="btn btn-default btn-sm" type="button" onclick="limparDatas('{{$dadosModal["id"]}}')" style="margin-top: 31px;">Limpar Campos <i class="fa fa-remove"></i></button>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="listaDatas{{$dadosModal["id"]}} row col-12">
							<?php if (isset($prontuario->id)): ?>
								<?php foreach ($prontuario->datas as $key => $servico): ?>
									<div class="col-6 row" id="prontuariodatasedt{{$key}}">
										<div class="col-4">
											<label>Dia {{$key+1}}</label>
											<input type="hidden" value="{{$servico->id}}" name="prontuarioDatas[edt{{$key}}][id]">

											<input type="date" class="form-control" name="prontuarioDatas[edt{{$key}}][data]" value="{{$servico->data}}">
										</div>
											<div class="col-7">
											<label>Descrição Atividade</label>
											<textarea class="form-control" data-id="{{$servico->id}}" onchange="salvarDescricao(this)">{{$servico->descricao}}</textarea>
										</div>
<div class="col-1">
	<i class="fa fa-remove" onclick="removeDiv('#prontuariodatasedt{{$key}}')"></i>
</div>
									</div>
								<?php endforeach ?>
							<?php endif ?>
						</div>
						<div class="hidden" id="prontuariodatasMod" >
							<div class="col-6 row" id="prontuariodatasVCOUNT">
								<div class="col-4">
									<label>Dia VCOUNT</label>
									<input type="date" class="form-control" value="VDATA" name="modeloName[VCOUNT][data]">

								</div>
								<div class="col-7">
									<label>Descrição Atividade</label>
									<span class="badge badge-danger">Necessário salvar</span>
								</div>
<div class="col-1">
	<i class="fa fa-remove" onclick="removeDiv('#prontuariodatasVCOUNT')"></i>
</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<?php if (isset($prontuario->id)): ?>
						
						<a href="/prontuarios/excluir/{{$prontuario->id}}" style="position: absolute;left: 11px;"> <i class="fa fa-trash" aria-hidden="true"></i>
							Excluir
						</a>

					<?php endif ?>

					<button type="submit" name="cadastrar" class="btn btn-primary">Salvar</button>
				</div>

			</form>
		</div>
	</div>
</div>