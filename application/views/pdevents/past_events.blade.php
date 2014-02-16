@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')
    <div class="offset2 span9 dashboard">
    <h1>Past Events</h1>
    @include('/layouts/event_details_table')
  </div>
@endsection