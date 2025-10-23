<x-layout>
    <div class="create-post">
        <h1>Make Post</h1>

        <form action="{{ route('posts.store') }}" method="post">
            @csrf

            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title">

            <label for="content">Content</label>
            <textarea name="content" id="content" placeholder="Enter content">{{ old('content') }}</textarea>

            <label for="category_id">pick category</label>
            <select name="category_id" id="category_id">
                <option value="">Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="new_category">New Category</label>
            <input type="text" name="new_category" id="new_category" placeholder="New category" value="{{ old('new_category') }}">

            <button type="submit">Create</button>
        </form>

        <a href="{{ route('posts.index') }}">Back</a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="post">
            @csrf
        </form>
    </div>
</x-layout>
