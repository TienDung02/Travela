<!DOCTYPE html>
<html lang="en">

@include('frontend.component.head')
{{--<div class="clearfix"></div>--}}

{{--@if(auth()->check())--}}
{{--    @include('frontend.component.header_2')--}}
{{--@else--}}
{{--    @include('frontend.component.header')--}}
{{--@endif--}}
<div id="app">
    @yield('content')
</div>
<!-- Footer
================================================== -->
{{--<div class="margin-top-15"></div>--}}

{{--@include('.frontend.component.footer')--}}

<!-- Back To Top Button -->
{{--<div id="backtotop" class="d-none"><a href="#"></a></div>--}}


{{--</div>--}}
<!-- Wrapper / End -->
<!-- Scripts
================================================== -->

@include('.frontend.component.script')

</body>
</html>
