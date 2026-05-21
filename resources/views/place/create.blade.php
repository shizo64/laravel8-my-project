@extends('layouts2.main')
@section('content')
        <form class="container" action="{{ route('place.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="{{ old('title') }}" type="text" class="form-control" id="title" name="title">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" id="name" name="name">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input value="{{ old('image') }}" type="text" class="form-control" id="image" name="image">
                @error(
'image'
                )
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input value="{{ old('description') }}" type="text" class="form-control" id="description" name="description">
                @error('description'
                )
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input value="{{ old('quantity') }}" type="number" class="form-control" id="quantity" name="quantity">
                @error('quantity'
                )
                <p class="text-danger">{{ $message }}</p></label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select mb-3" aria-label="Default select example" id="category_id" name="category_id">
                    @foreach($categories as $category)
                    <option 
                    {{ old('category_id') == $category->id ? 'selected':'' }}
                    value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Place</button>
            
        </form>
        

        <div>
            <a href="{{ route('place.index') }}">Back to Places</a>
        </div>
@endsection
    
