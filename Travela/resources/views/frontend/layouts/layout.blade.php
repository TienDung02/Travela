<!DOCTYPE html>
<html lang="en">

@include('frontend.component.head')

<div id="app">
    @yield('content')
</div>


@include('.frontend.component.script')
<script>
    document.addEventListener('livewire:load', function () {
        $('.create_conversation').on('click', function() {
            const id = $(this).data('id');
            Livewire.emit('createConversation', id);
            console.log('Sự kiện đã phát: createConversation với ID:', id);

        });
    });
</script>
@if (isset(session('alert_')['alert_type']))
    <script>
        alert_after_load('{{session('alert_')['alert_title']}}', '{{session('alert_')['alert_type']}}', '{{session('alert_')['alert_text']}}', '{{session('alert_')['alert_reload']}}')
        @php
            $userData = Illuminate\Support\Facades\Session::get('alert_', []);
            unset($userData['alert_title']);
            unset($userData['alert_type']);
            unset($userData['alert_text']);
            Illuminate\Support\Facades\Session::put('alert_', $userData);
        @endphp
    </script>
@endif
@if (isset(session('alert_2')['alert_type']))
    <script>
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
