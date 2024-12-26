<?php
session_start();
include '../admin/cong.php'; // Koneksi database

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Buat ID transaksi random
    $id_transaksi = 'TRX-' . strtoupper(uniqid());

    // Simpan transaksi utama
    $query_transaksi = "INSERT INTO transaksi (id, tanggal) VALUES ('$id_transaksi', NOW())";
    mysqli_query($db, $query_transaksi);

    foreach ($_SESSION['cart'] as $id_barang => $item) {
        $jumlah = $item['jumlah'];
        $subtotal = $item['subtotal'];

        // Kurangi stok barang
        $query_update_stok = "UPDATE file_barang SET stok_barang = stok_barang - '$jumlah' WHERE id = '$id_barang'";
        mysqli_query($db, $query_update_stok);

        // Simpan detail transaksi
        $query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah, total_harga)
                         VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$subtotal')";
        mysqli_query($db, $query_detail);
    }

    // Hapus keranjang setelah checkout
    unset($_SESSION['cart']);

    echo "<script>
            alert('Checkout berhasil! Transaksi telah disimpan dengan ID: $id_transaksi');
            window.location.href = '../assets/kasir2.php';
          </script>";
} else {
    echo "<script>
            alert('Keranjang kosong!');
            window.location.href = '../assets/kasir2.php';
          </script>";
}
?>
