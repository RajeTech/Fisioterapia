<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SGF</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!--Fonts-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script src="{{url("assets/lib/jquery.mask.js")}}"></script>  

    <!--CSS-->
    <link rel="stylesheet" href="{{url("assets/css/acl-login.css")}}">
    
    </script>

    <link rel="stylesheet" href="{{url("assets/lib/alertifyjs/css/alertify.css")}}">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="{{url("assets/imgs/logo-brasao-pcba.png")}}">

    <link rel="stylesheet" type="text/css" href="{{url("dist/text-security.css")}}>
    
</head>
<body>

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