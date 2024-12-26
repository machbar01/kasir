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
  <title>INPUT DATA BARANG</title>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
<?php
 include "../admin/header.php";
?>
    <!-- Main Content -->
    <main class="main">
      <header class="header">
        <div class="search-bar">
          <input type="text" placeholder="Search...">
        </div>
      </header>

      <section class="cards">
        <div class="card"> 
        <section class="table-section">

  <h2>TABEL DATA INPUT BARANG</h2>
  <table class="styled-table">
    <thead>
      <tr>
        <th>KODE BARANG</th>
        <th>NAMA BARANG</th>
        <th>HARGA BARANG</th>
        <th>STOK BARANG</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    
               <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $row['kode_barang']; ?></td>
                  <td><?php echo $row['nama_barang']; ?></td>
                  <td><?php echo $row['harga_barang']; ?></td>
                  <td><?php echo $row['stok_barang']; ?></td>
                  <td>
                    <a href="../assets/edit.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                    <a href="../assets/delete.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
                  </td>
                </tr>
                <?php } ?>
    </tbody>
  </table>
</section>
    </main>
  </div>
  </div>
  <script src="../style/script.js"></script>
</body>
</html>
