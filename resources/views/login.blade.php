<x-layout>
    <div class="login-box">
        <h1>Login</h1>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('login.process') }}">
            @csrf

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">

            <label>Password:</label>
            <input type="password" name="password">

            <button type="submit">Log in</button>
        </form>

        <p><a href="{{ route('register') }}">Register</a></p>
    </div>
</x-layout>
