<div id="tab-all" class="tab-pane fade show p-0 active">
    <div id="destination-container" class="row g-4 d-flex">
        <div class="col-xl-12">
            <div id="loading" class="row g-4">
                @foreach($places as $place)
                    <div class="col-lg-4 destination-item">
                        <div class="destination-img">
                            @foreach($place->placeMedia as $media)
                                @if($media->is_primary == 1)
                                    <img class="img-fluid rounded w-100"
                                         src="{{ asset($media->media) }}"
                                         alt="{{ $place->name }}" data-a="{{$place->id}}">
                                @endif
                            @endforeach
                            <div class="destination-overlay p-4">
                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3" data-id="{{$place->id}}">
                                    {{$place->placeMedia->count()}} Photos
                                </a>
                                <h4 class="text-white mb-2 mt-3">{{$place->name}}</h4>
                                <a href="#" class="btn-hover text-white view-all-place-btn" data-province="">
                                    View Detail <i class="fa fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                            <div class="search-icon">
                                <a href="
                                        @foreach($place->placeMedia as $media)
                                        @if($media->is_primary == 1){{ asset($media->media) }}
                                        @endif
                                        @endforeach
                                        " data-lightbox="destination-{{$place->id}}">
                                    <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        @if($have_more == 1)
            <span id="get-url" data-url="{{ route('destination.more') }}"></span>
            <div class="w-100 border-bottom margin-bottom-40"><a id="load-more" class="cursor-pointer text-href fw-semibold border-top  pt-2 pb-2 d-flex w-100 justify-content-center" data-next-page="1">Load More </a></div>
        @else
            <div class="w-100 border-bottom margin-bottom-40">
                <div class="d-flex border-top pt-2 pb-2 w-100 justify-content-center fw-semibold">No More Destination</div>
            </div>
        @endif
    </div>
</div>
