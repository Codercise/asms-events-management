@layout('layouts/main')
@section('content')
  {{Form::open('sessions/create', 'POST', array('class' => 'sign-in-form'))}}
    <h2>Sign In</h2>
    <div class="validation-errors">
      @if (!is_null(Session::get('status')))
        <p class='alert alert-danger'><?php echo Session::get('status') ?></p>
      @endif
    </div>
    {{Form::label('email', 'Email')}}
    {{Form::text('email', '', array('placeholder' => 'The email you signed up with is..'))}}

    {{Form::label('password', 'Password')}}
    {{Form::password('password', array('placeholder' => '8-20 characters, you know this one.'))}}

    <div class='row'>
      {{Form::submit('Sign In', array('class' => 'btn btn-primary'))}}
      {{Form::reset('Reset Form', array('class' => 'btn btn-warning'))}}
      {{Form::close()}}
    </div>
    <div><p><a href="/user/forgotten">Forgot your password?</a></p></div>
@endsection