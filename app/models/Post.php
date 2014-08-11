<?php

class Post extends Eloquent
{
    protected $table = 'posts';

    public static function getPosts($ticket_id)
    {
        return DB::select(
            'SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id AND posts.ticket_id = ?',
            array($ticket_id)
        );
    }
}
