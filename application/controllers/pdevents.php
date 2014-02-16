<?php
//Controller must have PD appended as Laravel uses an Events class to do other things
class PDEvents_Controller extends Base_Controller {
  public $restful = true;

  public function get_create() {
    return View::make('pdevents.create');
  }

  public function post_create() {
    //Get input from form
    $pdevent = array(
      'name' => Input::get('event_name'),
      'description' => Input::get('description'),
      'venue_address' => Input::get('venue_address'),
      'cost' => Input::get('cost'),
      'password' => Input::get('password'),
      'category' => Input::get('category'),
      'available_spaces' => Input::get('available_spaces'),
      'facilitator' => Input::get('facilitator'),
      'start_time' => Input::get('start_hour') .":" .Input::get('start_minute'),
      'finish_time' => Input::get('end_hour') .":" .Input::get('end_minute'),
      'contact_number' => Input::get('contact_number'),
      'event_date' => Input::get('event_day') ."-" .Input::get('event_month') ."-" .Input::get('event_year'),
      'created_by' => Session::get('id')
    );
    strtotime($pdevent['event_date']);
    $today = date('d-m-Y');
    //validation if else statement
    $rules = array(
      'name' => 'required',
      'venue_address' => 'required',
      'category' => 'required',
      'facilitator' => 'required',
      'start_time' => 'required',
      'finish_time' => 'required',
      'contact_number' => 'required',
      'event_date' => "required|after:{$today}"
      );
    $validation = Validator::make($pdevent, $rules);
    if ($pdevent['available_spaces'] == "") {
      $pdevent['available_spaces'] = "Unlimited";
    }
    if ($pdevent['description'] == "") {
      $pdevent['description'] = "No description provided";
    }
    if ($validation->fails()) {
      return Redirect::to('/event/create')->with_errors($validation->errors)->with_input();
    } else {
      $plain_text_password = $pdevent['password'];
      $pdevent['password'] = Hash::make($pdevent['password']);
      if ($pdevent['cost'] == '') {
        $pdevent['cost'] = '$0';
      }
      if (PDEvent::create($pdevent)->save()) {
        $pdevent_id = DB::connection('mysql')->pdo->lastInsertId();
        return Redirect::to("/event/$pdevent_id");
      } else {
        return Redirect::to('/event/create');
      }
    }
  }

  public function get_show($id) {
    $pdevent = PDEvent::find($id);
    function show_event($pdevent) {
      $pdevent_details = array(
      'Event ID' => $pdevent->id,
      'Name' => $pdevent->name,
      'Description' => $pdevent->description,
      'Event Date' => $pdevent->event_date,
      'Venue Address' => "<a href='https://maps.google.com/maps?q=$pdevent->venue_address' target='_blank'>{$pdevent->venue_address}</a>",
      'Cost' => $pdevent->cost,
      'Available Spaces' => $pdevent->available_spaces,
      'Category' => $pdevent->category,
      'Facilitator' => $pdevent->facilitator,
      'Start Time' => $pdevent->start_time,
      'Finish Time' => $pdevent->finish_time,
      'Contact Number' => "<a href='tel:{$pdevent->contact_number}'>{$pdevent->contact_number}</a>"
      );
      //set spaces to unlimited if the available spaces field is blank
      if($pdevent_details['Available Spaces'] == "") {
        $pdevent->available_spaces = "Unlimited";
        $pdevent->save();
      }
      //if the event date is past the current date it will become a past event
      if($pdevent_details['Event Date'] > date('Y-m-d') && $pdevent->past_event = "0") {
        $pdevent->past_event = "1";
        $pdevent->save();
      }
      $email = Session::get('email');
      $user = User::find(Session::get('id'));
      $user_required_details = array('organization_name' => $user->organization_name, 'sector' => $user->sector, 'position' => $user->position, 'gender' => $user->gender, 'years_taught' => $user->years_taught);
      $user_pd_details = "incomplete";
      foreach ($user_required_details as $key => $value) {
        if ($value == 'N/A') {
          $user_pd_details = "incomplete";
        } elseif ($key == "sector" && $value == "Non-Teaching") {
          $user_pd_details = "incomplete";
        }
        else {
          $user_pd_details = "complete";
        }
      }
      $waitlist = $pdevent->waitlist()->get();
      $user_pdevents = $user->pdevents()->where('pdevent_id', '=', $pdevent_details['Event ID'])->first();
      return View::make('/pdevents/show')->with('pdevent', $pdevent)
                                         ->with('pdevent_details', $pdevent_details)
                                         ->with('waitlist', $waitlist)
                                         ->with('user_pd_details', $user_pd_details)
                                         ->with('user_pdevents', $user_pdevents);
    }
    //if password isn't provided for event
    function auth_event($pdevent) {
      $user = User::find(Session::get('id'));
      $user_pdevents = $user->pdevents()->where('pdevent_id', '=', $pdevent->id)->first();
      if ($user_pdevents) {
        return show_event($pdevent);
      }
      return View::make('/pdevents/event_auth')->with('pdevent', $pdevent)
                                               ->with('user_pdevents', $user_pdevents);
    }

    if (Hash::check("", $pdevent->password)) {
      return show_event($pdevent);
    } elseif (isset($auth_granted) && $auth_granted == "True") {
      return show_event($pdevent);
    } else {
      return auth_event($pdevent);
    }
  }

