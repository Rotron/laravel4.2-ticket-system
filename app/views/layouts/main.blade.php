<!DOCTYPE html>
<html>
<head>
    <title>{{$title . ' - ' . Config::get('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    {{ HTML::style('public/css/bootstrap.css') }}
    {{ HTML::style('public/css/custom.css') }}
    {{ HTML::style('public/css/jquery.dataTables.css') }}
    {{ HTML::style('public/css/jquery.dataTables_themeroller.css') }}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libraries/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libraries/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body style="padding: 0px">

<!-- START SETTINGS MODAL -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Profilo Utente</h4>
            </div>
            {{Form::open(array('url'=>'changeInfo')) }}
            {{ Form::token() }}
            <div class="modal-body">
                <div class="form-group">
                    <label>Email</label>
                    <?php echo Auth::user()->email?>

                    {{Form::hidden('email', Auth::user()->email, array('class'=>'form-control', )) }}
                </div>
                <div class="form-group">
                    <label>Nuova Password</label>
                    {{Form::password('password',array('class'=>'form-control')) }}
                </div>
                <div class="form-group">
                    <label>Reinserisci Password</label>
                    {{Form::password('password_confirmation',array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                {{ Form::submit('Applica', array('class'=>'btn btn-primary') ) }}
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<!-- END SETTINGS MODAL -->

<!-- START NEW TICKET MODAL -->
<div class="modal fade" id="newTicketModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nuovi Ticket</h4>
            </div>
            {{Form::open( array('url'=>'tickets') )}}
            {{ Form::token() }}
            <div class="modal-body">
                <div class="form-group">
                    <label>Titolo</label>
                    {{Form::text('title', '', array('class'=>'form-control')) }}
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    {{Form::select('option', 
                    array(
                    Config::get('app.option1') => Config::get('app.option1'),
                    Config::get('app.option2') => Config::get('app.option2')),

                     array('class'=>'form-control')) }}
                </div>
                <div class="form-group">
                    <label>Descrizione</label>
                    {{Form::textarea('details', '', array('class'=>'form-control', 'rows'=>5)) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                {{Form::submit('Invia', array('class'=>'btn btn-primary')) }}
            </div>
            {{Form::close();}}
        </div>
    </div>
</div>
<!-- END NEW TICKET MODAL -->

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{Config::get('app.url')}}"><img src="{{Config::get('app.url')}}/{{Config::get('app.logo')}}"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user()->type == 'user')
                <li><a href="#" data-toggle="modal" data-target="#newTicketModal">INVIA TICKET</a></li>
                @endif
                <li><a href="#" data-toggle="modal" data-target="#settingsModal">I tuoi dati</a></li>
                <li><a href="{{url('logout')}}">Esci</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

@yield('content')

<div class="col-md-3 col-md-pull-9">
    <ul class="nav nav-pills nav-stacked">
        <li
        @if($highlight=='all') class="active" @endif>
        <a href="{{url('tickets/all')}}">
            Tutti i Tickets
        </a>
        </li>
        <li
        @if($highlight=='resolved') class="active" @endif>
        <a href="{{url('tickets/resolved')}}">
            Tickets Risolti
        </a>
        </li>
        <li
        @if($highlight=='open') class="active" @endif>
        <a href="{{url('tickets/open')}}">
            Tickets Aperti
        </a>
        </li>

    </ul>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery.js"></script>
{{ HTML::script('public/js/bootstrap.js') }}
{{ HTML::script('public/js/jquery.dataTables.js') }}
<script type="text/javascript">
    $(document).ready(function () {
      $('#tickets').dataTable( {
    "order": [ 2, 'desc' ],
    
} );

    });
</script>

</body>
</html>