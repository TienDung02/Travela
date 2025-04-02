<div class="container-fluid h-5 mt-2">
    <div id="schedule-response" class="container h-100 text-center">
        <div class="schedule-carousel h-100">

{{--            {{dd($plans)}}--}}
            @foreach($plans as $dayKey => $dayDetails)
                <div class="schedule-item text-center rounded pb-1">
                    <div class="schedule-day bg-light rounded p-1">
                        {{ str_replace(':', '', $dayKey) }}
                    </div>
                </div>
            @endforeach

{{--            {{print_r($plans)}}--}}















            {{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 1--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 2--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 3--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 4--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 5--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="schedule-item text-center rounded pb-1">--}}
{{--                <div class="schedule-day bg-light rounded p-1">--}}
{{--                    Day 6--}}
{{--                </div>--}}
{{--            </div>--}}











        </div>
    </div>
</div>
