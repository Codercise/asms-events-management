<table class="table table-striped dashboard-table">
  <thead>
    <th>Event Name</th>
    <th>Event Date</th>
    <th>Event Cost</th>
    <th>Event Time</th>
  </thead>
  @foreach($pdevents as $pdevent)
    <tr>
      @if ($pdevent->past_event == "1")
        <td>{{$pdevent->name}} <span class="badge badge-important">Event Finished</span></td>
      @elseif ($pdevent->available_spaces < "1")
        <td>{{$pdevent->name}} <span class="badge badge-important">Booked Out</span></td>
      @elseif (!Hash::check("", $pdevent->password))
        <td>{{$pdevent->name}} <span class="badge badge-important">Password Protected</span></td>
      @else
        <td>{{$pdevent->name}}</td>
      @endif
      <td>{{$pdevent->event_date}}</td>
      <td>{{$pdevent->cost}}</td>
      <td>{{$pdevent->start_time}} - {{$pdevent->finish_time}}</td>
    </tr>
  @endforeach
</table>