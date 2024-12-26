<?php
// Mulai session
session_start();
include '../admin/cong.php';

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password dengan MD5

    // Query untuk validasi
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: ../assets/dashboard.php");
        exit;
    } else {
        echo "<script>
        alert('Username atau Password salah!');
        window.location.href = '../index.php';
        </script>";
    }
}
?>