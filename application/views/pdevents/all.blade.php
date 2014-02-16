@layout('layouts/main')
@section('content')
@if (!is_null(Session::get('id')))
  @include('layouts/user_dashboard_menu')
  <div class="offset2 span9 dashboard">
    <h1>All Events</h1>
    @include('layouts/event_details_table')
  </div>
@else
  <div class="span9 dashboard">
    <h1>All Events</h1>
    <p><strong>You are not logged in. Please contact the school on <a href="tel:+61-8-8201-5686">+61-8-8201-5686</a> to make a booking</strong></p>
    @include('layouts/nonuser_event_details_table')
  </div>
@endif
@endsection