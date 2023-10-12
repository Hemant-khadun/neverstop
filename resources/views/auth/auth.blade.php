<!DOCTYPE html>
<html>
<head>
    <title>Login and Register</title>
</head>
<body>
    <h1>Login and Register</h1>

    <form action="{{ route('auth.login') }}" method="post">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>

        <button type="submit">Login</button>
    </form>

    <form action="{{ route('auth.register') }}" method="post">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name" id="name">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Register</button>
    </form>

</body>
</html>