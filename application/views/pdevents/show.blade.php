@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')

  <div class="offset2 span9 dashboard">
    <h1>{{$pdevent_details['Name']}}</h1>
    <p class="lead">{{$pdevent_details['Description']}}</p>
      @if (!is_null(Session::get('status')))
        <p class='alert alert-info'><?php echo Session::get('status'); ?></p>
      @endif
    <table class="table">
      @foreach($pdevent_details as $key => $detail)
        <tr>
          <td class="span2"><strong>{{$key}}</strong></td>
          <td>{{$detail}}</td>
        </tr>
      @endforeach
    </table>
    @include('layouts/event_attend_modal')
    @include('layouts/event_action_buttons')
  </div>
@endsection