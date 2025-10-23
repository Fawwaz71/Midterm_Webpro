<x-layout>
    <div class="posts-page">
        <h1>Posts</h1>

        <form method="get" action="{{ route('posts.index') }}">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
            <select name="category">
                <option value=""> Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @if(request('category')==$cat->id) selected @endif>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit">Filter</button>
        </form>

            <a href="{{ route('posts.create') }}">Create post</a>

        @foreach($posts as $post)
            <div class="post">
                <h3>{{ $post->title }}</h3>
                <p><strong>Category:</strong> {{ $post->category ? $post->category->name : '-' }}</p>
                <p>{{ Str::limit($post->content, 150) }}</p>

                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>

                <form action="{{ route('posts.destroy', $post) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>

            </div>
        @endforeach
    </div>
</x-layout>
