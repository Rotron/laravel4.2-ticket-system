<?php

class UserController extends BaseController
{
    public function changeInfo()
    {
        $validator = User::validateChange(Input::only('password', 'password_confirmation', 'email'));

        if ($validator === true) {
            $user = Auth::user();
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->save();

            return Redirect::to('tickets')->with('success', 'La tua passwortd è stata aggiornata');
        }

        return Redirect::to('tickets')->with('failure', 'Si è riscontrato un errore');
    }
}
