@layout('layouts/main')
@section('content')
    @if (!is_null(Session::get('status')))
    <p class='alert alert-success'><?php echo Session::get('status') ?></p>
    @endif

@include('layouts/user_dashboard_menu')

  <div class="offset2 span9 dashboard">
    <div class="row span7">
    {{Form::open('event/create', '', array('class' => 'form-horizontal dashboard-form event-form'))}}
      <legend>Create an event</legend>
      <div class="validation-errors">
        @foreach ($errors->all('<p class="alert alert-error">:message</p>') as $error)
          {{$error}}
        @endforeach
      </div>

      <div class="control-group">
      {{Form::label('event_name', "Event Name*: ", array('class' => 'control-label required'))}}
      <div class="controls">
      {{Form::text('event_name', '', array('placeholder' => 'Something descriptive yet simple'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('description', "Event Description*: ", array('class' => 'control-label required'))}}
      <div class="controls">
      {{Form::text('description', '', array('placeholder' => 'You can talk a bit more about your event here'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('venue_address', "Venue Address*: ", array('class' => 'control-label required'))}}
      <div class="controls">
      {{Form::text('venue_address', '', array('placeholder' => 'ASMS - Sturt Campus, Flinders University'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('cost', "Cost (AUD): ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('cost', '', array('placeholder' => 'Leave blank for $0'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('password', "Event Password: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::password('password', array('placeholder' => 'Leave blank for no password'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('Category', "Event Category: ", array('class' => 'control-label'))}}
      <div class="controls">
      <?php echo Form::select('category', array(
        '' => 'Select Category',
        'Professional Development' => "Professional Development"
        )); ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('available_spaces', "Available Spaces: ", array('class' => 'control-label'))}}
      <div class="controls">
      {{Form::text('available_spaces', "", array('placeholder' => 'Must be a number. Eg: "6", "20" or "105". Leave blank for unlimited.'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('facilitator', "Facilitator*: ", array('class' => 'control-label required'))}}
      <div class="controls">
      {{Form::text('facilitator', '', array('placeholder' => 'Who is running the event?'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('contact_number', "Contact Number*: ", array('class' => 'control-label required'))}}
      <div class="controls">
      {{Form::text('contact_number', '', array('placeholder' => '(xx)-xxxx-yyyy'))}}
      </div>
      </div>

      <div class="control-group">
      {{Form::label('date', "Date (DD/MM/YYYY): ", array('class' => 'control-label'))}}
      <div class="controls event-time">
      <?php
        echo Form::select('event_day', array(
          '-'  => '',
          '01' => '01',
          '02' => '02',
          '03' => '03',
          '04' => '04',
          '05' => '05',
          '06' => '06',
          '07' => '07',
          '08' => '08',
          '09' => '09',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          '13' => '13',
          '14' => '14',
          '15' => '15',
          '16' => '16',
          '17' => '17',
          '18' => '18',
          '19' => '19',
          '20' => '20',
          '21' => '21',
          '22' => '22',
          '23' => '23',
          '24' => '24',
          '25' => '25',
          '26' => '26',
          '27' => '27',
          '28' => '28',
          '29' => '29',
          '30' => '30',
          '31' => '31'
        ));

        echo Form::select('event_month', array(
          '-'  => '',
          '01' => '01',
          '02' => '02',
          '03' => '03',
          '04' => '04',
          '05' => '05',
          '06' => '06',
          '07' => '07',
          '08' => '08',
          '09' => '09',
          '10' => '10',
          '11' => '11',
          '12' => '12'
        ));

        echo Form::select('event_year', array(
          '-'    => '',
          '2013' => '2013',
          '2014' => '2014',
          '2015' => '2015',
          '2016' => '2016',
          '2017' => '2017',
          '2018' => '2018',
          '2019' => '2019',
          '2020' => '2020',
          '2021' => '2021',
          '2022' => '2022',
          '2023' => '2023'
        ), array('style' => 'width:50%;'));
      ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('start_time', "Start Time (24hr time): ", array('class' => 'control-label'))}}
      <div class="controls event-time">
      <?php
        echo Form::select('start_hour', array(
          '' => '-',
          '00' => '00',
          '01' => '01',
          '02' => '02',
          '03' => '03',
          '04' => '04',
          '05' => '05',
          '06' => '06',
          '07' => '07',
          '08' => '08',
          '09' => '09',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          '13' => '13',
          '14' => '14',
          '15' => '15',
          '16' => '16',
          '17' => '17',
          '18' => '18',
          '19' => '19',
          '20' => '20',
          '21' => '21',
          '22' => '22',
          '23' => '23'
        ));

        echo Form::select('start_minute', array(
          '' => '-',
          '00' => '00',
          '05' => '05',
          '10' => '10',
          '15' => '15',
          '20' => '20',
          '25' => '25',
          '30' => '30',
          '35' => '35',
          '40' => '40',
          '45' => '45',
          '50' => '50',
          '55' => '55',
        ));

      ?>
      </div>
      </div>

      <div class="control-group">
      {{Form::label('end_time', "End Time (24hr time): ", array('class' => 'control-label'))}}
      <div class="controls event-time">
      <?php
        echo Form::select('end_hour', array(
          '' => '-',
          '00' => '00',
          '01' => '01',
          '02' => '02',
          '03' => '03',
          '04' => '04',
          '05' => '05',
          '06' => '06',
          '07' => '07',
          '08' => '08',
          '09' => '09',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          '13' => '13',
          '14' => '14',
          '15' => '15',
          '16' => '16',
          '17' => '17',
          '18' => '18',
          '19' => '19',
          '20' => '20',
          '21' => '21',
          '22' => '22',
          '23' => '23'
        ));

        echo Form::select('end_minute', array(
          '' => '-',
          '00' => '00',
          '05' => '05',
          '10' => '10',
          '15' => '15',
          '20' => '20',
          '25' => '25',
          '30' => '30',
          '35' => '35',
          '40' => '40',
          '45' => '45',
          '50' => '50',
          '55' => '55',
        ));
      ?>
      </div>
      </div>

      <div class="row span10">
      {{Form::submit('Create Event', array('class' => 'btn btn-primary'))}}
      {{Form::reset('Reset', array('class' => 'btn btn-danger'))}}
    {{Form::close()}}
    </div>
  </div>
  </div>
@endsection