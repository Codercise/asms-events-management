<ul class="nav dashboard-nav nav-tabs nav-stacked pull-left span3">
  @if (!is_null(Session::get('id')))
    <li><a href="/user/dashboard">Dashboard Home</a></li>
    @if (Session::get('admin') == '1')
      <li><a href="/admin/dashboard">Admin Dashboard</a></li>
      <li><a href="/event/create">Create Event</a></li>
      <li><a href="/events/myevents">My Events</a></li>
    @endif
    <li><a href="/events/all">All Events</a></li>
    <li><a href="/events/upcoming">Upcoming Events</a></li>
    <li><a href="/events/past_events">Past Events</a></li>
    <li><a href="/user/dashboard/settings">Settings</a></li>
  @endif
</ul>