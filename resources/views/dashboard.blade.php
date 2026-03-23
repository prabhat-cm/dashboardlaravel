<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
background:#2c3e50;
color:white;
padding:15px 20px;
}

.btn{
padding:8px 15px;
border:none;
cursor:pointer;
margin-left:5px;
border-radius:5px;
}

.btn-add{
background:#27ae60;
color:white;
}

.btn-logout{
background:#e74c3c;
color:white;
}

.cards-container{
padding:20px;
}

.card{
display:inline-block;
width:200px;
padding:10px;
margin:10px;
background:white;
border-radius:10px;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card img{
width:100%;
height:150px;
object-fit:cover;
border-radius:8px;
}

.no-data{
padding:30px;
font-size:20px;
color:#555;
}
</style>

</head>

<body>

<div class="top-bar">

<h2>Dashboard ({{ strtoupper(session('role')) }})</h2>

<div>
<button class="btn btn-add" onclick="openModal()">+ Add</button>

<a href="/logout">
<button class="btn btn-logout">Logout</button>
</a>
</div>

</div>

<!-- MODAL -->
<div id="myModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);">

<div style="background:white;width:300px;padding:20px;margin:100px auto;border-radius:10px;">

<h3>Add Item</h3>

<form method="POST" action="/add-item" enctype="multipart/form-data">
@csrf

<input type="text" name="name" placeholder="Name" required><br><br>
<input type="number" name="position" placeholder="Position" required><br><br>
<input type="file" name="image" required><br><br>

<button type="submit" class="btn btn-add">Save</button>
<button type="button" onclick="closeModal()" class="btn">Close</button>

</form>

</div>
</div>

<!-- CARDS -->
<div class="cards-container">

@if(count($items)==0)
<div class="no-data">No Data Found</div>
@endif

@foreach($items as $row)

<div class="card">

<img src="/uploads/{{ $row->image }}">

<h4>{{ $row->name }}</h4>

<p>Position: {{ $row->position }}</p>

@if(session('role')=='admin')
<form method="POST" action="/delete-item">
@csrf
<input type="hidden" name="id" value="{{ $row->id }}">
<button type="submit" class="btn btn-logout">Delete</button>
</form>
@endif

</div>

@endforeach

</div>

<script>
function openModal(){
document.getElementById("myModal").style.display="block";
}
function closeModal(){
document.getElementById("myModal").style.display="none";
}
</script>

</body>
</html>