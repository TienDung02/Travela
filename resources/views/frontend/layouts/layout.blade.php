<!DOCTYPE html>
<html lang="en">

@include('frontend.component.head')

@if(auth()->check())
    @include('frontend.component.top-bar-logged-in')
@else
    @include('frontend.component.top-bar')
@endif

@yield('content')

@include('.frontend.component.script')
@stack('extra_scripts')

@if (isset(session('alert_')['alert__type']))
    <script>
        $(document).ready(function (){
            alert_after_load('{{ session('alert_.alert__type') }}', '{{ session('alert_.alert__title') }}', '{{ session('alert_.alert__text') }}', '{{ session('alert_.alert_reload') }}');
            @php
                $userData = Illuminate\Support\Facades\Session::get('alert_', []);
                unset($userData['alert__title']);
                unset($userData['alert__type']);
                unset($userData['alert__text']);
                Illuminate\Support\Facades\Session::put('alert_', $userData);
            @endphp
        });
    </script>
@endif

@if (isset(session('alert_2')['alert_type']))
    <script>
        console.log('1234')
        alert_after_load_2('{{session('alert_2')['alert_title']}}', '{{session('alert_2')['alert_type']}}', '{{session('alert_2')['alert_reload']}}')
        @php
            $userData = Illuminate\Support\Facades\Session::get('alert_2', []);
            unset($userData['alert_title']);
            unset($userData['alert_type']);
            Illuminate\Support\Facades\Session::put('alert_2', $userData);
        @endphp
    </script>
    @endif
    </body>
</html>
