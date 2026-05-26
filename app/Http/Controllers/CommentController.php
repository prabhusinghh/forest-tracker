<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Report;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, $report_id)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $report = Report::findOrFail($report_id);

        Comment::create([
            'user_id' => auth()->id(),
            'report_id' => $report->id,
            'body' => $request->body
        ]);

        return redirect()->back()->with('success', 'Your comment has been added!');
    }
}
