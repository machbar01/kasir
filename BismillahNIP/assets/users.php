<?php
include '../admin/cong.php';
include '../admin/session.php';

// Ambil semua data users dari database
$query = "SELECT id, username, created_at FROM users";
$result = mysqli_query($db, $query);
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
            <h1>Kelola Users</h1>
            <a href="../assets/add_user.php" class="btn btn-primary">Tambah User</a>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>
                                        <a href='../assets/edit_user.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                        <a href='../assets/delete_user.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus user ini?\")'>Hapus</a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data user.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
