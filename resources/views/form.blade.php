<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Session</title>
</head>
<body>
    <h2>User Login</h2>
    <form method="post" action="{{ route('form.login') }}">
        @csrf
        <div><label for="Name">Username</label>
        <input type="text" name="username" placeholder="Enter Username"> </div><br/>
        <div><label for="Password">Password</label>
        <input type="password" name="password" placeholder="Enter Password"> </div><br/>
        <div><button type="submit">Login</button></div>
    </form>
</body>
</html>
