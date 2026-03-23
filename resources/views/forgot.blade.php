<h2>Reset Password</h2>

@if(session('msg'))
    <p>{{ session('msg') }}</p>
@endif

<form method="POST" action="/reset-password">
    @csrf

    <input type="email" name="email" placeholder="Enter Email" required><br><br>
    <input type="password" name="new_password" placeholder="New Password" required><br><br>

    <button type="submit">Reset</button>
</form>