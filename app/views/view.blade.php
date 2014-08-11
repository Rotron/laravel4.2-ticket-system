@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <h3>{{ htmlentities($ticket->title) }}</h3>
            <hr/>
            <div class="list-group">
                <h4 class="list-group-item-heading" style="padding: 5px">{{ e($owner) }}</h4>
                <p class="list-group-item-text" style="padding: 5px">{{ e($ticket->option) }} </p>
                <p class="list-group-item-text" style="padding: 5px">{{ e($ticket->details) }} </p>
                <h6 style="padding: 5px; font-size: 0.75em">{{$ticket->created_at}}</h6>
            </div>

            @foreach($posts as $post)
            <div class="list-group">
                <h4 class="list-group-item-heading" style="padding: 5px">{{ e($post->name) }}</h4>

                <p class="list-group-item-text" style="padding: 5px">{{ e($post->post)}} </p>
                <h6 style="padding: 5px; font-size: 0.75em">{{$post->created_at}}</h6>
            </div>
            @endforeach

            <hr/>

            {{ Form::open(array('url'=>'ticket', 'class'=>'form-horizontal') ) }}
            {{ Form::token() }}
            @if($ticket->status == 'Open' || Auth::user()->type == 'admin')
            <div class="form-group">
                <label class="col-sm-1 control-label">Rispondi:</label>
                {{Form::hidden('id', $ticket->id)}}
                {{Form::hidden('email', $ticket->email)}}
                <div class="col-sm-11">
                    {{Form::textarea('post', '', array('class'=>'form-control', 'rows'=>'3' )) }}
                </div>
                <button style="float: right; margin: 20px;" type="submit" class="btn btn-default">Invia</button>
                @if(Auth::user()->type == 'admin')
                <div><input name="close" style="margin-top: 25px; margin-left: 20px;" type="checkbox"> Chiudi Ticket
                </div>
                @endif
            </div>
            @endif
            {{ Form::close() }}

        </div>

        @stop