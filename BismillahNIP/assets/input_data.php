<?php
 include "../admin/cong.php";
 include "../admin/record.php";
 include "../admin/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Input Barang</title>
  <link rel="stylesheet" href="../admin/style_input.css">
</head>
<body>
  <div class="dashboard">
  <?php
 include "../admin/header.php";
?>

    <!-- Main Content -->
    <main class="content">
      <h1>Manajemen Barang</h1>

      <!-- Form Input Barang -->
      <section class="form-section">
        <form action="../assets/input_data_run.php" method="POST" class="form">
          <label for="nama_barang">KODE BARANG</label>
          <input type="text" id="nama_barang" name="kode_barang" required>

          <label for="kategori">NAMA BARANG</label>
          <input type="text" id="kategori" name="nama_barang" required>

          <label for="stok">HARGA BARANG</label>
          <input type="number" id="stok" name="harga_barang" step="500" required>

          <label for="harga">STOK BARANG:</label>
          <input type="number" id="harga" name="stok_barang" step="1" required>

          <button type="submit" class="btn">Tambah Barang</button>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
