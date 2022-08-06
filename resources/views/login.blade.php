<h3>LOGIN HERE</h3>
<form action="{{url('/login')}}" method="POST">
    @csrf
    <label for="">Email</label>
    <input type="email" name="email" placeholder="Enter Your Email">
    <label for="">Password</label>
    <input type="password" name="password" placeholder="Enter Your password">
    <input type="submit" value="Login">
</form>
