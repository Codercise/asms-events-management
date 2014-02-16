<?php

class Users_Controller extends Base_Controller {

  public $restful = true;

  //Getting the create user form
  public function get_index()
  {
    return View::make('users.create');
  }

  //Posting the user create form
  public function post_create()
  {
    $user = array(
      'title' => Input::get('title'),
      'first_name'     => Input::get('first_name'),
      'last_name'      => Input::get('last_name'),
      'email'          => strtolower(Input::get('email')),
      'password'       => Input::get('password'),
      'password_confirmation' => Input::get('password_confirmation'),
      'contact_number' => Input::get('contact_number'),
      'privacy_policy'   => Input::get('privacy_policy'),
    );

    $rules = array(
      'first_name' => 'required|between:1,50',
      'last_name' => 'required|between:1,50',
      'email' => 'required|email|unique:users,email',
      'password' => 'between:8,20|confirmed',
      'contact_number' => 'required|min:8|max:15',
      'privacy_policy' => 'required'
    );

    $validation = Validator::make($user, $rules);
    //unset confirmation variables that are not needed in the user object.
    unset($user['password_confirmation']);
    unset($user['privacy_policy']);
    //validation loop
    if ($validation->fails()) {
      return Redirect::to('sign_up')->with_input()->with_errors($validation->errors);
    } else {
      //get plain text password and hash it (needs to be in plain text or it won't be able to validate length)
      $plain_text_password = $user['password'];
      $user['password'] = Hash::make($user['password']);
      User::create($user)->save();
      $credentials = array('username' => $user['email'], 'password' => $user['password']);
      $user_login = User::where_email($credentials['username'])->first();
      //log the user in
      if (Auth::login($user_login->id)) {
        Session::put('id', $user_login->id);
        Session::put('email', $credentials['username']);
        return Redirect::to('/user/dashboard')->with('status', "Welcome to your dashboard");
      } else {
        return Redirect::to('/sign_in');
      }
    }
  }

  //Getting the user dashboard
  public function get_dashboard()
  {
    $user = User::find(Session::get('id'));
    $user_details = array(
      'id' => $user->id,
      'first_name' => $user->first_name,
      'last_name' => $user->last_name,
      'email' => $user->email,
      'school_name' => $user->school_name,
      'government' => $user->government,
      'admin' => $user->admin,
    );
    $closest_event = 0;
    if ($user_pdevents = $user->pdevents()->get()) {
      $closest_event = $user_pdevents[0];
      $current_date = date('Y-m-d');
      if (count($user_pdevents) > 1) {
        foreach ($user_pdevents as $pdevent) {
          if ($pdevent->event_date >= $closest_event) {
            $closest_event = $pdevent;
          }
        }
      } elseif (count($user_pdevents) < 1) {
        $user_pdevents = 0;
        $closest_event = 0;
      }
    }
    return View::make('users/dashboard')->with('user_details', $user_details)
                                        ->with('user_pdevents', $user_pdevents)
                                        ->with('user', $user)
                                        ->with('closest_event', $closest_event);
  }

  //Getting the user edit form
  public function get_edit()
  {
    $user = User::find(Session::get('id'));
    $user_details = array(
      'title' => $user->title,
      'first_name' => $user->first_name,
      'last_name' => $user->last_name,
      'email' => $user->email,
      'password' => $user->password,
      'position' => $user->position,
      'gender' => $user->gender,
      'contact_number' => $user->contact_number,
      'years_taught' => $user->years_taught,
      'organization_name' => $user->organization_name,
      'sector' => $user->sector,
      'admin' => $user->admin
      );
    $user_pdevents = $user->pdevents()->get();
    return View::make('users/edit')->with('user_details', $user_details)
                                   ->with('user_pdevents', $user_pdevents);
  }

