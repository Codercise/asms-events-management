@layout('layouts/main')
@section('content')
  @if (!is_null(Session::get('status')))
    <p class='alert alert-danger'><?php echo Session::get('status') ?></p>
  @endif
	<div class="hero-unit center">
		<h1>AEMS</h1>
		<h2>ASMS Event Management System</h2>
		<p class="lead">Welcome to AEMS. Here you'll be able to register for upcoming professional development events at the Australian Science and
			Mathematics School.</p>
		<a href="/sign_up"><button class="btn btn-large btn-primary">Sign Up</button></a>
		<a href="/events/all"><button class="btn btn-large btn-danger">Upcoming Events</button></a>
		<a href="/sign_in"><button class="btn btn-large btn-warning">Sign In</button></a>
	</div>
@endsection