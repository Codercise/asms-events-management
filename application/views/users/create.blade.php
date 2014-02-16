@layout('layouts/main')
@section('content')
    {{Form::open('users/create', 'POST', array('id' => 'sign-up-form', 'class' =>'sign-up-form'))}}
    <legend>Create a new account</legend>
    <p>If you've just forgotten your password or email address you don't need to make a new account. <a href="/user/forgotten">Use the forgotten password form</a></p>
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
      {{Form::text('first_name', '', array('placeholder' => "Your lovely first name"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('last_name', "Last Name: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('last_name', '', array('placeholder' => "Your beautiful family name, thank you"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('email', "Email: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('email', '', array('placeholder' => "You'll use this to log in"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('password', "Password: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::password('password', array('placeholder' => "Something super safe (8-20) characters"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('password_confirmation', "Password Confirmation: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::password('password_confirmation', array('placeholder' => "Enter your password again, champ"))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('contact_number', "Contact Number: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('contact_number', '', array('placeholder' => 'Mobile numbers or land lines are okay. Just the numbers no symbols, please. '))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('privacy_policy', "Privacy Policy: ", array('class' => 'control-label'))}}
      <div class="controls">
        <p style="float: left; margin-left: 0px;"><a href="#">By signing up to the ASMS Events Application you agree to the DECD Privacy policy</a></p>
        <?php echo Form::checkbox('privacy_policy', 'accepted', false, array('style' => 'width: 6%; margin-top: -1px;')) ?>
      </div>
      </div>
    <div class='row'>
    {{Form::submit('Sign Me Up!', array('class' => 'btn btn-primary'))}}
    {{Form::reset('I want to try again', array('class' => 'btn btn-warning'))}}
    {{Form::close()}}
    </div>

    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript">

    //This code is used for validating the user sign up form with jQuery however there are issues with the correct results being
    //returned, it would give incorrect errors for min/max values. This will need to be fixed
       (function(){
        //contact form validation
            var $form = $('#sign-up-form');

            $form.validate({
                //rules to test input
                rules: {
                    first_name: {
                        required: true,
                        //max: 20
                    },
                    last_name: {
                        required: true,
                        //max: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        //min: 8,
                        //max: 20,
                    },
                    title: "required",
                    position: "required",
                    gender: "required",
                    contact_number: "required",
                    years_taught: "required",
                    organization_name: "required",
                    sector: "required",
                },
                messages: {
                    title: "How should we refer to you?",
                    first_name: {
                        required: "Whoa, don't forget your first name",
                        max: "That's a very long name you have, is there a shorter version we could have?",
                    },
                    last_name: {
                        required: "Looks like you forgot to fill in your last name",
                        max: "Your last name is pretty big, can we have a shoter version?",
                    },
                    email: {
                        required: "Slow down sparky, we'll need an email to log you in",
                        email: "Looks like you didn't enter a proper email format",
                    },
                    password: {
                        required: "You'll need a password to stop baddies from stealing your info",
                        min: "Make your password a bit longer to make it super secure (minimum 8 characters)",
                        max: "Whoa whoa whoa, that password is a little too secure for us, shorten it please (maximum 20 characters)",
                    },
                    position: "Can you let us know your position title",
                    gender: "Please select a gender",
                    contact_number: "We'll use your contact number if we need to call you",
                    years_taught: "What level of students do you deal with? You can answer N/A",
                    organization_name: "Where are you visiting from?",
                    sector: "We'd love to know what sector you're from."
                },
                errorElement: 'p',
                errorClass: "alert alert-error",
                errorContainer: ".validation-errors",
                errorLabelContainer: ".validation-errors",

                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });
        })();
        //end contact form validation*/
    </script>
@endsection