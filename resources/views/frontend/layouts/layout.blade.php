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
        <script>
            $(document).ready(function() {
                console.log('aaaaaaa'); // Đảm bảo dòng này nằm trong đây

                // Khai báo clickedMarker ở phạm vi mà hàm click có thể truy cập được
                let clickedMarker = null;

                $('.redirect').click(function() {
                    const lat = parseFloat($(this).data('lat'));
                    const lon = parseFloat($(this).data('lon'));
                    console.log('lat ');
                    console.log('bbbbbb ');

                    if (!isNaN(lat) && !isNaN(lon) && map) {
                        // ... (phần còn lại của code) ...
                        // Xóa marker cũ (nếu có)
                        if (clickedMarker) {
                            clickedMarker.setMap(null);
                        }
                        // Tạo marker mới
                        clickedMarker = new map4d.Marker({
                            position: { lat: lat, lng: lon },
                            title: "Vị trí",
                            label: { text: "!", color: "white" },
                            icon: {
                                url: "URL_CỦA_ICON_TÙY_CHỈNH",
                                size: { width: 32, height: 32 },
                                anchor: { x: 16, y: 32 }
                            }
                        });
                        clickedMarker.setMap(map);
                    } else if (!map) {
                        console.error("Map4D is not initialized yet. Click event will not work.");
                    } else {
                        console.warn("Invalid latitude or longitude in data attributes.");
                    }
                });
            });
        </script>
    </body>
</html>
