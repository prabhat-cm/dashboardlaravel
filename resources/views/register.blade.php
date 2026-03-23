<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
margin:0;
font-family:'Segoe UI', sans-serif;
background:#0c2d63;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.container{
width:1000px;
height:550px;
display:flex;
border-radius:20px;
overflow:hidden;
box-shadow:0 20px 60px rgba(0,0,0,0.4);
}

.left{
width:50%;
background:#0c2d63;
padding:60px;
color:white;
}

h1{
font-size:40px;
margin-bottom:30px;
}

.input-group{
margin-bottom:25px;
}

.input-group input{
width:100%;
border:none;
border-bottom:2px solid #aaa;
background:transparent;
color:white;
padding:8px 0;
}

.btn{
width:80%;
padding:12px;
background:#1e73be;
border:none;
border-radius:6px;
color:white;
font-weight:bold;
cursor:pointer;
}

.btn:hover{
background:#155a96;
}

.login-link{
margin-top:20px;
}

.login-text{
color:#1e90ff;
text-decoration:none;
}

.success{
text-align:center;
margin-bottom:15px;
}

.error{
color:#ff6b6b;
}

.right{
width:50%;
background:#1e73be;
display:flex;
justify-content:center;
align-items:center;
}
</style>

</head>

<body>

<div class="container">

<div class="left">

<h1>Registration</h1>

@if(session('error'))
<p class="success error">{{ session('error') }}</p>
@endif

@if(session('success'))
<p style="color:lightgreen; text-align:center;">{{ session('success') }}</p>
@endif

<form method="POST" action="/register">
@csrf

<div class="input-group">
<input type="text" name="name" placeholder="Username" required>
</div>

<div class="input-group">
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit" class="btn">Register</button>

</form>

<p class="login-link">
Already have account?
<a href="/login" class="login-text">Login</a>
</p>

</div>

<div class="right">
<h2 style="color:white;">👤 Create Account</h2>
</div>

</div>

</body>
</html>