@layout('layouts/main')
@section('content')
  @if (!is_null(Session::get('status')))
    <p class='alert alert-success' style="margin-left: 14px;"><?php echo Session::get('status') ?></p>
  @endif
@include('layouts/user_dashboard_menu')
  <div class="offset2 span9 dashboard">
    <h1>{{$user_details['first_name'] ." " .$user_details['last_name']}}</h1>
      @if (count($user_pdevents) != 0)
        <div class="row span9">
          <ul>
            <li><strong>Events Attended:</strong> {{$user->pdevents()->count()}}</li>
            <li><strong>Upcoming Events:</strong> {{$user->pdevents()->count()}}</li>
            <li><strong>Outstanding Payments:</strong> 1</li>
            <li><strong>Next Event:</strong> <a href="/event/{{$closest_event->id}}">{{$closest_event->event_date}}</a></li>
          </ul>
        </div>
        <div class="row span9">
          <h3>Upcoming events you're attending</h3>
          <table class="table table-striped span9">
            <thead>
              <th>Event Name</th>
              <th>Event Date</th>
              <th>Event Time</th>
              <th>Contact Number</th>
              <th>Facilitator</th>
              <th>Event Venue</th>
            </thead>
            @foreach($user_pdevents as $pdevent)
              @if ($pdevent->past_event == False)
                <tr>
                  <td><a href="/event/{{$pdevent->id}}">{{$pdevent->name}}</a></td>
                  <td>{{$pdevent->event_date}}</td>
                  <td>{{$pdevent->start_time}} - {{$pdevent->finish_time}}</td>
                  <td>{{$pdevent->contact_number}}</td>
                  <td>{{$pdevent->facilitator}}</td>
                  <td><a href="http://maps.google.com/maps?q={{$pdevent->venue_address}}" target="_blank">{{$pdevent->venue_address}}</a></td>
                </tr>
              @endif
            @endforeach
          </table>
        </div>
        @else
          <p>You're not attending any events yet. <a href="/events/all">Check out what we have on offer</a></p>
        @endif
  </div>
@endsection