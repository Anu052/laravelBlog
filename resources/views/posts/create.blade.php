@extends('layout.app')

@section('content')
    <div style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333; margin-bottom: 20px;">Create a New Blog Post</h2>
        <form method="POST" action="{{ route('posts.store') }}" style="max-width: 600px; margin: auto;">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div style="margin-bottom: 15px;">
                <label for="title" style="font-weight: bold; font-size: 16px;">Title:</label>
                <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="description" style="font-weight: bold; font-size: 16px;">Description:</label>
                <input type="text" id="description" name="description" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="category" style="font-weight: bold; font-size: 16px;">Category:</label>
                <select id="category" name="category_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="content" style="font-weight: bold; font-size: 16px;">Content:</label>
                <textarea id="content" name="content" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;"></textarea>
            </div>

            <button type="submit" style="background-color: #3498db; color: #fff; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer;">Create Post</button>
        </form>
    </div>
@endsection
