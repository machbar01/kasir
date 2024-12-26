<?php
include '../admin/cong.php';
include '../admin/session.php';

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id = '$id'";

if (mysqli_query($db, $query)) {
    echo "<script>
            alert('User berhasil dihapus.');
            window.location.href = 'users.php';
          </script>";
} else {
    echo "<script>alert('Gagal menghapus user.');</script>";
}
?>
