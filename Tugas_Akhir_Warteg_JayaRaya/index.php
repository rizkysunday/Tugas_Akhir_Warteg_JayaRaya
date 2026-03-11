<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>WARUNG NASI JAYA RAYA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

<style>
.hero{
height:400px;
background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/background.png');
background-size:cover;
background-position:center;
background-repeat:no-repeat;
display:flex;
align-items:center;
justify-content:center;
}
</style>

</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand">WARUNG NASI JAYA RAYA</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse justify-content-end" id="navbarNav">

<span class="text-white me-3">
Halo, <?php echo $_SESSION['username']; ?>
</span>

<button
class="btn btn-outline-warning btn-sm me-2"
data-bs-toggle="modal"
data-bs-target="#wishlistModal"
onclick="tampilkanWishlist()">

<i class="bi bi-heart"></i>
Wishlist (<span id="wishlist-count">0</span>)

</button>

<button id="btn-theme" class="btn btn-outline-light btn-sm">

<i class="bi bi-moon-stars"></i>
Mode Gelap

</button>

<a href="controller/logout.php" class="btn btn-danger btn-sm ms-2">
Logout
</a>

</div>
</div>
</nav>


<!-- HERO -->
<section class="hero text-white">

<div class="container text-center">

<h2>Sistem Manajemen Warung Nasi</h2>

<p class="lead mb-4">
Menu lezat dengan resep turun-temurun
</p>

</div>

</section>


<!-- CONTENT -->
<div class="container my-4">

<h4 class="mb-3">Daftar Menu</h4>

<div class="row g-4">


<!-- NASI RAMES -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/nasi rames.png" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Nasi+Rames'">

<div class="card-body">

<h6 class="card-title">Nasi Rames</h6>

<p class="mb-1">Harga: Rp 15.000</p>

<p class="text-muted stok-text">Stok: 25</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


<!-- AYAM GORENG -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/ayam goreng.png" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Ayam+Goreng'">

<div class="card-body">

<h6 class="card-title">Ayam Goreng</h6>

<p class="mb-1">Harga: Rp 12.000</p>

<p class="text-muted stok-text">Stok: 20</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


<!-- TELUR DADAR -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/telur dadar.jpg" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Telur+Dadar'">

<div class="card-body">

<h6 class="card-title">Telur Dadar</h6>

<p class="mb-1">Harga: Rp 5.000</p>

<p class="text-muted stok-text">Stok: 30</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


<!-- SAYUR ASEM -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/sayur asem.jpg" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Sayur+Asem'">

<div class="card-body">

<h6 class="card-title">Sayur Asem</h6>

<p class="mb-1">Harga: Rp 5.000</p>

<p class="text-muted stok-text">Stok: 25</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


<!-- NASI PUTIH -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/nasi putih.png" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Nasi+Putih'">

<div class="card-body">

<h6 class="card-title">Nasi Putih</h6>

<p class="mb-1">Harga: Rp 5.000</p>

<p class="text-muted stok-text">Stok: 100</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


<!-- ES TEH -->
<div class="col-md-4">
<div class="card h-100">

<img src="assets/es teh manis.jpg" class="card-img-top"
onerror="this.src='https://via.placeholder.com/300x200?text=Es+Teh+Manis'">

<div class="card-body">

<h6 class="card-title">Es Teh Manis</h6>

<p class="mb-1">Harga: Rp 3.000</p>

<p class="text-muted stok-text">Stok: 50</p>

<button class="btn btn-primary btn-detail w-100">
Beli
</button>

<button class="btn btn-outline-danger btn-wishlist w-100 mt-2">
❤️ Wishlist
</button>

</div>
</div>
</div>


</div>
</div>


<!-- MODAL WISHLIST -->

<div class="modal fade" id="wishlistModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header bg-warning">

<h5 class="modal-title">
<i class="bi bi-heart-fill"></i>
Daftar Wishlist Saya
</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div id="wishlist-kosong" class="text-center text-muted py-4" style="display:none">

<i class="bi bi-heart fs-1"></i>

<p>Wishlist masih kosong</p>

</div>

<ul class="list-group" id="wishlist-list"></ul>

</div>

<div class="modal-footer">

<button class="btn btn-secondary" data-bs-dismiss="modal">
Tutup
</button>

<button class="btn btn-warning" onclick="kosongkanWishlist()">
Kosongkan
</button>

</div>

</div>
</div>
</div>


<footer class="bg-dark text-white text-center py-3 mt-auto border-top">

<small>© 2026 WARUNG NASI JAYA RAYA</small>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="script.js"></script>

</body>
</html>