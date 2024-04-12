@extends('layouts.app')

@section('title', 'Show')

@section('content')
   <div class="bg-light min-vh-100">
        <div class="container">
            <div class="text-center">
                <div class="py-5">
                    <h2>Welcome to forum</h2>
                </div>
                <div class="card mb-3">
                    <div class="d-flex text-muted ms-auto me-5 mt-5 mb-3">
                        <p class="m-0 ms-2">{{ $discussion->category->name }}</p>
                        <span class="ms-2">|</span>
                        <p class="m-0 ms-2">{{ $discussion->user->username }}</p>
                    </div>
                <div class="my-3">
                        <img src="{{ $discussion->img_url }}" class="card-img-top mx-auto" alt="img" style="width: 500px">
                </div>
                    <div class="card-body text-start col-8 offset-2 mb-2">
                        <h5 class="card-title">{{ $discussion->title }}</h5>
                        <p class="card-text text-muted">{{ $discussion->description }}</p>
                    </div>
                </div>
            </div>
            <h2 class="mb-4">Comments:</h2>
            @if(auth()->user())
            <a href="{{ route('discussions.comments.create', $discussion) }}" class="btn btn-secondary">Add comment</a>
            @endif
            @forelse($discussion->comments as $comment)
                <div class="my-3">
                    <div class="card">
                        <div class="card-body align-items-center justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">{{ $comment->user->username }} says:</p>
                                    <p class="m-0 ms-2">{{ $comment->created_at }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="card-text text-muted mb-0">{{ $comment->comment }}</p>
                                @if(auth()->user() && (auth()->user()->is_admin || $comment->user_id == auth()->user()->id))
                                <a href="{{ route('discussions.comments.edit', [$discussion, $comment]) }}"><i class="fa-solid fa-pen-to-square text-dark ms-4"></i></a>
                                <form action="{{ route('discussions.comments.destroy', [$discussion, $comment]) }}" method="POST" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-white"> <i class="fa-solid fa-trash-can"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>      
                </div>
            @empty
            <div class="text-center py-5 text-muted">
                <p>There are no comments yet!</p>
            </div>
            @endforelse
           
        </div>
   </div>
@endsection