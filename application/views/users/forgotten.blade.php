@layout('layouts/main')
@section('content')
  <h1>You forgot your password?!</h1>
  <p>Oh bother you've forgotten your password!</p>

  <p>If you'd like us to reset your password just type your email into the box below and we'll send you a brand new shiny password. If you don't have access to that you're going to
    have to contact our support desk and see if the nice folk can give you some details so you'll be back in and living the high life.</p>
  {{Form::open('user/forgotten', 'POST')}}
  {{Form::text('email', '', array('class' => 'span5', 'placeholder' => 'The email address you use to log in'))}}
  <div><a href="#passwordModal" data-toggle="modal"><button class="btn btn-danger">Reset Password</button></a></div>
    <div id="passwordModal" class="modal hide">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3>Are you super sure?</h3>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to <strong>reset</strong> your password?</p>
    </div>
    <div class="modal-footer">
      {{ Form::submit('Yes I want to reset my password', array('class' => 'btn btn-primary')) }}
      <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Get me out of here!</a>
    </div>
  </div>
  {{Form::close()}}
@endsection