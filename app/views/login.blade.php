<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - {{Config::get('app.name')}}</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('public/css/bootstrap.css')}}
    {{HTML::style('public/css/signin.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('public/css/custom.css')}}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libraries/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libraries/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="container">
@if(Session::has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Utente Registrato!</strong> {{Session::get('success')}}
            </div>
            @endif
    <!-- START LOGIN FORM -->
    {{ Form::open( array('url'=>'login', 'class'=>'form-signin') ) }}
    {{ Form::token() }}
    <h2 class="form-signin-heading">Accedi</h2>
    {{ Form::text('email', '', array('class'=>'form-control','placeholder'=>'Indirizzo Email')) }}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=> 'Password') )}}
    <span class="alert-message">{{$errors->first()}}</span>
    {{ Form::submit('Accedi', array('class'=>'btn btn-lg btn-primary btn-block') ) }}
    <br/>
    <a href="{{url('register')}}">non sei ancora registrato?</a>
    {{ form::close() }}
    <!-- END LOGIN FORM -->
</div>
<!-- /container -->

</body>
</html>
