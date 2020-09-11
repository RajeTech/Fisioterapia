@extends('layouts.applogado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="titulo-card">Prontuarios</div>

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
                             <button class="btn btn-titulo btn-sm" type="button"  data-toggle="modal" data-target="#paciente" style="margin-left: 41px;">Cadastrar Nova <i class="fa fa-plus"> </i></button>
                         </div>
                     </div>
                 </form>
                 <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Chave</th>

                            <th>Paciente</th>
                            <th>Data de Autorização</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       // $array = array('teste' , 'teste' , 'teste', 'teste', 'teste' );
                        foreach ($objetos as $key => $value): ?>
                            <tr>    
                                <td>
                                    <a  href="/pacientes/paciente/{{$value->id}}">{{$value->chave}} <i class="fa fa-edit"></i></a></td>
                                    <td>{{$value->paciente->nome}} </td>

                                    <td>{{$value->dataAutorizacao}} </td>
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

@endsection
