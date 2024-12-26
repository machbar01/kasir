<?php
include "../admin/cong.php";
include "../admin/session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = $_POST['barang'];
    $jumlah = $_POST['jumlah'];

    // Cek stok barang
    $query_stok = "SELECT stok_barang FROM file_barang WHERE id = '$barang_id'";
    $result_stok = mysqli_query($db, $query_stok);
    $stok_data = mysqli_fetch_assoc($result_stok);

    if ($stok_data['stok_barang'] >= $jumlah) {
        $harga = $_POST['harga_barang'];
        $total = $harga * $jumlah;

        $query = "INSERT INTO transaksi (nama_barang, harga_barang, jumlah, total) 
                  VALUES ('$barang_id', $harga, $jumlah, $total)";
        if (mysqli_query($db, $query)) {
            echo "<script>
                    alert('Transaksi berhasil ditambahkan!');
                    window.location.href = '../assets/kasir2.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan transaksi: " . mysqli_error($db) . "');
                    window.location.href = '../assets/kasir2.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Stok tidak mencukupi!');
                window.location.href = '../assets/kasir2.php';
              </script>";
    }
}
?>
