<?php 
    include "../admin/cong.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_barang = $_POST['harga_barang'];
        $stok_barang = $_POST['stok_barang'];
    
        $query = "INSERT INTO file_barang (kode_barang, nama_barang, harga_barang, stok_barang) 
                  VALUES ('$kode_barang', '$nama_barang', $harga_barang, $stok_barang)";
        if (mysqli_query($db, $query)) {
            echo "<script>
            alert('DATA SUKESES DI INPUT!');
            window.location.href = '../assets/dashboard.php';
          </script>";
} else {
    echo "<script>
            alert('DATA YANG DIMASUKAN TERDUPLIKAT !!');
            window.location.href = '../assets/input_data.php';
          </script>";
}
    }
?>