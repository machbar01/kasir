<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Hapus item berdasarkan index
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);

        // Reindex array agar tetap berurutan
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirect kembali ke halaman transaksi
header("Location: ../assets/kasir2.php");
exit();
?>
