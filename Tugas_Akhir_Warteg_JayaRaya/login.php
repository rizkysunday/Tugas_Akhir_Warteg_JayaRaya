<?php
session_start();

$username = "";

if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Warung Nasi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="card shadow">
<div class="card-body">

<h4 class="text-center mb-3">Login Warung Nasi</h4>

<?php
if(isset($_GET['error'])){
echo "<div class='alert alert-danger'>Username atau Password salah</div>";
}
?>

<form method="POST" action="controller/proses_login.php">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="form-check mb-3">
<input type="checkbox" name="remember" class="form-check-input">
<label class="form-check-label">Remember Me</label>
</div>

<button class="btn btn-dark w-100">Login</button>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>