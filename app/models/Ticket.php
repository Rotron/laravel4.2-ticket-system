<?php

class Ticket extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';

    public static function validate($data)
    {
        $validator = Validator::make(
            $data,
            array(
                'title' => 'required',
                'details' => 'required'
            )
        );

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }

    public static function getAllUserTickets($user_id)
    {
        return Ticket::where('owner', '=', $user_id)->get();
    }

    public static function getOpenUserTickets($user_id)
    {
        return Ticket::whereRaw("owner = ? AND status = 'Aperto'", array($user_id))->get();
    }

    public static function getClosedUserTickets($user_id)
    {
        return Ticket::whereRaw("owner = ? AND status = 'Chiuso'", array($user_id))->get();
    }

    public static function getAllTickets()
    {
        return DB::select("SELECT * FROM users INNER JOIN tickets ON tickets.owner = users.id ");
    }

    public static function getAllOpenTickets()
    {
        return DB::select("SELECT * FROM users INNER JOIN tickets ON tickets.owner = users.id WHERE status = 'Aperto'");
    }

    public static function getAllClosedTickets()
    {
        return DB::select("SELECT * FROM users INNER JOIN tickets ON tickets.owner = users.id WHERE status = 'Chiuso'");
    }
}
