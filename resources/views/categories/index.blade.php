<x-layout>
    <div class="posts-page">
        <h1>Posts</h1>

        <form method="GET" action="{{ route('posts.index') }}">

            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

            <select name="category">
                <option value="">Categories</option>
                @foreach($categories as $cat) 
                    <option value="{{ $cat->id }}" @if(request('category')==$cat->id) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit">Filter</button>
        </form>

            <a href="{{ route('posts.create') }}">Create Post</a>
        
        @foreach($posts as $post)
            <div class="post-card">
                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                <p>By {{ $post->user->name }} | Category: {{ $post->category->name }}</p>
                <p>{{ Str::limit($post->content,100) }}</p>
            </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
