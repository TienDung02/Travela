{{-- // [NEW] Filter component for package list --}}
<form method="GET" action="{{ route('packages.index') }}">
    <div class="mb-4">
        <label>Price range (VND)</label>
        <input type="number" name="min_price" class="form-control mb-2" placeholder="from"
               value="{{ request('min_price') }}">
        <input type="number" name="max_price" class="form-control" placeholder="to"
               value="{{ request('max_price') }}">
    </div>

    <div class="mb-4">
        <label>Rating</label><br>
        @for($i = 1; $i <= 5; $i++)
            <div class="form-check">
                <input type="checkbox" name="rating[]" value="{{ $i }}" class="form-check-input" id="rating{{ $i }}"
                       {{ in_array($i, (array) request('rating', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="rating{{ $i }}">{{ $i }} star(s)</label>
            </div>
        @endfor
    </div>

    <button type="submit" class="btn btn-primary w-100">Apply filters</button>
</form>
