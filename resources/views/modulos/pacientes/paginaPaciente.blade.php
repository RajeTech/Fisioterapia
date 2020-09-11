@extends('layouts.applogado')

@section('content')
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
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="titulo-card">Paciente <b>{{$dadosModal['nome']}}</b></div>

        <div class="card-body">

          <form action="{{$dadosModal['url']}}" method="post">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

            @include('modulos.pacientes.inc.pacientecadastro')
            <button type="submit" name="cadastrar" class="btn btn-titulo" style="margin-bottom: 10px;">Salvar</button>
          </form>
          <?php if (isset($paciente->id)): ?>

            <div class="row">
              <div class="col-4" style="height: 600px;border: #ccc 1px solid;overflow: auto;">

               <h6 class="text-center" style="margin-bottom: -10px;margin-top: 10px;">Frequencia</h6>

               <hr>
               
               <br>
               <?php foreach ($paciente->datas as $key => $value): ?>
                <span class="badge badge-default">{{$value->dataFormatada()}}</span>
              <?php endforeach ?>
            </div>

            <div class="col-4" style="height: 600px;border: #ccc 1px solid;overflow: auto;">

             <h6 class="text-center" style="margin-bottom: -10px;margin-top: 10px;">Guias de Fisioterapia</h6>
             <hr>
             <button class="btn btn-default btn-sm" data-toggle="modal" style="position: absolute;top: 0px;right: 4px;"  data-target="#guia" >Nova   <i class="fa fa-plus"></i></button>
             <div class="list-group">
              <?php $totalGuias = count($paciente->guias);
               foreach ($paciente->guias as $key => $guiap): ?>
               <div href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                <div class="d-flex w-100 justify-content-between">

                  <p class="mb-1" >
                    {{$totalGuias-$key}}ª Guia - Chave {{$guiap->chave}} 
                  </p>
                  <span class="badge badge-default badge-pill"> <a data-toggle="modal"  data-target="#guia{{$guiap->id}}">   <i style="font-size: 23px;" class="fa fa-external-link"></i></a></span>

                  <span class="badge badge-default badge-pill"> <a target="_blank" href="/guias/exibirGuia/{{$guiap->id}}/1"> <i style="font-size: 23px;" class="fa fa-file-pdf-o green"> </i></a></span>

                  <span class="badge badge-default badge-pill"> <a target="_blank" href="/guias/exibirGuia/{{$guiap->id}}/1/1"> 2º <i style="font-size: 23px;" class="fa fa-file-pdf-o green"> </i></a></span>

                </div>
                <p class="mb-1"></p>
                <small>Autorizado em {{$guiap->dataFormatada()}}</small>


              
              </div>

            <?php endforeach ?>
          </div>
        </div>


        <div class="col-4" style="height: 600px;border: #ccc 1px solid;overflow: auto;">

         <h6 class="text-center" style="margin-bottom: -10px;margin-top: 10px;">Prontuarios</h6>
         <hr>
         <button style="position: absolute;top: 0px;right: 4px;"  class="btn btn-default btn-sm" data-toggle="modal"  data-target="#prontuario">Novo   <i class="fa fa-plus"></i>
         </button>

         <div class="list-group">
          <?php foreach ($paciente->prontuarios as $key => $prontuariop): ?>
           <div href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
            <div class="d-flex w-100 justify-content-between">
              <p class="mb-1"   >
                Chave {{$prontuariop->chave}} 
              </p>

              <span class="badge badge-default badge-pill"> <a data-toggle="modal"  data-target="#prontuario{{$prontuariop->id}}">   <i style="font-size: 23px;" class="fa fa-external-link"></i></a></span>


              <span class="badge badge-default badge-pill"> <a target="_blank" href="/prontuarios/exibir/{{$prontuariop->id}}/1"> <i style="font-size: 23px;" class="fa fa-file-pdf-o green"> </i></a></span>


            </div>
            <p class="mb-1"></p>
            <small>Autorizado em {{$prontuariop->dataFormatada()}} até {{$prontuariop->ultimaData()}}</small>
          </div>

        <?php endforeach ?>
      </div>





    </div>

  <?php endif ?>

</div>
</div>
</div>
</div>
</div>
@include('modulos.guias.modal.cadastrarEditarGuia')

@include('modulos.prontuario.modal.cadastrarEditarProntuario')

<?php foreach ($paciente->prontuarios as $key => $prontuario): ?>
 @include('modulos.prontuario.modal.cadastrarEditarProntuario')
<?php endforeach ?>


<?php foreach ($paciente->guias as $key => $guia): ?>
  @include('modulos.guias.modal.cadastrarEditarGuia')
<?php endforeach ?>

@endsection
