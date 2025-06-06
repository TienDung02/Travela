<div class="overflow-y-scroll overflow-x-hidden h-100">
    @if(isset($activities))
        @foreach($activities as $activity)
            <div class="w-100 h-30 border me-1 mb-2">
                <div class="row h-100 w-100 ms-1">
                    <a href="#" class="h-100 col-11 p-0 d-flex">
                        <div class="w-35 align-content-center position-relative h-100 p-0">
                            <img class="w-85 h-90 ms-2 rounded mt-0 " src="{{asset('frontend/images/image-coming-soon.jpg')}}">
                        </div>
                        <div class="w-65 h-60 m-auto p-0">
                            <p class="fw-bold">{{$activity['name']}}</p>
                            <p class="">
                                Thời gian hoạt động : {{$activity['date']}}
                            </p>
                        </div>
                    </a>
                    {{--                <a href="#" class="col-lg-1 p-0"><div class=" h-100 p-0 delete align-content-center white"><i class="bi bi-trash"></i></div></a>--}}
                </div>
            </div>
        @endforeach
    @endif
</div>
