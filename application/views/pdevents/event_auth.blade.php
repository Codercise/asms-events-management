@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')
<div class="offset1 span7 dashboard">
  {{Form::open("/event/{$pdevent->id}", 'POST', array('class' => 'dashboard-form event-form'))}}
    <legend>Please enter the password for <strong>{{$pdevent->name}}</strong></legend>
    <div class="control-group">
    {{Form::label('password', "Event Password: ", array('class' => 'control-label'))}}
    @if (!is_null(Session::get('status')))
      <p class='alert alert-danger'><?php echo Session::get('status') ?></p>
    @endif
    <div class="controls">
    {{Form::password('password', array('placeholder' => 'You should have received this from the facilitator'))}}
    </div>
    </div>

    <div class="control-group">
      <div class="controls">
        {{Form::submit('Submit Password', array('class' => 'btn btn-primary', 'style' => 'width:20%;'))}}
      </div>
    </div>
  {{Form::close()}}
</div>
@endsection