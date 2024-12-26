<?php 
    include "admin/cong.php";

    if(isset($_POST["input_data"])){
        $kode_barang =$_POST["kode_barang"];
        $nama_barang =$_POST["nama_barang"];
        $harga_barang =$_POST["harga_barang"];
        $stok_barang =$_POST["stok_barang"];
        
        $sql = "INSERT INTO file_barang (kode_barang, nama_barang, harga_barang, stok_barang) VALUES
        ('$kode_barang','$nama_barang','$harga_barang','$stok_barang')";

        if($db->query($sql)) {
            echo "<script>alert('Rekord Berhasil Disimpan !');</script>";
        }else{
            echo "<script>alert('Rekord Gagal Disimpan !');</script>";
        }
    }
    $sqltabel = "SELECT * FROM file_barang ORDER by kode_barang ASC";
    $result = $db->query($sqltabel);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Input Barang</title>
    <link rel="stylesheet"  href="admin/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="header">
    <?php include "admin/header.html" ?>
    <h1>MENU INPUT BARANG</h1>
    </div>
    <div class="input_form">
    <form action="index.php" method="post">
            <table>
            <tr>
            <th>Kode Barang</th>
            <th> <input type="text" name="kode_barang" placeholder="Masukan Kode Barang"required>    </th>
            </tr>
            <tr> 
            <th>Nama Barang</th>
            <th><input type="text" name="nama_barang" placeholder="Nama Barang"required></th>
            </tr>
            <tr>
            <th>Harga Barang</th>
            <th><input type="text" name="harga_barang" placeholder="Harga Barang" required></th>
            </tr>
            <tr>
            <th>Stok Barang</th>
            <th><input type="text" name="stok_barang" placeholder="Stok Barang"required></th>   
        </tr>
        </table>
            <button class="tombol_input" name="input_data" type="submit" class="input_data">Input</button>
            
        </form>
    </div>
</div>
<div class="tabel_data">
<h2>Data Siswa</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Stok Barang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
                    if ($result->num_rows > 0) {
                        // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["kode_barang"] . "</td>";
                    echo "<td>" . $row["nama_barang"] . "</td>";
                    echo "<td>" . $row["harga_barang"] . "</td>";
                    echo "<td>" . $row["stok_barang"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $row["id"] . "'>Edit</a> | ";
                    echo "<a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                ?>
            
        </tbody>
    </table>
    </div>                

</form>
</body>
</html>