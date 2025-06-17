<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image" sizes="25x25" href="{{asset('/backend/images/uploads/logo2-resize.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.js') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-…" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/js/all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/uf-style.css') }}">
    <title>Travela Admin Login</title>
  </head>
  <body>
    <div class="uf-form-signin" style="    margin-top: 10rem !important;">
        <div class="text-center">
            <a><img src="{{asset('/backend/images/uploads/logo2-resize.png')}}" alt=""></a>
            <h1 class="text-white h3 mt-3">Account Login </h1>
        </div>
        <form class="mt-4" method="POST" action="{{route('backend.login')}}">
            @csrf
            <div class="input-group uf-input-group input-group-lg mb-3">
                <span class="input-group-text fa fa-user"></span>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group uf-input-group input-group-lg mb-3">
                <span class="input-group-text fa fa-lock"></span>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            @if (isset(session('alert_login_fail')['alert__text']))
                <p class="text-center text-danger">Username or password incorrect</p>
                @php
                    $userData = Illuminate\Support\Facades\Session::get('alert_login_fail', []);
                    unset($userData['alert__text']);
                    Illuminate\Support\Facades\Session::put('alert_login_fail', $userData);
                @endphp
            @endif
           
            <div class="d-grid mb-4">
                <button type="submit" class="btn uf-btn-primary btn-lg">Login</button>
            </div>
        </form>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js'></script>
    <script src='{{asset("backend/js/func.js")}}'></script>
@if (isset(session('alert_change_password')['alert_type']))
    <script>
        alert_after_load('{{session('alert_change_password')['alert_title']}}', '{{session('alert_change_password')['alert_type']}}', '{{session('alert_change_password')['alert_text']}}', '{{session('alert_change_password')['alert_reload']}}')
        @php
            $userData = Illuminate\Support\Facades\Session::get('alert_sendMail', []);
            unset($userData['alert_title']);
            unset($userData['alert_type']);
            unset($userData['alert_text']);
            unset($userData['alert_reload']);
            Illuminate\Support\Facades\Session::put('alert_change_password', $userData);
        @endphp
    </script>
@endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  </body>
</html>