<x-layout>
    <div class="post-form">
        <h1>Edit post</h1>

        <form action="{{ route('posts.update', $post) }}" method="post">
            @csrf
            @method('put')

            <label for="title">Title</label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $post->title) }}" 
                   placeholder="Enter title">

            <label for="content">Content</label>
            <textarea name="content" id="content" placeholder="Enter content">{{ old('content', $post->content) }}</textarea>

            <label for="category_id">Choose category</label>
            <select name="category_id" id="category_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="new_category"> Enter Category</label>
            <input type="text" name="new_category" id="new_category" 
                   placeholder="New category name" value="{{ old('new_category') }}">

            <button type="submit">Update</button>
        </form>

        <a href="{{ route('posts.index') }}">Back</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Log out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
            @csrf
        </form>
    </div>
</x-layout>
