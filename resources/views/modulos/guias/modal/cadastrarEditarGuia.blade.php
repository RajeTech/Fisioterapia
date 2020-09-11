<?php 
$dadosModal = [];
$dadosModal['id'] =  isset($guia)?'guia'.$guia->id:'guia';
$dadosModal['chave'] = isset($guia)?$guia->chave:'';
$dadosModal['url'] = isset($guia)?'/guias/cadastrarEditar/'.$guia->id:'/guias/cadastrarEditar/';
$dadosModal['dataAutorizacao'] = isset($guia)?$guia->dataAutorizacao:'';
$dadosModal['dataFeita'] = isset($guia)?$guia->dataFeita:'';
$dadosModal['CNES'] = isset($guia)?$guia->CNES:'';
$dadosModal['medicoSolicitante'] = isset($guia)?$guia->medicoSolicitante:'';
$dadosModal['tipoAssitencia'] = isset($guia)?$guia->tipoAssitencia:'';

$dadosModal['procedimentoSolicitado1'] = isset($guia)?$guia->procedimentoSolicitado1:'';
$dadosModal['inicial1'] = isset($guia)?$guia->inicial1:'';
$dadosModal['competencia1'] = isset($guia)?$guia->competencia1:'';
$dadosModal['qtdRealizado1'] = isset($guia)?$guia->qtdRealizado1:'';
$dadosModal['qtdSessoesRealizado1'] = isset($guia)?$guia->qtdSessoesRealizado1:'';

$dadosModal['procedimentoSolicitado2'] = isset($guia)?$guia->procedimentoSolicitado2:'';
$dadosModal['inicial2'] = isset($guia)?$guia->inicial2:'';
$dadosModal['competencia2'] = isset($guia)?$guia->competencia2:'';
$dadosModal['qtdRealizado2'] = isset($guia)?$guia->qtdRealizado2:'';
$dadosModal['qtdSessoesRealizado2'] = isset($guia)?$guia->qtdSessoesRealizado2:'';

$dadosModal['procedimentoSolicitado3'] = isset($guia)?$guia->procedimentoSolicitado3:'';
$dadosModal['inicial3'] = isset($guia)?$guia->inicial3:'';
$dadosModal['competencia3'] = isset($guia)?$guia->competencia3:'';
$dadosModal['qtdRealizado3'] = isset($guia)?$guia->qtdRealizado3:'';
$dadosModal['qtdSessoesRealizado3'] = isset($guia)?$guia->qtdSessoesRealizado3:'';

$dadosModal['justificativa'] = isset($guia)?$guia->justificativa:'';
$dadosModal['observacoes'] = isset($guia)?$guia->observacoes:'';

$dadosModal['nomeSolicitante'] = isset($guia)?$guia->nomeSolicitante:'';
$dadosModal['cpfSolicitante'] = isset($guia)?$guia->cpfSolicitante:'';
$dadosModal['cpfCnsSolicitante'] = isset($guia)?$guia->cpfCnsSolicitante:'';

$dadosModal['nomeProfissional'] = isset($guia)?$guia->nomeProfissional:'';

$dadosModal['tipodocumentoProfissional'] = isset($guia)?$guia->tipodocumentoProfissional:'';

$dadosModal['documentoProfissional'] = isset($guia)?$guia->documentoProfissional:'';

$dadosModal['guiafisioterapia'] = isset($guia)?$guia->guiafisioterapiaUpload:'';

$dadosModal['numeroProntuario'] = isset($guia)?$guia->numeroProntuario:'';

$dadosModal['chave2'] = isset($guia)?$guia->chave2:'';

$dadosModal['dataAutorizacao2'] = isset($guia)?$guia->dataAutorizacao2:'';

