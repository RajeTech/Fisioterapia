<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGF</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script src="{{url("assets/lib/jquery-ui.js")}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url("assets/css/acl-login.css")}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"  rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" ></script>


    <link rel="stylesheet" href="{{url("assets/lib/jquery-ui.css")}}">

    
  <link rel="stylesheet" href="{{url("assets/lib/alertifyjs/css/alertify.css")}}">
  <script src="{{url("assets/lib/alertifyjs/alertify.js")}}" ></script>
    <script src="{{url("assets/js/moment.js")}}"></script>
    <script src="{{url("assets/js/default.js")}}"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <a class="navbar-brand">SGF</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/home">Pagina Inicial <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/pacientes/">Pacientes</a>
            
            <a class="nav-item nav-link" href="/configuracoes" tabindex="-1" aria-disabled="true">Configurações</a>
        </div>
    </div>
    <div class="btn-group ">
        <a  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuario: <b class="text-uppercase">{{ Auth::user()->apelido==""?Auth::user()->name : Auth::user()->apelido }}</b> <i class="fa fa-user"></i>
      </a>
      <div class="dropdown-menu">
        
       <a class="dropdown-item" href="/">
         Sair  <i class="fa fa fa-sign-out"></i>
     </a>
 </div>
</div>
</nav>


<div class="login form">

    @yield('content')

</div>
<div class="clear"></div>
<!--jQuery-->

@if (Session::has('message'))
<script type="text/javascript">

    alert("{{ Session::get('message')['text'] }}");
</script> 
<?php (Session::forget('message'));   ?>
@endif
</body>
</html>