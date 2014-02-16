<?php
  class Admin_Users_Controller extends Base_Controller{
    public $restful = true;

    public function get_dashboard() {
      $user = User::find(Session::get('id'));
      if (!is_null($user)) {
        return View::make('admin.dashboard')->with('user', $user);
      } else {
        echo "hello world";
      }
    }
  }