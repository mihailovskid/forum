@extends('layouts.app')

@section('title', 'Create')

@section('content')
<main class="bg-light min-vh-100">
    <div class="container">
        <form action="{{ route('discussions.store') }}" method="POST" class="w-50 pt-5 mx-auto">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input class="form-control" type="text" id="photo" name="img_url" value="{{ old('img_url') }}">
                @error('img_url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
               <select name="category" id="category" class="form-control">
                    <option selected disabled>Choose Category</option>
                    @foreach ($categories as $category)
                        <option @if(old('category') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
               </select>
               @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
@endsection
