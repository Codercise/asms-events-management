<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>ASMS Event Management Web App</title>
  <meta name="viewport" content="width=device-width">
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/bootstrap-responsive.css') }}
    {{ HTML::script('js/jquery-1.9.1.min.js') }}
    {{ HTML::script('js/bootstrap.js')}}
    {{ HTML::script('js/chart.js') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
  <div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <a class="brand pull-left" href="/"><img src="/img/asms-roundel-logo.png" /> ASMS Events</a>
        <div>
          <ul class="nav pull-right">
            <li><a href="/events/all">All Events</a></li>
            <!-- Blade if check for logged in users -->
            @if (Auth::check())
              <li><a href="/user/dashboard">Dashboard</a></li>
              <li><a href="/sign_out">Sign Out</a></li>
            @else
              <li><a href="/sign_up">Sign Up</a></li>
              <li><a href="/sign_in">Sign In</a></li>
            @endif
            <!-- end if -->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="container">
    <div class="span12">
      @yield('content')
    </div>
  </div>
  </div>
  <div class="footer-container">
    <hr />
    <footer class="footer">
      <div class="container">
        <ul class="footer-links">
          <li><a href="#">ASMS Website</a> - </li>
          <li><a href="/contact">Contact</a> - </li>
          <li><a href="/help">Help</a></li>
        </ul>
        <div>
          <a href="http://www.ministers.sa.gov.au"><img src="/img/shrike.png" alt="Piping Shrike ministers logo" /></a>
          <a href="http://www.decd.sa.edu.au"><img src="/img/decd-second-logo.png" alt="D.E.C.D Logo"/></a>
          <a href="http://www.flinders.edu.au"><img src="/img/flinders-logo.jpg" alt="Flinders University logo" /></a>
      </div>
      </div>
    </footer>
  </div>
</body>
</html>