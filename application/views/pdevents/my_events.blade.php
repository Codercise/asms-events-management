@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')
    <div class="offset2 span9 dashboard">
    <h1>My Events</h1>
    @if (count($pdevents) < 1)
      <p>Oh no! You haven't created any events yet, you can <a href="/events/create">create one here if you want to.</a></p>
    @endif
    @include('/layouts/event_details_table')
  </div>
@endsection