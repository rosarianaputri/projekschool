<!DOCTYPE html>
<html>
<head>
<title>Dashboard Siswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
background:#f4f6f9;
}

.sidebar{
width:230px;
height:100vh;
position:fixed;
background:white;
border-right:1px solid #ddd;
padding:20px;
}

.sidebar a{
display:block;
padding:10px;
color:#333;
text-decoration:none;
border-radius:8px;
margin-bottom:5px;
}

.sidebar a:hover{
background:#f1f1f1;
}

.content{
margin-left:250px;
padding:30px;
}

</style>

</head>

<body>

<div class="sidebar">

<h5 class="mb-4">Student Panel</h5>

<a href="{{ route('student.dashboard') }}">
<i class="fa fa-home"></i> Dashboard
</a>

<a href="{{ route('student.ppdb.index') }}">
<i class="fa fa-file"></i> PPDB
</a>

<a href="#">
<i class="fa fa-upload"></i> Upload Berkas
</a>

<a href="#">
<i class="fa fa-clock"></i> Status Pendaftaran
</a>

<a href="{{ route('profile.edit') }}">
<i class="fa fa-user"></i> Profil
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="btn btn-danger mt-3 w-100">
Logout
</button>
</form>

</div>

<div class="content">

@yield('content')

</div>

</body>
</html>