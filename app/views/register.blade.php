<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrati - {{Config::get('app.name')}}</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('public/css/bootstrap.css')}}
    {{HTML::style('public/css/custom.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('public/css/signin.css')}}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libraries/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libraries/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <!-- START REGISTRATION FORM -->
    {{ Form::open( array('url'=>'register', 'class'=>'form-signin') ) }}
    {{ Form::token() }}
    <h2 class="form-signin-heading">Registrati</h2>
    {{ Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Nome e Cognome') )}}
    {{ Form::email('email', '', array('class'=>'form-control', 'placeholder'=>'Indirizzo Email') )}}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=> 'Password') )}}
    {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=> 'Ripeti la Password') )}}
    <span class="alert-message">
        @foreach ($errors->all() as $error)
            {{  $error . '<br />'}}
        @endforeach

        {{$message}}
    </span>
    {{ Form::submit('Registrati', array('class'=>'btn btn-lg btn-primary btn-block') ) }}
    <br/>
    <a href="{{url('login')}}">Sei già un utente?</a>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- /container -->

</body>
</html>
