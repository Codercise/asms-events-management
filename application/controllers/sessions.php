<?php

class Sessions_Controller extends Base_Controller {

  public $restful = true;

  public function get_index()
  {
    if (Auth::check()) {
      return View::make('user/dashboard');
    } else {
      return View::make('sessions.create');
    }
  }

  public function post_create()
  {
    //sign the user in
    $user = array('email' => Input::get('email'), 'password' => Input::get('password'));
    $credentials = array('username' => $user['email'], 'password' => $user['password']);

    if (Auth::attempt($credentials) == true) {
      Session::put('email', $credentials['username']);
      $user = User::where('email', '=', $user['email'])->first();
      Session::put('id', $user->id);
      Session::put('admin', $user->admin);

      return Redirect::to('user/dashboard')->with('status', "Welcome Back!");
    } else {
      return Redirect::to('/sign_in')->with('status', "Oops, your login information didn't match our records, give it another go!");
    }
  }

  //Sign out is handled in the routes using Auth::logout();
}