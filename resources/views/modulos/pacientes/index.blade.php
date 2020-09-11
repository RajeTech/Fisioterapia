@extends('layouts.applogado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="titulo-card">Pacientes</div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="">
                        <div class="col-12" style="margin-bottom: 5px;">
                            <div class="input-group">

                               <input type="" class="form-control" placeholder="Filtrar..." name="filtro">
                               <button type="submit" name="" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i>
                               </button>
                               <button class="btn btn-titulo btn-sm" type="button"  data-toggle="modal" data-target="#paciente" style="margin-left: 41px;">Cadastrar Novo <i class="fa fa-plus"> </i></button>

                               <button class="btn btn-titulo btn-sm" type="button"  data-toggle="modal" data-target="#relatorioAtendimentos" style="margin-left: 41px;">Relatorio <i class="fa fa-file-pdf-o"> </i></button>
                           </div>
                       </div>
                   </form>
                   <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>RG</th>
                            <th>CPF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       // $array = array('teste' , 'teste' , 'teste', 'teste', 'teste' );
                        foreach ($objetos as $key => $value): ?>
                            <tr>    
                                <td><a  href="/pacientes/paciente/{{$value->id}}">{{$value->nome}} <i class="fa fa-edit"></i></a></td>
                                <td>{{$value->RG}}</td>
                                <td>{{$value->CPF}}</td>

                                <td><a href="/pacientes/excluir/{{$value->id}}"><i style="color: red" class="fa fa-trash" aria-hidden="true"></i>
                                </a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="col-12 text-center">
                    {{ $objetos->appends($_GET)->links() }}
                    
                    <br> 
                    <small>Total de registros {{$objetos->total()}} </small>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('modulos.pacientes.modal.paciente')


<?php foreach ($objetos as $key => $paciente): ?>
    @include('modulos.pacientes.modal.paciente')
<?php endforeach ?>


<div class="modal" tabindex="-1" role="dialog" id="relatorioAtendimentos">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title">Relatorio Atendimento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="/atendimentos/relatorio" method="post">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div class="modal-body">

            <div class="col-12">
                <label>Mes/Ano </label> 
                <?php 
                $meses = array(
                    1 => 'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                );
                ?>
                <div class="input-group">
                    <select class="form-control" name="mes">
                     <option value="">Selecione...</option>
                     <?php foreach ($meses as $key => $value): ?>
                        <option value="{{$key}}" {{$key == date('m')?'selected':''}}>{{$value}}</option>
                    <?php endforeach ?>
                </select>
                <input type="number" class="form-control" name="ano" value="{{date('Y')}}" style="width: 50px;">
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" name="cadastrar" class="btn btn-titulo">Gerar</button>
    </div>

</form>
</div>
</div>
</div>

@endsection
