<?php
include "../admin/cong.php";
// Ambil kode_barang dari URL
$id = $_GET['id'];

// Hapus data berdasarkan id
$sql = "DELETE FROM file_barang WHERE id = '$id'";

if (mysqli_query($db, $sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error: " . mysqli_error($db);
}

// Tutup koneksi
mysqli_close($db);
?>
