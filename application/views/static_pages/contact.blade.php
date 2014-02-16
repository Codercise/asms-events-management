@layout('layouts/main')
@section('content')
  <div class="page-header">
    <h1>Contact Us</h1>
  </div>
  <div class="contact-form">
    <?php
      echo Form::open('', 'POST', array('class' => 'contact-form'));
      echo "<div class='control-group'>".
        Form::label('email', 'E-Mail Address', array('class' => 'control-label')).
        "<div class='controls'>".
        Form::text('email', '').
        "</div></div>";

      echo "<div class='control-group'>".
        Form::label('subject', 'Subject', array('class' => 'control-label')).
        "<div class='controls'>".
        Form::select('subject',
        array('' => 'Reason for Contact',
              'General Inquiry' => 'General Inquiry',
              'Registration' => 'Registration',
              'Payments' => 'Payments')).
        "</div></div>".
        "<div class='control-group'>".
        Form::label('message', 'Message', array('class' => 'control-label')).
        "<div class='controls'>".
        Form::textarea('message', '', array('class' => 'contact-message')).
        "</div></div>".
        "<div class='controls'>".
        Form::submit('Send Form', array('class' => 'btn btn-primary')).
        " ".
        Form::reset('Reset Form', array('class' => 'btn btn-danger')).
        "</div>".
        Form::close();
    ?>
  </div>
@endsection