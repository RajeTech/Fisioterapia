@extends('layouts.applogado')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header text-center">Lista de Pacientes Atendidos</div>

        <div class="card-body">
         <div class="row ">
          <div class="col-3">

          </div>
          <div class="col-6">

          </div>
          <form action="" class="col-6 hidden">
            <div class="col-12" style="margin-bottom: 5px;">
              <div class="input-group">
                <input type="" class="form-control" placeholder="Incluir Paciente..." name="filtro">
                <button type="submit" name="" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </form>
          <div class="col-3 text-right">
            <button class="btn btn-titulo btn-sm" type="button" data-toggle="modal"  data-target="#atendimento">
              Atender paciente
            </button>
          </div>
        </div>
        <table class="table table-sm">
         <thead>
           <tr>
             <th>Data</th>
             <th>Nome</th>
             <th>RG</th>
             <th>CPF</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
          <?php foreach ($objetos as $key => $paciente):  ?>
            <?php if ($paciente->paciente!=null): ?>

              <tr>

               <td>{{$paciente->dataFormatada()}}</td>
               <td><a  href="/pacientes/paciente/{{$paciente->paciente->id}}">{{$paciente->paciente->nome}} <i class="fa fa-edit"></i></a></td>
               <td>{{$paciente->paciente->RG}}</td>
               <td>{{$paciente->paciente->CPF}}</td>
               <td> <a href="/atendimentos/excluir/{{$paciente->id}}"><i class="fa fa-remove red"></i></a></td>
             </tr>

           <?php endif ?>
         <?php endforeach ?>

       </tbody>
     </table>


   </div>
 </div>
</div>
</div>
</div>
@include('modal.novoAtendimento')
@endsection
