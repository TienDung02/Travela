<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Tour;
use App\Models\Review;

class ReviewController
{
    /**
     * Lưu review mới
     *
     * @param  Request $request
     * @param  string  $type
     * @param  int     $id
     */
    public function store(Request $request, string $type, int $id)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $type = $request->input('type'); // hoặc lấy từ route param
        $modelClass = $type === 'place' ? Place::class : Tour::class;
    
        $model = $modelClass::findOrFail($id);
    
        $model->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);
        
        return back()->with('success', 'Đánh giá đã được thêm');
    }

    /**
     * Xóa (soft delete) một review
     *
     * @param  string  $type
     * @param  int     $id
     * @param  Review  $review
     */
    public function destroy(string $type, int $id, Review $review)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        // Optional: kiểm tra quyền xóa (chủ review hoặc admin)
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Bạn đã xóa đánh giá thành công.');
    }

    /**
     * Helper: chuyển 'places'/'tours' thành Model tương ứng
     */
    protected function resolveModel(string $type): string
    {
        return match ($type) {
            'places' => Place::class,
            'tours'  => Tour::class,
            default  => abort(404),
        };
    }
}