@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            @if(Session::has('failure'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Failed!</strong> {{Session::get('failure')}}
            </div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Success!</strong> {{Session::get('success')}}
            </div>
            @endif

            <h3>Tutti i Tickets</h3>
            <hr/>
            <table class="table" id="tickets">
                <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Creato</th>
                    <th>Stato</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets->all() as $ticket)
                <tr>
                    <td><a href="{{url('ticket') . '/' . $ticket->id }}">{{e($ticket->title)}}</a></td>
                    <td>{{$ticket->created_at}}</td>
                    @if ($ticket->status == 'Aperto')
                    <td class="open">{{$ticket->status}}</td>
                    @endif
                    @if ($ticket->status == 'Chiuso')
                    <td class="closed">{{$ticket->status}}</td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @stop