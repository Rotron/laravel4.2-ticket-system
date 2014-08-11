@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
               <h3>Tickets Chiusi</h3>
            <hr/>
            <table class="table" id="tickets">
                <thead>
                <tr>
                    <th>Titolo Ticket</th>
                    <th>Data e ora</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets->all() as $ticket)
                <tr>
                    <td><a href="{{url('ticket') . '/' . $ticket->id }}">{{e($ticket->title)}}</a></td>
                    <td>{{$ticket->created_at}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @stop