  //Editing the users details
  public function post_edit()
  {
    $user = User::find(Session::get('id'));

    //get input from update form
    $updated_details = array(
      'title' => Input::get('title'), 'first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'),
      'email' => Input::get('email'), 'password' => Input::get('password'),
      'position' => Input::get('position'), 'gender' => Input::get('gender'), 'contact_number' => Input::get('contact_number'),
      'years_taught' => Input::get('years_taught'), 'school_name' => Input::get('school_name'),
      'sector' => Input::get('sector')
    );
    $rules = array(
      'email' => 'required|email',
      'password' => 'min:8|max:20|confirmed'
    );

    $validation = Validator::make($updated_details, $rules);
    if ($validation->fails()) {
      return Redirect::to('/user/dashboard/settings')->with_errors($validation->errors);
    } else {
        foreach($updated_details as $key => $value) {
          if ( $value == $user->$key ) {
            //Value has been unchanged
          } else if ( $value == '' ) {
            //Value is blank
          } else {
            //Value has been changed
            $user->$key = $value;
            //Password has been changed and needs to be rehashed
            if ( $updated_details['password'] != '' && Hash::make($updated_details['password']) != $user->password) {
              $user->password = Hash::make($updated_details['password']);
            }
            if ( $updated_details['email'] != '' && $updated_details['email'] != $user->email) {
              Session::forget('email');
              $user->email = $updated_details['email'];
              Session::put('email', $updated_details['email']);
            }
          }
          //Reset the email session variable to the email address submitted
          Session::forget('email');
          Session::put('email', $updated_details['email']);
          //Save the new inputs to the user object
          $user->save();
        }
    }
    return Redirect::to('/user/dashboard')->with('status', 'Details Saved!');
  }
  //action for forgotten password form
  public function post_forgotten() {
    $email = Input::get('email');
    $new_password = Str::random(10);

    //get user object
    $user = User::where('email', '=', $email)->first();
    if (isset($user)) {
      $user->password = Hash::make($new_password);
      $user->save();
      $headers = 'MIME-Version: 1.0' ."\r\n";
      $headers .= 'Content-Type: text/html; charset=iso-8859-1' ."\r\n";
      $headers .= 'From: noreply@events.asms.sa.edu.au' ."\r\n";
      $message = "
        <html>
        <body>
          Hi {$user->first_name},<br /><br />It looks like you or someone you know has tried to reset your password at <a href='http://www.events.asms.sa.edu.au'>ASMS Events</a>
          if this was you can you please log in to your account using the new password below and change it to something secure that you can remember. If you didn't request the
          password change can you log in to your ASMS Events account and reset your password to something secure and if this happens again please contact support.
          <br /><br /><strong><a href='http://events.asms.sa.edu.au/sign_in'>{$new_password}</a></strong><br />
          <br />Thanks from:<br /><a href='mailto:nick.hayden@asms.sa.edu.au'>The ASMS Events support team</a>.
        </body>
        </html>";

      mail('nick.hayden@asms.sa.edu.au', 'ASMS Events Password Reset', "${message}", $headers);
      return Redirect::to('/sign_in')->with('status', "Your password has been reset and sent to <strong>{$email}</strong> {$new_password}");
    } else {
      return Redirect::to('/sign_in')->with('status', "Oops, looks like the email you gave us doesn't match, can you <a href='/user/forgotten'>please try again</a>");
    }
  }

  public function post_attend_modal() {
    $user = User::find(Session::get('id'));
    $updated_details = array(
      'position' => Input::get('position'),
      'gender' => Input::get('gender'),
      'years_taught' => Input::get('years_taught'),
      'organization_name' => Input::get('organization_name'),
      'sector' => Input::get('sector')
    );
    $rules = array(
      'position' => 'required',
      'gender' => 'required',
      'years_taught' => 'required',
      'organization_name' => 'required',
      'sector' => 'required'
    );
    $validation = Validator::make($updated_details, $rules);
    if ($validation->fails()) {
      return Redirect::back()->with('status', 'Your updated details weren\'t what we needed, please try again.');
    } else {
        foreach($updated_details as $key => $value) {
            $user->$key = $value;
          }
          //Save the new inputs to the user object
          $user->save();
          return Redirect::to("/events/".Input::get('pdevent_id')."/attend");
    }
  }
}