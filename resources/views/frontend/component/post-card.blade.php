<div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4 mb-4">
    <div class="flex items-center mb-2">
        <img src="{{ asset($post->user->avatar ?? 'images/default-avatar.png') }}" class="w-10 h-10 rounded-full me-2" style="width:40px; height:40px;">
        <div>
            <p class="fw-bold mb-0">{{ $post->user->fullname }}</p>
            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>
    </div>

    <p class="mb-2">{{ $post->caption }}</p>

    @if($post->media && $post->media->count())
        <div class="row g-2 mb-2">
            @foreach($post->media->take(4) as $index => $media)
                <div class="col-6 position-relative">
                    <img src="{{ $media->media }}" class="img-fluid rounded w-100" alt="media {{ $index + 1 }}">
                    @if($index == 3 && $post->media->count() > 4)
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white fw-bold fs-4 rounded">
                            +{{ $post->media->count() - 4 }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex justify-content-between text-muted fs-6 mt-2">
        <span>❤️ {{ $post->likes->count() }} likes</span>
        <span>💬 {{ $post->comments->count() }} comments</span>
        <span>🔗 Share</span>
    </div>
</div>
