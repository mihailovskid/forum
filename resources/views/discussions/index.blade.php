@extends('layouts.app')

@section('title', 'Home')

@section('content')
   <div class="bg-light min-vh-100">
        <div class="container">
            <div class="text-center py-3">
                <h1>Welcome to the Forum</h1>
            </div>
            <div class="pt-5 pb-2">
                <a href="{{ route('discussions.create')}}" class="btn btn-secondary">Add new discussion</a>
            </div>
            @if(auth()->user() && auth()->user()->is_admin && $is_approval_required)
            <div class="my-3">
                <span class="bg-info p-2 rounded text-dark">Approve discussions</span>
            </div>
            @endif
            
            @forelse ($discussions as $discussion)
                <a href="{{ route('discussions.show', $discussion) }}" class="text-decoration-none text-dark">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="p-1">
                                        <img width="150" height="auto" src="{{ $discussion->img_url }}" alt="{{ $discussion->title }}">
                                    </div>
                                    <div class="ms-5">
                                        <h5 class="card-title">{{ $discussion->title }}</h5>
                                        <p class="card-text text-muted">{{ $discussion->description }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">

                                    @if(auth()->user() && auth()->user()->is_admin)

                                        @if(!$discussion->status)
                                        <form action="{{ route('discussions.approve', $discussion) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="border-0 bg-white"> <i class="fa-solid fa-check text-dark"></i></button>
                                        </form>
                                        @endif

                                        <a href="{{ route('discussions.edit', $discussion) }}" class="text-decoration-none">
                                            <i class="fa-solid fa-pen-to-square text-dark"></i>
                                        </a>

                                        <form action="{{ route('discussions.destroy', $discussion) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white"> <i class="fa-solid fa-trash-can"></i></button>
                                        </form>

                                    @endif

                                    <div class="d-flex text-muted">
                                        <p class="m-0 ms-2">{{ $discussion->category->name }}</p>
                                        <span class="ms-2">|</span>
                                        <p class="m-0 ms-2">{{ $discussion->user->username }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                </a>
            @empty
                <div class="text-center py-5 text-muted">
                    <p>Nothing here yet! Start a topic!</p>
                </div>
            @endforelse
        </div>
   </div>
@endsection