$dadosModal['titulo'] = isset($guia)?'Edição de guia':'Cadastro de Nova Guia';
?>
<div class="modal" tabindex="-1" role="dialog" id="{{$dadosModal['id']}}">
	<div class="modal-dialog modal-xl modalGrande" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title">{{$dadosModal['titulo']}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{$dadosModal['url']}}" method="post" enctype="multipart/form-data" class="form{{$dadosModal['id'] }}">
				<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				<input type="hidden" name="cliente-id" value="{{$paciente->id}}">
				<div class="modal-body">
					<div class="row">
						<?php $totGuia = count($paciente->guias);  if (!isset($guia->id) && $totGuia > 0): ?>
						<div class="col-12">
							<label>Importar Guia</label>
							<select class="form-control form-control-sm" onchange="importarGuia(this)">
								<option value="">Não importar</option>
								<?php   foreach ($paciente->guias as $key => $guiacad): ?>
									<option value="{{$guiacad->id}}">  {{$totalGuias-$key}}ª Guia - Chave {{$guiap->chave}} </option>
								<?php endforeach ?>
							</select>
						</div>

					<?php endif ?>
					<div class="col-2">
						<label>Data da Guia</label>
						<input type="date" class="form-control" value="{{$dadosModal['dataFeita']}}" name="dataFeita">
					</div>
					<div class="col-3">
						<label>Chave de autorização (SENHA)</label>
						<input type="number" class="form-control" name="chave" value="{{$dadosModal['chave']}}">
					</div>
					<div class="col-2">
						<label>Data da Autorização</label>

						<input type="date" class="form-control" name="dataAutorizacao"  value="{{$dadosModal['dataAutorizacao']}}">
					</div>
					<div class="col-3">
						<label>Chave de autorização (SENHA)</label>
						<input type="number" class="form-control" name="chave2" value="{{$dadosModal['chave2']}}">
					</div>
					<div class="col-2">
						<label>Data da Autorização</label>

						<input type="date" class="form-control" name="dataAutorizacao2"  value="{{$dadosModal['dataAutorizacao2']}}">
					</div>
					<div class="col-12">
						<hr>
						<b>
						Dados do Solicitante</b>
						<hr>
					</div>

					<div class="col-3">
						<label>Numero do Prontuario</label>
						<input type="text" maxlength="200" class="form-control " name="numeroProntuario"  value="{{$dadosModal['numeroProntuario']}}">
					</div>
					<div class="col-4">
						<label>Médico Solicitante</label>
						<input type="text" class="form-control buscarMedico" name="medicoSolicitante"  value="{{$dadosModal['medicoSolicitante']}}">
					</div>

					<div class="col-5">
						<label>Tipo(s) de Assistência(s) Fisioterapêutica(s) Solicitada(s)</label>

						<input type="text" class="form-control" name="tipoAssitencia"  value="{{$dadosModal['tipoAssitencia']}}">
					</div>
					<div class="col-12">
						<hr>
						<b>
							Dados da Solicitação / Procedimentos Solicitados (Máximo de 2)
						</b>

					</div>
					<div class="col-12"><hr></div>

					<div class="col-4">
						<label>
							Procedimento Solicitado (Exclusivo para Neurologia)
						</label>

						<input type="text" class="form-control procedimento1{{$dadosModal['id']}}" name="procedimentoSolicitado1"  value="{{$dadosModal['procedimentoSolicitado1']}}">
					</div>
					<div class="col-2">
						<label>
							<input type="radio" value="1" class="procedimento1{{$dadosModal['id']}}" {{$dadosModal['inicial1']=='1'?'checked=""':''}}  name="inicial1" > Inicial  
						</label>
						<br>
						<label>
							<input type="radio" value="0" class="procedimento1{{$dadosModal['id']}}" {{$dadosModal['inicial1']=='0'?'checked=""':''}} name="inicial1"> Continuidade¹
						</label>
					</div>
					<div class="col-2">
						<label>
							<input type="radio" value="2" class="procedimento1{{$dadosModal['id']}}" {{$dadosModal['competencia1']=='2'?'checked=""':''}} name="competencia1"> 2ª Competência  
						</label>
						<br>
						<label>
							<input type="radio" value="3" class="procedimento1{{$dadosModal['id']}}" {{$dadosModal['competencia1']=='3'?'checked=""':''}} name="competencia1"> 3ª competência 
						</label>
						<br>
						<label>
							<input value="4" class="procedimento1{{$dadosModal['id']}}" type="radio" {{$dadosModal['competencia1']=='4'?'checked=""':''}} name="competencia1"> 4ª competência 
						</label>

					</div>
					<div class="col-2">
						<label>
							Quantidade Realizada nas últimas competência
						</label>

						<input type="text" class="form-control procedimento1{{$dadosModal['id']}}" name="qtdRealizado1"  value="{{$dadosModal['qtdRealizado1']}}">
					</div>
					<div class="col-2">
						<label>
							Quantidade de Sessões Realizadas.  (Máximo de 20 por competência) 
						</label>

						<input type="number" class="form-control procedimento1{{$dadosModal['id']}}" name="qtdSessoesRealizado1"  value="{{$dadosModal['qtdSessoesRealizado1']}}">
					</div>
					<div class="col-12 text-right" style="color: red">
						<a class="red" onclick="limparCampos('procedimento1{{$dadosModal['id']}}')"><i class="fa fa-minus-square-o" aria-hidden="true"></i>
						Limpar Campos</a>
					</div>
					<div class="col-12"><hr></div>
					<div class="col-4">
						<label>
							Procedimento Solicitado
						</label>

						<input type="text" class="form-control procedimento2{{$dadosModal['id']}}" name="procedimentoSolicitado2"  value="{{$dadosModal['procedimentoSolicitado2']}}">
					</div>
					<div class="col-2">
						<label>
							<input value="1" class="procedimento2{{$dadosModal['id']}}" {{$dadosModal['inicial2']=='1'?'checked=""':''}} type="radio" name="inicial2"> Inicial  
						</label>
						<br>
						<label>
							<input value="0" class="procedimento2{{$dadosModal['id']}}" {{$dadosModal['inicial2']=='0'?'checked=""':''}} type="radio" name="inicial2"> Continuidade¹
						</label>
					</div>
					<div class="col-2">
						<label>
							<input value="2" class="procedimento2{{$dadosModal['id']}}" {{$dadosModal['competencia2']=='2'?'checked=""':''}} type="radio" name="competencia2"> 2ª Competência  
						</label>
						<br>


					</div>
					<div class="col-2">
						<label>
							Quantidade Realizada nas últimas competência
						</label>

						<input type="text" class="form-control procedimento2{{$dadosModal['id']}}" name="qtdRealizado2"  value="{{$dadosModal['qtdRealizado2']}}">
					</div>
					<div class="col-2">
						<label>
							Quantidade de Sessões Realizadas.  (Máximo de 20 por competência) 
						</label>

						<input type="number" class="form-control procedimento2{{$dadosModal['id']}}" name="qtdSessoesRealizado2"  value="{{$dadosModal['qtdSessoesRealizado2']}}">
					</div>
					<div class="col-12 text-right" style="color: red">
						<a class="red" onclick="limparCampos('procedimento2{{$dadosModal['id']}}')"><i class="fa fa-minus-square-o" aria-hidden="true"></i>
						Limpar Campos</a>
					</div>

					<div class="col-12"><hr></div>
					<div class="col-4">
						<label>
							Procedimento Solicitado
						</label>

						<input type="text" class="form-control procedimento3{{$dadosModal['id']}}" name="procedimentoSolicitado3"  value="{{$dadosModal['procedimentoSolicitado3']}}">
					</div>
					<div class="col-2">
						<label>
							<input value="1" class="procedimento3{{$dadosModal['id']}}" {{$dadosModal['inicial3']=='1'?'checked=""':''}} type="radio" name="inicial3"> Inicial  
						</label>
						<br>
						<label>
							<input value="0" class="procedimento3{{$dadosModal['id']}}" {{$dadosModal['inicial3']=='0'?'checked=""':''}} type="radio" name="inicial3"> Continuidade¹
						</label>
					</div>
					<div class="col-2">
						<label>
							<input value="2" class="procedimento3{{$dadosModal['id']}}" {{$dadosModal['competencia3']=='2'?'checked=""':''}} type="radio" name="competencia3"> 2ª Competência  
						</label>
						<br>

					</div>
					<div class="col-2">
						<label>
							Quantidade Realizada nas últimas competência
						</label>

						<input type="text" class="form-control procedimento3{{$dadosModal['id']}}" name="qtdRealizado3"  value="{{$dadosModal['qtdRealizado3']}}">
					</div>
					<div class="col-2">
						<label>
							Quantidade de Sessões Realizadas.  (Máximo de 20 por competência) 
						</label>

						<input type="number" class="form-control procedimento3{{$dadosModal['id']}}" name="qtdSessoesRealizado3"  value="{{$dadosModal['qtdSessoesRealizado3']}}">
					</div>
					<div class="col-12 text-right" style="color: red">
						<a class="red" onclick="limparCampos('procedimento3{{$dadosModal['id']}}')"><i class="fa fa-minus-square-o" aria-hidden="true"></i>
						Limpar Campos</a>
					</div>
					<div class="col-12">
						<hr>
					</div>
					<div class="col-4">
						<label>Nome Profissional Executante</label>
						<input type="" class="form-control buscarExecutante profissional{{$dadosModal['id']}}" data-id="{{$dadosModal['id']}}" name="nomeProfissional" value="{{$dadosModal['nomeProfissional']}}">
					</div>
					<div class="col-3">
						<label>Documento do Profissional Executante</label>
						<label>
							<input type="radio" class="profissional{{$dadosModal['id']}}" name="tipodocumentoProfissional" id="tipodocumento{{$dadosModal['id']}}CNS" value="CNS" {{$dadosModal['tipodocumentoProfissional']=='CNS'?'checked=""':''}}  > CNS
						</label>
						<label>
							<input type="radio" name="tipodocumentoProfissional" value="CPF" id="tipodocumento{{$dadosModal['id']}}CPF" class="profissional{{$dadosModal['id']}}" {{$dadosModal['tipodocumentoProfissional']=='CPF'?'checked=""':''}}> CPF
						</label>

					</div>
					<div class="col-4">
						<label>Nº Documento (CNS/CPF) do Profissional Executante</label>
						<input type="text" class="profissional{{$dadosModal['id']}} form-control" name="documentoProfissional" id="documento{{$dadosModal['id']}}" value="{{$dadosModal['documentoProfissional']}}">
					</div>
					<div class="col-12 text-right" style="color: red">
						<a class="red" onclick="limparCampos('profissional{{$dadosModal['id']}}')"><i class="fa fa-minus-square-o" aria-hidden="true"></i>
						Limpar Campos</a>
					</div>
					<div class="col-12">
						<hr>
					</div>
					<div class="col-12 hidden">
						<label>Observações</label>
						<textarea name="observacoes" class="form-control"> {{$dadosModal['observacoes']}}</textarea>
					</div>

					<div class="col-12">
						<label>Justificativa</label>
						<textarea name="justificativa" class="form-control"> {{$dadosModal['justificativa']}}</textarea>
					</div>


					<div class="col-6">
						<br>
						<label>Upload de Guia Escaneada</label>
						<input type="file" name="guiafisioterapia">
					</div>
					<?php if ($dadosModal['guiafisioterapia'] !=''): ?>
						<div class="col-12">
							<a href="/guiafisioterapia/{{$guia->id}}/{{$dadosModal['guiafisioterapia']}}" target="_blank">
								Guia de Upload
							</a>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="modal-footer">
				<?php if (isset($guia->id)): ?>

					<a href="/guias/excluir/{{$guia->id}}" style="position: absolute;left: 11px;"> <i class="fa fa-trash" aria-hidden="true"></i>
						Excluir
					</a>

				<?php endif ?>
				<button type="submit" name="cadastrar" class="btn btn-primary">Salvar</button>
			</div>

		</form>
	</div>
</div>
</div>