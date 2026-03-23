<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
body{
margin:0;
font-family:Arial;
background:#4b4b6a;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.box{
width:400px;
padding:40px;
background:#3f3f5c;
border-radius:15px;
color:white;
text-align:center;
box-shadow:0 10px 40px rgba(0,0,0,0.4);
}

h2{
margin-bottom:20px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:5px;
}

.btn-group{
display:flex;
gap:10px;
margin-top:10px;
}

.login-btn{
flex:1;
padding:10px;
background:#2ecc71;
border:none;
border-radius:5px;
font-weight:bold;
cursor:pointer;
}

.login-btn:hover{
background:#27ae60;
}

.register-btn{
flex:1;
background:#9b59b6;
color:white;
text-decoration:none;
border-radius:5px;
display:flex;
justify-content:center;
align-items:center;
font-weight:bold;
}

.register-btn:hover{
background:#8e44ad;
}

.error{
color:#ff6b6b;
}

/*  NEW STYLE */
.forgot{
display:block;
margin-top:10px;
color:#ddd;
text-decoration:none;
font-size:14px;
}

.forgot:hover{
color:#fff;
}
</style>

</head>

<body>

<div class="box">

<h2>Login</h2>

{{-- Laravel error --}}
@if(session('error'))
<p class="error">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
@csrf

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>


<div class="btn-group">

<button type="submit" class="login-btn">Login</button>

<a href="/register" class="register-btn">Registration</a>

</div>

<a href="/forgot" class="forgot">Forgot Password?</a>

</form>

</div>

</body>
</html>