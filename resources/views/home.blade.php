<x-layout>
    <div class="home">
        <h1>Home</h1>

        @auth
            <p>Welcome, {{ Auth::user()->name }}</p>

            <div class="buttons">
                <a href="{{ route('posts.index') }}" class="button_home view">View Posts</a>
                <a href="{{ route('posts.create') }}" class="button_home create">Create Post</a>
                <a href="{{ route('logout') }}" class="button_home logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Log Out
                </a>
                <a href="#" class="button_home delete"
                   onclick="event.preventDefault(); document.getElementById('delete-account-form').submit();">
                   Delete Account
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <form id="delete-account-form" action="{{ route('account.delete') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @else
            <p>
                <a href="{{ route('register') }}" class="button_home_main register">Register</a>
                <a href="{{ route('login') }}" class="button_home_main login">Log In</a>
            </p>
        @endauth
    </div>


</x-layout>