<?php
include "../admin/cong.php";
include "../admin/session.php";

$id = $_GET['id'];

// Cek apakah data ada di database
$sql = "SELECT * FROM file_barang WHERE id = $id";
$result = mysqli_query($db, $sql);

// Jika data ditemukan, ambil datanya
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data tidak ditemukan!";
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $kode_barang = $_POST["kode_barang"];
    $nama_barang = $_POST["nama_barang"];
    $harga_barang = $_POST["harga_barang"];
    $stok_barang = $_POST["stok_barang"];

    // Query update
    $sql = "UPDATE file_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga_barang='$harga_barang', stok_barang='$stok_barang' WHERE id=$id";

    if (mysqli_query($db, $sql)) {
        echo "<script>
            alert('DATA BERHASIL DI UPDATE!');
            window.location.href = '../assets/dashboard.php';
          </script>";

        exit(); // Pastikan untuk menghentikan skrip setelah redirect
    } else {
        echo "<script>
            alert('DATA YANG UPDATE GAGAL !!');
            window.location.href = '../assets/dashboard.php';
            </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../admin/style_input.css">
    <title>Edit Data Barang</title>
</head>
<body>
    <div class="dashboard">
        <?php
        include "../admin/header.php";
        ?>
    <!-- Form EDIT BARANG  -->
    <main class="content">
    <h2>Edit Data Barang</h2>
    <section class="form-section">
        <form method="post">
        Kode Barang: <input type="text" name="kode_barang" value="<?php echo $row['kode_barang']; ?>"><br>
        Nama Barang: <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>"><br>
        Harga Barang: <input type="text" name="harga_barang" value="<?php echo $row['harga_barang']; ?>"><br>
        Stok Barang: <input type="text" name="stok_barang" value="<?php echo $row['stok_barang']; ?>"><br>
        <input type="submit" class="btn edit" value="Update">
        </form>
    </section>
    </section>
    </main>
  </div>
</body>
</html>