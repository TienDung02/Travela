<?php

namespace App\Http\Controllers\frontend;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController
{
    public function index()
    {
        $Destinations = Destination::all();
        return view('frontend.destination.index', compact('Destinations'));
    }
    public function detail(Request $request, $id)
    {
        $Destination = Destination::query()->findOrFail($id);
//        $blog_comments = Destination::query()->where('blog_id', $id)->where('reply_to', 0)->paginate(3);
//        $reply_comments = Destination::query()->get();
//        $have_more = 1;
//        $blog_comments_next = Destination::query()->where('blog_id', $id)->where('reply_to', 0)->get();
//        if ($blog_comments_next->isEmpty()) {
//            $have_more = 0;
//        }
        return view('frontend.destination.detail', compact('Destination'));
    }
}
