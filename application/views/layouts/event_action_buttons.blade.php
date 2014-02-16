<!-- this loop checks if an event is past todays date and removes the buttons if it is -->
@if ($pdevent->past_event == "1")
  <strong>{{"This event has ended on " .$pdevent_details['Event Date']}}</strong>
@else
  @if(isset($user_pdevents)) <!-- this loop checks if the user is already attending the event -->
    @if ($user_pdevents->id == $pdevent_details['Event ID'])
      @include('layouts/event_leave_modal')
      <a href="#unattendModal" data-toggle="modal"><button class="btn btn-danger">Leave Event</button></a>
    @endif
  @else
    <!-- if the event has unlimited spaces show the button otherwise put the user on the waitlist -->
    @if ($pdevent_details['Available Spaces'] < 1 && $pdevent_details['Available Spaces'] != "Unlimited")
      {{print_r($waitlist)}}
      <p><strong>Sorry, this event is all booked out. More spaces may be available soon.</strong></p>
      <a href="/event/{{$pdevent->id}}/notify"><button class="btn btn-primary">Notify Me About Free Spots</button></a>
    @elseif ($pdevent_details['Available Spaces'] == "Unlimited")
      <a href="/event/{{$pdevent->id}}/attend"><button class="btn btn-primary">Join Event!</button></a>
    @elseif ($pdevent_details['Category'] == "Professional Development" && $user_pd_details == "incomplete")
      @include('layouts/event_attend_modal')
      <a href="#attendModal" data-toggle="modal"><button class="btn btn-primary">Join Event!</button></a>
    @else
      <a href="/event/{{$pdevent->id}}/attend"><button class="btn btn-primary">Join Event!</button></a>
    @endif
  @endif
@endif
<!-- This is confirmation for an admin to delete an event, security for the delete event route is in the routes.php file and in the pdevents controller -->
@if ($pdevent->past_event != "1" && Session::get('admin') == "1")
  <div id="deleteModal" class="modal hide" role="dialog">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3>Delete Event</h3>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to <strong>delete</strong> this event?</p>
    </div>
    <div class="modal-footer">
      <a href="/event/{{$pdevent->id}}/delete"><button class="btn btn-danger">Yes, delete event</button></a>
      <a href="#" class="btn" data-dismiss="modal">No, no, no. I was just looking for the exit</a>
    </div>
  </div>
  <a href="#deleteModal" data-toggle="modal"><button class="btn btn-danger">Delete Event</button></a>
@endif