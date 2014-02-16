@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')

  <div class="offset2 span9 dashboard">
  <div class="row span7">
    {{Form::open('users/edit', '', array('class' => 'form-horizontal dashboard-form'))}}
    <legend>Update Your Details <small>Only edit the fields you want to change</small></legend>

    <div class="validation-errors">
        @foreach ($errors->all('<p class="alert alert-error">:message</p>') as $error)
            {{$error}}
        @endforeach
    </div>
      <div class="control-group">
        {{Form::label('title', "Title: ", array('class' => 'control-label'))}}
        <div class="controls">
          <?php echo Form::select('title', array(
            '' => 'Select Your Title',
            'Mr' => 'Mr',
            'Mrs' => 'Mrs',
            'Miss' => 'Miss',
            'Ms' => 'Ms',
            'Dr' => 'Dr',
            'Prof' => 'Prof',
            'Assoc Prof' => 'Assoc Prof',
            'Adj Lec' => 'Adj Lec'
          )) ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('first_name', "First Name: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('first_name', "$user_details[first_name]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('last_name', "Last Name: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('last_name', "$user_details[last_name]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('email', "Email: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('email', "$user_details[email]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('password', "Password: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::password('password', array('placeholder' => "You'll need to enter your password (you can change it here)"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('password_confirmation', "Password Confirmation: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::password('password_confirmation', array('placeholder' => "You'll need to enter your password again (make sure it matches)"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('position', "Position: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('position', "$user_details[position]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('gender', "Gender: ", array('class' => 'control-label'))}}
      <div class="controls">
      <?php echo Form::select('gender', array(
        '' => 'Select Your Gender',
        'M' => 'Male',
        'F' => 'Female',
        'N/A' => 'No Answer'
      )) ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('contact_number', "Contact Number: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('contact_number', "$user_details[contact_number]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('years_taught', "Years Taught: ", array('class' => 'control-label'))}}
      <div class="controls">
      <?php echo Form::select('years_taught', array(
        '' => 'What year levels do you teach? (If more than one pick your favorite)',
        'Primary' => 'Primary',
        'Middle' => 'Middle',
        'Senior Secondary' => 'Senior Secondary',
        'Tertiary' => 'Tertiary',
        'Other' => 'Other'
        )); ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('organization_name', "Organization Name: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('organization_name', "$user_details[organization_name]")}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('sector', "Education Sector: ", array('class' => 'control-label'))}}
      <div class="controls">
      <?php echo Form::select('sector', array(
        '' => 'What education sector are you from?',
        'Public' => 'Public',
        'Catholic Ed' => 'Catholic Ed',
        'Independent' => 'Independent',
        'Tertiary' => 'Tertiary',
        'Other' => 'Other'
        )); ?>
      </div>
      </div>

      <div class="row span10">
      {{Form::submit('Update Your Details', array('class' => 'btn btn-primary'))}}
      {{Form::reset('Reset', array('class' => 'btn btn-danger'))}}
      {{Form::close()}}
      </div>
  </div>
  </div>
@endsection