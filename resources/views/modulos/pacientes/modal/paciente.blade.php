<?php 
$dadosModal = [];
$dadosModal['id'] =  isset($paciente)?'paciente'.$paciente->id:'paciente';
$dadosModal['nome'] = isset($paciente)?$paciente->nome:'';
$dadosModal['url'] = isset($paciente)?'/pacientes/cadastrarEditar/'.$paciente->id:'/pacientes/cadastrarEditar/';
$dadosModal['CPF'] = isset($paciente)?$paciente->CPF:'';
$dadosModal['RG'] = isset($paciente)?$paciente->RG:'';
$dadosModal['CNS'] = isset($paciente)?$paciente->CNS:'';
$dadosModal['telefone'] = isset($paciente)?$paciente->telefone:'';
$dadosModal['DTnascimento'] = isset($paciente)?$paciente->DTnascimento:'';
$dadosModal['ruaEndereco'] = isset($paciente)?$paciente->ruaEndereco:'';
$dadosModal['bairroEndereco'] = isset($paciente)?$paciente->bairroEndereco:'';
$dadosModal['numeroEndereco'] = isset($paciente)?$paciente->numeroEndereco:'';
$dadosModal['cidadeEndereco'] = isset($paciente)?$paciente->cidadeEndereco:'';
$dadosModal['sessoes'] = isset($paciente)?$paciente->sessoes:'';

$dadosModal['sexo'] = isset($paciente)?$paciente->sexo:'';


$dadosModal['acompanhante'] = isset($paciente)?$paciente->acompanhante:'';

$dadosModal['titulo'] = isset($paciente)?'Cadastro de '.$paciente->nome:'Cadastrar Paciente';
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

          @include('modulos.pacientes.inc.pacientecadastro')

        </div>
        <div class="modal-footer">
          <button type="submit" name="cadastrar" class="btn btn-titulo">Salvar</button>
        </div>

      </form>
    </div>
  </div>
</div>