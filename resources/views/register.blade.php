<x-layout>
    <div class="register-box">
        <h1>Register</h1>

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name">
            @error('name')
                <span role="alert">{{ $message }}</span>
            @enderror

            <label>Email</label>
            <input type="email" name="email">
            @error('email')
                <span role="alert">{{ $message }}</span>
            @enderror

            <label>Password</label>
            <input type="password" name="password">
            @error('password')
                <span role="alert">{{ $message }}</span>
            @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">

            <button type="submit">Register</button>
        </form>

        <a href="{{ route('login') }}">Log in</a>
    </div>
</x-layout>
