<?php

class LoginController extends BaseController
{
    public function index()
    {
        /** Already Logged in */
        if (Auth::check()) {
            return Redirect::to('tickets');
        }

        return View::make('login');
    }

    public function login()
    {
        if (Auth::attempt(Input::only('email', 'password'))) {
            return Redirect::to('tickets');
        }

        return Redirect::to('login')->withErrors('Email o password non validi');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('login');
    }
}
