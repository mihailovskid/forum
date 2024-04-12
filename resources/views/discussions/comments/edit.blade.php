@extends('layouts.app')

@section('title', 'Edit comment')

@section('content')
<main class="bg-light min-vh-100">
    <div class="container">
        <h2 class="py-5">Edit comment</h2>
        <form action="{{ route('discussions.comments.update', [$discussion, $comment]) }}" method="POST" class="w-50 pt-5 mx-auto">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="comment" class="form-control" name="comment">{{ old('comment', $comment->comment) }}</textarea>
                @error('comment')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
@endsection
