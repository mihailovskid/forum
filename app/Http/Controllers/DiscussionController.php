<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $discussions = Discussion::all();
        } else {
            $discussions = Discussion::where('status', 1)->get();
        }

        $is_approval_required = Discussion::where('status', 0)->get()->count();

        return view('discussions.index', compact('discussions', 'is_approval_required'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('discussions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => ['required', 'min:3'],
            'img_url'       => ['required'],
            'description'   => ['required'],
            'category'      => ['required', 'exists:categories,id']
        ]);

        $params = [
            'title'         => $request->input('title'),
            'img_url'       => $request->input('img_url'),
            'description'   => $request->input('description'),
            'category_id'   => $request->input('category'),
            'user_id'       => Auth::id()
        ];

        $discussion = Discussion::create($params);

        if ($discussion) {
            return redirect()->route('discussions.index')->with('success', 'Discussion is successfully created. It needs to be approved before you dig into it though!');
        }

        return redirect()->route('discussions.create')->with('error', 'Error ocured, please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Discussion $discussion)
    {
        $categories = Category::all();

        return view('discussions.edit', compact('discussion', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        $request->validate([
            'title'         => ['required', 'min:3'],
            'img_url'       => ['required'],
            'description'   => ['required'],
            'category'      => ['required', 'exists:categories,id']
        ]);

        $params = [
            'title'         => $request->input('title'),
            'img_url'       => $request->input('img_url'),
            'description'   => $request->input('description'),
            'category_id'   => $request->input('category')
        ];

        $updated = $discussion->update($params);

        if ($updated) {
            return redirect()->route('discussions.index')->with('success', 'Discussion is successfully updated.');
        }

        return redirect()->route('discussions.edit', $discussion)->with('error', 'Error ocured, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Discussion $discussion)
    {
        $deleted = $discussion->delete();

        if ($deleted) {
            return redirect()->route('discussions.index')->with('success', 'Discussion is successfully deleted.');
        }

        return redirect()->route('discussions.index')->with('error', 'Error ocured, please try again.');
    }

    public function approve(Request $request, Discussion $discussion)
    {
        $updated = $discussion->update([
            'status' => 1
        ]);

        if ($updated) {
            return redirect()->route('discussions.index')->with('success', 'Discussion is successfully approved.');
        }

        return redirect()->route('discussions.index')->with('error', 'Error ocured, please try again.');
    }
}
