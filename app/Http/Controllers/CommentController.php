<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($idr)
    {
        
        $rid = $idr;
        return view('reels.comment', compact('rid'));
    }
    public function store(Request $request)
    {
        Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->uid,
            'reel_id' => $request->rid,
        ]);
    }
}
