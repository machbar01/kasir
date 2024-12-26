<?php
session_start();
include '../admin/cong.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = $_POST['barang'];
    $jumlah = (int) $_POST['jumlah'];

    if ($jumlah <= 0) {
        echo "<script>
                alert('Jumlah harus lebih dari 0!');
                window.location.href = '../assets/dashboard.php';
              </script>";
        exit();
    }
}

    // Ambil data barang dari database
    $query_barang = "SELECT * FROM file_barang WHERE id = '$barang_id'";
    $result_barang = mysqli_query($db, $query_barang);

    if ($result_barang && mysqli_num_rows($result_barang) > 0) {
        $barang = mysqli_fetch_assoc($result_barang);

        if ($barang['stok_barang'] >= $jumlah) {
            // Simpan ke keranjang (di session)

    // Tambahkan ke keranjang (session)
    $_SESSION['cart'][$barang_id] = [
        'nama_barang' => $barang['nama_barang'],
        'harga_barang' => $barang['harga_barang'],
        'jumlah' => $jumlah,
        'subtotal' => $barang['harga_barang'] * $jumlah
    ];
    }


    // Redirect kembali ke halaman transaksi
    header("Location: ../assets/kasir2.php");
    exit();
}
?>