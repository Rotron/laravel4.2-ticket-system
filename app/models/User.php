<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    public static function validateUser($data)
    {
        /** Validate Registration Data */
        $validator = Validator::make(
            $data,
            array(
                'name' => 'required',
                'password' => 'required| between: 6,16|confirmed',
                'password_confirmation' => 'required| between: 6,16',
                'email' => 'required|email|unique:users,email',
            )
        );

        if ($validator->fails()) {
            return $validator->messages();
        }
        return true;
    }

    public static function validateChange($data)
    {
        $validator = Validator::make(
            $data,
            array(
                'password' => 'required| between: 6,16|confirmed',
                'password_confirmation' => 'required| between: 6,16',
                'email' => 'required|email'
            )
        );

        if ($validator->fails()) {
            return $validator->messages();
        }
        return true;
    }

    /** Get Name by ID */
    public static function getName($userId)
    {
        $user = DB::table('users')->find($userId);
        return $user->name;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }
    public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}
}
