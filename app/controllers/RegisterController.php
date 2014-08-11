<?php

class RegisterController extends BaseController
{
    public function index()
    {
        /** Already Logged in */
        if (Auth::check()) {
            return Redirect::to('tickets');
        }
        return View::make('register', array('message' => Session::get('message')));
    }

    public function register()
    {
        $validate = User::validateUser(Input::all());
        /** Register the user */
        if ($validate === true) {
            $user = new User;
            $user->name = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->type = 'user';
            $user->isBanned = '0';
            $user->save();
            return Redirect::to('login')->with('success', 'Inserisci i tuoi dati per accedera!');
        }
        /** Validation Failed */
        return Redirect::to('register')->withErrors($validate);
    }
}
