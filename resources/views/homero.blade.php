<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Enter Otp:: {{session('otp')}}</h3>
    <form action="{{ url('/homero') }}" method="POST">
    @csrf
    <input type="number" name="otp" placeholder="Enter Otp">
    <input type="submit" value="submit">
    <div><span id="new otp"></span></div>
    <div>Time left = <span id="timer"></span></div>
    </form>
</body>
</html>

<script>
    let timerOn = true;

    function timer(remaining) {
      var m = Math.floor(remaining / 60);
      var s = remaining % 60;

      m = m < 10 ? '0' + m : m;
      s = s < 10 ? '0' + s : s;
      document.getElementById('timer').innerHTML = m + ':' + s;
      remaining -= 1;

      if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
      }

      if(!timerOn) {
        // Do validate stuff here
        return;
      }

    let btn = document.createElement("button");
    btn.innerHTML = "LOGIN AGAIN";
    btn.type = "submit";
    btn.name = "formBtn";

    btn.addEventListener("click", function () {
    window.location='{{ url("/login-again") }}';
    });

    document.body.appendChild(btn);
}



timer(10);


</script>
