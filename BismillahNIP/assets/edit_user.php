<?php
include '../admin/cong.php';
include '../admin/session.php';


$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = !empty($_POST['password']) 
                ? md5(mysqli_real_escape_string($db, $_POST['password'])) 
                : $user['password']; // Hash baru jika ada perubahan password

    // Perbarui data user
    $query_update = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'";
    if (mysqli_query($db, $query_update)) {
        echo "<script>
                alert('User berhasil diperbarui.');
                window.location.href = 'users.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui user.');</script>";
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
        <h1>Edit User</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
        </main>
    </div>
</body>
</html>

