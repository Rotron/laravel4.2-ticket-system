@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <h3>Open Tickets</h3>
            <hr/>
            <table class="table" id="tickets">
                <thead>
                <tr>
                    <th>Ticket Title</th>
                    <th>From</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($tickets as $ticket)
                <tr>
                    <td><a href="{{url('ticket') . '/' . $ticket->id }}">{{e($ticket->title)}}</a></td>
                    <td>{{$ticket->email}}</td>
                    <td>{{$ticket->created_at}}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        @stop