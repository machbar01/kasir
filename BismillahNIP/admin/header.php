<?php include "../admin/cong.php"; 
?>
<link rel="stylesheet" href="../style/style.css" />
<aside class="sidebar">
  <h2>
    SELAMAT DATANG
    <?php echo $_SESSION['username']; ?> 
  </h2>
  <nav>
    <ul>
      <li><a href="kasir2.php" class="active">LAYANAN KASIR</a></li>
      <li><a href="input_data.php">INPUT BARANG</a></li>
      <li><a href="users.php">DATA ADMIN</a></li>
      <li><a href="dashboard.php">DATA BARANG</a></li>
      <li><a href="laporan_transaksi.php">LAPORAN TRANSAKSI</a></li>
      <li><a href="../admin/logout.php">LOGOUT</a></li>
    </ul>
  </nav>
</aside>
