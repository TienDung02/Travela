@extends('frontend.layouts.layout')

@section('content')
    <div class="container">
        <h2>Tìm kiếm địa điểm</h2>

        {{-- Form tìm kiếm --}}
        <form action="{{ route('map2') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="address" class="form-control" placeholder="Nhập địa điểm..." required>
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        {{-- Hiển thị kết quả tìm kiếm --}}
        @if(isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @elseif(isset($data))
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $data['formatted_address'] }}</h4>
                    <p><strong>Kinh độ:</strong> {{ $data['geometry']['location']['lng'] }}</p>
                    <p><strong>Vĩ độ:</strong> {{ $data['geometry']['location']['lat'] }}</p>

                    {{-- Hiển thị bản đồ --}}
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- Nhúng Leaflet.js để hiển thị bản đồ --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @if(isset($data))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var map = L.map('map').setView([{{ $data['geometry']['location']['lat'] }}, {{ $data['geometry']['location']['lng'] }}], 14);

                // Thêm tile từ OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Thêm marker vào vị trí
                L.marker([{{ $data['geometry']['location']['lat'] }}, {{ $data['geometry']['location']['lng'] }}])
                    .addTo(map)
                    .bindPopup('{{ $data['formatted_address'] }}')
                    .openPopup();
            });
        </script>

    @endif
@endsection
