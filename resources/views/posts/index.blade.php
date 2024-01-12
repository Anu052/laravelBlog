@extends('layout.app')
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f9f9f9;
        color: #333;
    }

    .blog-listing {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .blog-listing__title {
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .blog-listing__list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .blog-listing__item {
        border-bottom: 1px solid #eee;
        padding: 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .blog-listing__content {
        flex: 1;
    }

    .blog-listing__post-title {
        color: #3498db;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .blog-listing__post-content {
        color: #777;
    }

    .blog-listing__actions {
        display: flex;
        align-items: center;
    }

    .blog-listing__delete-btn,
    .blog-listing__edit-link {
        background-color: #e74c3c;
        color: #fff;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 10px;
        transition: background-color 0.3s ease-in-out;
    }

    .blog-listing__edit-link {
        background-color: #3498db;
    }

    .blog-listing__search {
        margin-bottom: 20px;
    }

    .blog-listing__search-input,
    .blog-listing__category-select {
        padding: 8px;
        width: 200px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .blog-listing__no-results {
        text-align: center;
        color: #555;
        font-size: 18px;
        margin-top: 20px;
    }
    form{
        margin: 30px;
    }
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        
    }

    .pagination-container .pagination li {
        list-style: none;
        margin: 0 5px;
        
    }

    .pagination-container .pagination a,
    .pagination-container .pagination span {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        
    }

    .pagination-container .pagination .active span {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        background-color: red
    }
    @media screen and (max-width: 767px) {
        .pagination-container .pagination {
            flex-wrap: wrap;
        }

        .pagination-container .pagination li {
            margin: 5px 0;
        }
    }
</style>
@section('content')
    <div class="blog-listing">
        <h2 class="blog-listing__title">Blog Posts</h2>
        <div class="blog-listing__search">
            <label for="category" style="margin-right: 10px;">Category:</label>
            <select id="category" class="blog-listing__category-select" onchange="filterBlogs()">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <label for="search" style="margin-left: 20px; margin-right: 10px;">Search:</label>
            <input type="text" id="search" class="blog-listing__search-input" oninput="filterBlogs()">
        </div>
        <ul class="blog-listing__list">
            @foreach ($posts as $post)
                <li class="blog-listing__item" data-category="{{ $post->category_id }}">
                    <div class="blog-listing__content">
                        <h3 class="blog-listing__post-title">{{ $post->title }}</h3>
                        <p class="blog-listing__post-content">{{ $post->content }}</p>
                    </div>
                    <div class="blog-listing__actions">
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="blog-listing__delete-btn">Delete</button>
                        </form>
                        <a href="{{ route('posts.edit', $post->id) }}" class="blog-listing__edit-link">Edit</a>
                    </div>
                </li>
            @endforeach
        </ul>

        @if (count($posts) == 0)
            <p class="blog-listing__no-results">No blog posts found.</p>
        @endif

        <a href="{{ route('posts.create') }}" class="blog-listing__create-link">Create New Post</a>

        <div class="pagination-container">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
        
    </div>

    <script>
        function filterBlogs() {
            var categoryFilter, searchFilter, ul, li, h3, p, i, category, txtValue;
            categoryFilter = document.getElementById('category').value.toUpperCase();
            searchFilter = document.getElementById('search').value.toUpperCase();
            ul = document.querySelector('.blog-listing__list');
            li = ul.getElementsByTagName('li');
            var foundPosts = false;

            for (i = 0; i < li.length; i++) {
                category = li[i].getAttribute('data-category');
                h3 = li[i].getElementsByClassName('blog-listing__post-title')[0];
                p = li[i].getElementsByClassName('blog-listing__post-content')[0];
                txtValue = h3.textContent || h3.innerText;
                txtValue += ' ' + p.textContent || p.innerText;

                if ((categoryFilter === '' || category === categoryFilter) &&
                    (txtValue.toUpperCase().indexOf(searchFilter) > -1)) {
                    li[i].style.display = '';
                    foundPosts = true;
                } else {
                    li[i].style.display = 'none';
                }
            }

            var noResultsMessage = document.querySelector('.blog-listing__no-results');
            if (foundPosts) {
                noResultsMessage.style.display = 'none';
            } else {
                noResultsMessage.style.display = 'block';
            }
        }
    </script>
@endsection
