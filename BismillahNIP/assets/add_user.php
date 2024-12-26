<?php
include '../admin/cong.php';
include '../admin/session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = md5(mysqli_real_escape_string($db, $_POST['password'])); // Hash MD5

    // Tambahkan user ke database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($db, $query)) {
        echo "<script>
                alert('User berhasil ditambahkan.');
                window.location.href = 'users.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menambahkan user.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Users</title>
    <link rel="stylesheet" href="../admin/style_input.css">
</head>
<body>
    <div class="dashboard">
        <?php include "../admin/header.php" ;
        ?>
    <main class="content">
        <h1>INPUT DATA USER</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
        </main>
    </div>
</body>
</html>

