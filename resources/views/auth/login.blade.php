<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>
