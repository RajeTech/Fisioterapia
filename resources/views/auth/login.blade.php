@extends('layouts.app')
@section('content')

<?php 

Auth::logout();
?>
<div class="container text-center">
  <div class="card card-container">
      <img id="profile-img" class="profile-img-card" style="height: 124px;width: 117px;" src="{{url("assets/imgs/logo.png")}}" />
      <?php  ?>
      <p id="profile-name" class="profile-name-card">SGF - Sistema de Gerenciamento de Fisioterapia </p>
      <form class="form-signin" method="post" action="{{ route('login') }}" autocomplete="off" name="frm1" id="frm1">
       {{ csrf_field() }}
       <span class="help-block">
       </span>
       <span id="reauth-email" class="reauth-email"></span>
       <label class="text-center">E-mail:</label>
       <input type="text" id="inputEmail" class="form-control" placeholder="" name="email" required autofocus autocomplete="off" ">

       <label class="text-center">Senha:</label>
       <input type="password"  id="inputPassword" class="form-control " placeholder="" name="password"  autocomplete="off">
      
      <br>
      <button class="btn btn-lg btn-primary btn-block btn-signin " style="background-image: linear-gradient(to bottom,#6bb3a8 0,#3f9b84 100%);" type="submit">Entrar</button>

  </form><!-- /form -->


  @if ($errors->has('email'))
  <span class="help-block">
    <strong>Erro ao autentificar os dados, Verifique se o email e a senha estão corretos!</strong>
</span>
@endif
@if ($errors->has('registration'))
<span class="help-block">
    <strong>Erro ao autentificar os dados, Verifique se o matricula e a senha estão corretos!</strong>
</span>
@endif
@if ($errors->has('CPF'))
<span class="help-block">
    <strong>Erro ao autentificar os dados, Verifique se o CPF e a senha estão corretos!</strong>
</span>
@endif
<a href="#" class="forgot-password ">
    Esqueceu a senha?
</a>
</div><!-- /card-container -->
</div><!-- /container -->
@endsection
