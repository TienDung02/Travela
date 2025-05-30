<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
            // [MOD] Thêm điều kiện filter vào query
            $query = Package::query();

            // Tìm kiếm theo từ khóa (giữ lại như bạn có)
            if ($request->has('search') && $request->search != '') {
                $query->where(function($q) use ($request){
                    $q->where('name', 'like', '%' . $request->search .'%')
                    ->orWhere('location', 'like', '%' . $request->search . '%')
                    ->orWhere('desc', 'like', '%' . $request->search . '%');
                });
            }

            // Lọc theo khoảng giá
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Lọc theo đánh giá sao (nếu có cột star)
            if ($request->filled('rating')) {
                $query->whereIn('star', $request->rating);
            }

            $packages = $query->paginate(10);

            return view('frontend.packages.index', compact('packages'));
        }

    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('frontend.packages.show', compact('package'));
    }

}