  public function post_show($id) {
    $pdevent = PDEvent::find($id);
    $password = Input::get('password');
    if (Hash::check($password, $pdevent->password)) {
      $this->get_show($pdevent->id);
      return show_event($pdevent);
    }
    return Redirect::to("/event/{$id}")->with('status', "Incorrect password entered");
  }

  public function get_all() {
    $pdevents = PDEvent::order_by('id', 'desc')->get();
    $pdevents_array = array();
    foreach ($pdevents as $pdevent) {
      array_push($pdevents_array, $pdevent);
    }
    return View::make('/pdevents/all')->with('pdevents', $pdevents_array);
  }

  public function get_attend($id) {
    $pdevent = PDEvent::find($id);
    $email = Session::get('email');
    $user = User::find(Session::get('id'));
    $user_pdevents = $user->pdevents()->get();
    if(!empty($user_pdevents)) {
      foreach ($user_pdevents as $key) {
        if ($pdevent->id == $key->id) {
          return Redirect::to("/event/{$pdevent->id}")->with('status', "You've already signed up to this event");
        } else {
          $user->pdevents()->attach($pdevent->id);
          if ($pdevent->available_spaces != "Unlimited") {
            $pdevent->available_spaces -= 1;
          }
          $pdevent->save();
          return Redirect::to("/event/{$pdevent->id}")->with('status', "You're signed up now");
        }
      }
    } else {
      $user->pdevents()->attach($pdevent->id);
      if ($pdevent->available_spaces != "Unlimited") {
        $pdevent->available_spaces -= 1;
      }
      $pdevent->save();
      return Redirect::to("/event/{$pdevent->id}")->with('status', "You're signed up now");
    }
  }

  public function get_unattend($id) {
    $pdevent = PDEvent::find($id);
    $user = User::find(Session::get('id'));
    $user_pdevents = $user->pdevents()->where('pdevent_id', '=', $id);
    $user->pdevents()->detach($pdevent->id);
    if ($pdevent->available_spaces != "Unlimited") {
      $pdevent->available_spaces += 1;
    }
    $pdevent->save();
    return Redirect::to("/event/{$pdevent->id}")->with('status', "You're not attending this event any more");
  }

  public function get_upcoming() {
    $pdevents = PDEvent::order_by('id', 'desc')->get();
    $pdevents_array = array();
    foreach ($pdevents as $pdevent) {
      if ($pdevent->past_event == "0") {
        array_push($pdevents_array, $pdevent);
      }
    }
    return View::make('pdevents/upcoming')->with('pdevents', $pdevents_array);
  }

  public function get_past_events() {
    $pdevents = PDEvent::order_by('id', 'desc')->get();
    $pdevents_array = array();
    foreach ($pdevents as $pdevent) {
      if ($pdevent->past_event == "1") {
        array_push($pdevents_array, $pdevent);
      }
    }
    return View::make('pdevents/past_events')->with('pdevents', $pdevents_array);
  }

  public function get_my_events() {
    $pdevents = PDEvent::order_by('id', 'desc')->get();
    $user = User::find(Session::get('id'));
    $pdevents_array = array();
    foreach ($pdevents as $pdevent) {
      if ($pdevent->created_by == $user->id) {
        array_push($pdevents_array, $pdevent);
      }
    }
    return View::make('pdevents/my_events')->with('pdevents', $pdevents_array);
  }

  public function get_delete($id) {
    if (Session::get('admin') == "1") {
      $pdevent = PDEvent::find($id);
      $pdevent->delete();
      return Redirect::to('/user/dashboard')->with('status', 'Event Deleted');
    } else {
      return Redirect::to('/');
    }
  }

  public function get_notify($id) {
    $user = User::find(Session::get('id'));
    $pdevent = PDEvent::find($id);
    $user_pdevents = $user->pdevents()->get();
    //array needed to insert the waitlist into the db
    //$waitlist = new Waitlist(array('user_id' => $user->id));
    //$waitlist = $pdevent->waitlist()->insert($waitlist);
    $all_waitlists = $pdevent->waitlist()->get(); //this is all the people on the wait list for the event
    foreach ($all_waitlists as $individual_waitlist) {
      if ($user->id == $individual_waitlist->user_id) {
        return Redirect::to("/event/{$id}")->with('status', "You're already on the waiting list");
      } else {
        $waitlist = new Waitlist(array('user_id' => $user->id));
        $waitlist = $pdevent->waitlist()->insert($waitlist);
        return Redirect::to("/event/{$id}")->with('status', "You're on the waiting list, we'll get back to you when a spot frees up");
      }
    }
  }
}