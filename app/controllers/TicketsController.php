<?php

class TicketsController extends BaseController
{
    public function index($cat = 'all')
    {
        $page_data = array(
            'highlight' => $cat
        );

        /** Admin Pages; Responsible for all tickets **/
        if (Auth::user()->type == 'admin') {
            if ($cat == 'all') {
                $tickets = Ticket::getAllTickets();
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tutti i Tickets');
                return View::make('admin.tickets.all', $page_data);
            }

            if ($cat == 'open') {
                $tickets = Ticket::getAllOpenTickets();
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tickets Aperti');
                return View::make('admin.tickets.open', $page_data);
            }

            if ($cat == 'resolved') {
                $tickets = Ticket::getAllClosedTickets();
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tickets Chiusi');
                return View::make('admin.tickets.resolved', $page_data);
            }
        }

        /** Normal User Pages; Responsible for its tickets only */
        if (Auth::user()->type == 'user') {
            if ($cat == 'all') {
                $tickets = Ticket::getAllUserTickets(Auth::user()->id);
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tutti i Tickets');
                return View::make('user.tickets.all', $page_data);
            }

            if ($cat == 'open') {
                $tickets = Ticket::getOpenUserTickets(Auth::user()->id);
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tickets Aperti');
                return View::make('user.tickets.open', $page_data);
            }

            if ($cat == 'resolved') {
                $tickets = Ticket::getClosedUserTickets(Auth::user()->id);
                $page_data = array_add($page_data, 'tickets', $tickets);
                $page_data = array_add($page_data, 'title', 'Tickets Chiusi');
                return View::make('user.tickets.resolved', $page_data);
            }
        }
    }

    /** Display Ticket Info */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $posts = Post::getPosts($id);
        $page_data = array(
            'title' => $ticket->title,
            'highlight' => 'all',
            'ticket' => $ticket,
            'owner' => User::getName($ticket->owner),
            'posts' => $posts
        );
        return View::make('view', $page_data);
    }

    /** Create New Ticket */
    public function create()
    {
        /** Validate Submitted Fields */
        $validate = Ticket::validate(Input::all());

        if ($validate === true) {
            $ticket = new Ticket;
            $ticket->title = Input::get('title');
            $ticket->option = Input::get('option');
            $ticket->details = Input::get('details');
            $ticket->owner = Auth::user()->id;
            $ticket->email = Auth::user()->email;
            $ticket->status = 'Aperto';
            $ticket->save();
$ticket->buridda = Config::get('mail.from.address');


//send email to user and admin
Mail::send('emails.ticketopen', array('title'=>Input::get('title'), 'option'=>Input::get('option'),'details'=>Input::get('details'), 'utente'=>Auth::user()->email), function($message)
    use ($ticket)
{
    
       $message->to($ticket->buridda)->cc(Auth::user()->email)->subject('Ticket Aperto!');
    });

//end send email

            return Redirect::to('tickets')->with('success', 'Il tuo ticket è stato inviato');
        }
        return Redirect::to('tickets')->with('failure', 'Error while submitting your ticket');
    }

    /** Make new Post on a Ticket */
    public function createPost()
    {
        $post = new Post;
        $post->post = Input::get('post');
        $post->ticket_id = Input::get('id');
        $post->email = Input::get('email');
        $post->user_id = Auth::user()->id;
        $post->save();
$post->buridda = Config::get('mail.from.address');
        if (Auth::user()->type == 'admin') {
            $ticket = Ticket::find(Input::get('id'));

            if (Input::get('close') === 'on') {
                $ticket->status = 'Chiuso';
                                           //send email to user and admin close ticket
Mail::send('emails.ticketclosed', array('post'=>Input::get('post'),'option'=>$ticket->option,'title'=>$ticket->title), function($message) use ($post, $ticket)
{
    
       $message->to($post->buridda)->cc($post->email)->subject('Ticket Chiuso!');
    });

//end send email

            } else {
                $ticket->status = 'Aperto';

                                                           //send email to user and admin close ticket
Mail::send('emails.ticketreply', array('post'=>Input::get('post'),'option'=>$ticket->option,'title'=>$ticket->title), function($message) use ($post, $ticket)
{
    
       $message->to($post->buridda)->cc($post->email)->subject('Risposta al Ticket!');
    });


//end send email
            }
            $ticket->save();


        }
        return Redirect::to('tickets')->with('success', 'Il messaggio è stato inoltrato');
    }
}
