<div class="container-fluid h-5 mt-2">
    <div id="schedule-response" class="container h-100 text-center">
        <div class="schedule-carousel h-100">
            @foreach($plans as $dayKey => $dayDetails)
                @php $dayKey_id = str_replace('Ngày ', '', $dayKey); @endphp
                <div class="schedule-item text-center rounded pb-1 target-day"  data-target="myTarget{{$dayKey_id}}">
                    <div class="schedule-day bg-light rounded p-1 ">
                        {{ str_replace(':', '', $dayKey) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="carousel-item active h-100 detailed-schedule mt-2" id="schedule-content">
    @foreach($plans as $day => $activities)
        @php $day_id = str_replace('Ngày ', '', $day)  ; @endphp
        <h4 id="myTarget{{$day_id}}">{{ $day }}</h4>
        @foreach($activities as $activity => $details)
            <div class="middle-border"></div>
            <div class="time fw-bold day-content ps-0" data-day="{{$day_id}}">{{ $activity }}</div>
            @php
    $lastTransport = null; // 🔁 lưu thông tin di chuyển gần nhất
@endphp

            @foreach($details as $detail)
                        @php
                $type = $detail['type'] ?? '';
                $detailInfo = $detail['details'] ?? [];
                        @endphp
                        @if($type === 'Di chuyển' && is_array($detailInfo))
    @php
        $lastTransport = $detailInfo; // lưu để sử dụng cho hoạt động tiếp theo
    @endphp
@endif

                        @if(in_array($type, ['Ăn sáng', 'Ăn trưa', 'Ăn tối', 'Địa điểm tham quan', 'Chỗ ngủ']))
                            <div class="w-100 position-relative h-25 mt-2">
                                <div class="row w-10 h-100 position-absolute start-0 d-flex flex-wrap align-content-center">
                                    <div class="time">
                                        {{ $type }}
                                    </div>
                                </div>
                                <div class="row h-100 w-90 ms-1 position-absolute end-0 border me-1 mb-2 rounded-start">
                                    <a href="#" class="h-100 col-lg-11 p-0 d-flex show-place-modal"
{{--                                                                    @if ($type == 'Địa điểm tham quan' && is_array($detailInfo))--}}
{{--                                                                        data-title="{{ $wikicontent[$detailInfo['Tên địa điểm']]['title'] }}"--}}
{{--                                                                        data-summary="{{ $wikicontent[$detailInfo['Tên địa điểm']]['summary']  ?? '' }}"--}}
{{--                                                                        data-fullcontent = "{{ $wikicontent[$detailInfo['Tên địa điểm']]['fullcontent']  ?? '' }}"--}}
{{--                                                                        data-url = "{{ $wikicontent[$detailInfo['Tên địa điểm']]['url']  ?? '' }}"--}}
{{--                                                                    @endif--}}
                                                    >
                                        <div class="w-35 align-content-center position-relative h-100 p-0">
                                            @if ($type == 'Địa điểm tham quan' && is_array($detailInfo))
                                                <img class="w-75 h-90 ms-2 rounded mt-0" src="{{ asset('frontend/images/image-coming-soon.jpg') }}">
                                            @elseif ($type == 'Ăn sáng' || $type == 'Ăn trưa' || $type == 'Ăn tối')
                                                <img class="w-75 h-90 ms-2 rounded mt-0" src="{{ asset('frontend/images/image-coming-soon.jpg') }}">
                                            @elseif ($type == 'Chỗ ngủ')
                                                <img class="w-75 h-90 ms-2 rounded mt-0" src="{{ asset('frontend/images/image-coming-soon.jpg') }}">
                                            @endif
                                        </div>
                                        <div class="w-65 h-60 m-auto p-0">
                                            @if($type == 'Địa điểm tham quan' && is_array($detailInfo))
                                                <p class="fw-bold">{{ $detailInfo['Tên địa điểm'] ?? '' }}</p>
                                                <p><span class="btn">{{ $detailInfo['Thời gian tham quan'] ?? '' }}</span></p>
                                                <p class="fw-normal">Địa chỉ: {{ $detailInfo['Địa chỉ'] ?? '' }}</p>
                                            @else
                                                <p class="fw-bold">{{ $detailInfo['Tên địa điểm'] ?? '' }}</p>
                                                <p class="fw-normal">Địa chỉ: {{ $detailInfo['Địa chỉ'] ?? '' }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                         
   <div class="d-flex w-100 position-relative h-15 mt-2">
    <div class="w-85 d-flex">
    </div>
    <div class="w-15 p-0 d-flex align-items-center justify-content-center me-2"  >
   @php
    $moTa = '📍 Lịch trình từ Travela';
    if ($lastTransport) {
        $moTa .= ' | 🚗 Di chuyển từ: ' . ($lastTransport['Điểm đi'] ?? '') .
                 ' → ' . ($lastTransport['Điểm đến'] ?? '') .
                 ' | 🕒 ' . ($lastTransport['Thời gian'] ?? '') .
                 ' | 📏 ' . ($lastTransport['Khoảng cách'] ?? '');
        $lastTransport = null; // ✅ dùng xong thì xóa
    }
@endphp

<form class="add-calendar-form">
    @csrf
    <input type="hidden" name="title" value="{{ $detailInfo['Tên địa điểm'] ?? 'Hoạt động' }}">
    <input type="hidden" name="location" value="{{ $detailInfo['Địa chỉ'] ?? '' }}">
    <input type="hidden" name="description" value="{{ $moTa }}">
    <input type="hidden" name="time_range" value="{{ $detailInfo['Thời gian tham quan'] ?? '08:00 -> 10:00' }}">
    <input type="hidden" name="day_index" value="{{ ((int)$day_id) - 1 }}">
      <input type="hidden" name="type" value="{{ $activity }}"> {{-- ✅ Đây mới là đúng "Sáng/Trưa/Chiều/Tối" --}}
    <button type="submit" class="btn btn-sm btn-outline-success">+ Google Calendar</button>
</form>


    </div>
</div>
                        @elseif($type == 'Di chuyển' && is_array($detailInfo))
                            <div class="w-100 position-relative h-auto mt-2 d-flex justify-content-between align-items-center">
                                <div class="row w-10 start-0 d-flex flex-wrap align-content-center">
                                    <div class="time">
                                        {{ $type }}
                                    </div>
                                </div>
                                <div class="row h-100 w-90 ms-1 end-0 border me-1 rounded align-items-center">
                                    <div class="h-100 w-85">
                                        <div class="w-100 h-100 p-0 d-flex align-content-center">
                                            @php
                                                $vehicle = $detailInfo['Phương tiện di chuyển'] ?? '';
                                            @endphp
                                            @if($vehicle == 'Motorbike')
                                                <i class="fa-solid fa-motorcycle" style="font-size: 1.25rem; align-content: center; margin-right: 1rem;"></i>
                                            @elseif(in_array($vehicle, ['Car', 'Unknown']))
                                                <i class="fa-solid fa-car-side" style="font-size: 1.25rem; align-content: center; margin-right: 1rem;"></i>
                                            @elseif(in_array($vehicle, ['Bicycle']))
                                                <i class="fa-solid fa-bicycle" style="font-size: 1.25rem; align-content: center; margin-right: 1rem;"></i>
                                            @elseif(in_array($vehicle, ['Public transport']))
                                                <i class="fa-solid fa-bus" style="font-size: 1.25rem; align-content: center; margin-right: 1rem;"></i>
                                            @endif
                                            <div class="d-flex flex-wrap align-items-center h-75 m-auto mx-0 pe-2">
                                                {{ $detailInfo['Điểm đi'] ?? '' }}
                                                <i class="bi bi-arrow-right" style="font-size: 1rem; margin: 0 0.75rem;"></i>
                                                {{ $detailInfo['Điểm đến'] ?? '' }}
                                            </div>
                                            <div class="px-2 d-flex flex-wrap h-75 m-auto mx-0 align-items-center border-start">
                                                {{ $detailInfo['Thời gian'] ?? '' }}
                                            </div>
                                            <div class="px-2 d-flex flex-wrap h-75 m-auto mx-0 align-items-center border-start">
                                                {{ $detailInfo['Khoảng cách'] ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-100 w-15 p-0">
                                        <div class="btn w-100 btn-primary h-100 p-0 align-content-center white text-center requestAndDisplayRoute" data-ori-lat="{{$detailInfo['origin_lat'] ?? ''}}" data-ori-lon="{{$detailInfo['origin_lon'] ?? ''}}" data-de-lat="{{$detailInfo['destination_lat'] ?? ''}}" data-de-lon="{{$detailInfo['destination_lon'] ?? ''}}">Xem đường đi</div>
                                    </div>
                                </div>
                            </div>
                        @endif
            @endforeach
{{--            </div>--}}
        @endforeach
    @endforeach
</div>

@include('frontend.schedule.ajax.calendar-preview')
<script>
$(document).ready(function () {
    let previewModal = new bootstrap.Modal(document.getElementById('previewModal'));

    // ✅ Khi bấm nút Google Calendar → mở modal và đổ dữ liệu
    $('.add-calendar-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serializeArray();
        let modal = $('#previewModal');

        // Reset các input trong modal
        modal.find('input, textarea').val('');

        // Gán lại dữ liệu vào modal
        formData.forEach(item => {
            modal.find(`[name="${item.name}"]`).val(item.value);
        });

        // Lưu lại formData tạm (nếu cần dùng sau)
        window._currentFormData = formData;

        previewModal.show();
    });

    // ✅ Khi nhấn "Xác nhận thêm"
    $('#confirmAddForm').on('submit', function (e) {
        e.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: "{{ route('calendar.add') }}",
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (res) {
                alert('✅ Đã thêm sự kiện vào Google Calendar!');
                previewModal.hide();
            },
            error: function (xhr) {
                let res = xhr.responseJSON;
                let msg = res?.message || '❌ Lỗi khi thêm lịch!';
                alert(msg);

                if (xhr.status === 401 && res?.redirect) {
                    let currentUrl = window.location.href;
                    let redirectBack = encodeURIComponent(currentUrl);
                    let finalRedirect = res.redirect + '?redirect_back=' + redirectBack;
                    window.location.href = finalRedirect;
                }
            }
        });
    });
});
</script>
