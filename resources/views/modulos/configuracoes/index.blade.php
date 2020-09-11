@extends('layouts.applogado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="titulo-card">Configurações</div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                 <div class="col-12">
                    <ul class="list-group">
                        <li class="list-group-item" data-toggle="modal" data-target="#modalusuario">Usuarios do Sistema</li>
                        <li class="list-group-item" data-toggle="modal" data-target="#modalConfiguracoes">Dados da Clinica</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('modulos.configuracoes.modal.configuracoesSistema')

@include('modulos.configuracoes.modal.configuracoesUsuarios')

@endsection
