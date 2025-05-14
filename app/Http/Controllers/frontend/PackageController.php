<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query();

        if($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request){
                $q->where('name', 'like', '%' . $request->search .'%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('desc', 'like', '%' . $request->search . '%');
            });
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
