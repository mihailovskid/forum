<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Discussion $discussion)
    {
        return view('discussions.comments.create', compact('discussion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'comment'         => ['required', 'min:5']
        ]);

        $params = [
            'comment'       => $request->input('comment'),
            'user_id'       => Auth::id(),
            'discussion_id' => $discussion->id
        ];
        $created = Comment::create($params);

        if ($created) {
            return redirect()->route('discussions.show', $discussion)->with('success', 'Comment is successfully created.');
        }

        return redirect()->route('discussions.show', $discussion)->with('error', 'Error ocured, please try again.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Discussion $discussion, Comment $comment)
    {
        return view('discussions.comments.edit', compact('discussion', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion, Comment $comment)
    {
        $request->validate([
            'comment'   => ['required', 'min:5']
        ]);

        $updated = $comment->update([
            'comment' => $request->input('comment')
        ]);

        if ($updated) {
            return redirect()->route('discussions.show', $discussion)->with('success', 'Comment is successfully updated.');
        }

        return redirect()->route('discussions.show', $discussion)->with('error', 'Error ocured, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Discussion $discussion, Comment $comment)
    {
        $deleted = $comment->delete();

        if ($deleted) {
            return redirect()->route('discussions.show', $discussion)->with('success', 'Comment is successfully deleted.');
        }

        return redirect()->route('discussions.show', $discussion)->with('error', 'Error ocured, please try again.');
    }
}
