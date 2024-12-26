<?php
include '../admin/cong.php'; // Koneksi ke database
include '../admin/session.php'; 

// Inisialisasi variabel pencarian dan filter
$filter_transaksi = $_GET['filter_transaksi'] ?? '';
$filter_barang = $_GET['filter_barang'] ?? '';
$filter_tanggal_mulai = $_GET['filter_tanggal_mulai'] ?? '';
$filter_tanggal_selesai = $_GET['filter_tanggal_selesai'] ?? '';

// Query dasar untuk laporan transaksi
$query = "SELECT 
            t.id AS id_transaksi, 
            t.tanggal, 
            b.nama_barang, 
            dt.jumlah, 
            dt.total_harga
          FROM transaksi t
          JOIN detail_transaksi dt ON t.id = dt.id_transaksi
          JOIN file_barang b ON dt.id_barang = b.id
          WHERE 1=1";

// Menambahkan filter jika ada input
if (!empty($filter_transaksi)) {
    $query .= " AND t.id LIKE '%$filter_transaksi%'";
}
if (!empty($filter_barang)) {
    $query .= " AND b.nama_barang LIKE '%$filter_barang%'";
}
if (!empty($filter_tanggal_mulai) && !empty($filter_tanggal_selesai)) {
    $query .= " AND DATE(t.tanggal) BETWEEN '$filter_tanggal_mulai' AND '$filter_tanggal_selesai'";
}
$query .= " ORDER BY t.tanggal DESC";

$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../admin/style_input.css"> <!-- Pastikan sesuai -->
</head>
<body>
    <div class="dashboard">
    <?php include "../admin/header.php";
    ?>
     <main class="content">
        <h1>Laporan Transaksi</h1>
        
        <!-- Form Filter -->
        <form method="GET" action="" class="transaction-form">
            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <input type="text" name="filter_transaksi" placeholder="Cari ID Transaksi" value="<?php echo $filter_transaksi; ?>">
                <input type="text" name="filter_barang" placeholder="Cari Nama Barang" value="<?php echo $filter_barang; ?>">
                <input type="date" name="filter_tanggal_mulai" value="<?php echo $filter_tanggal_mulai; ?>">
                <input type="date" name="filter_tanggal_selesai" value="<?php echo $filter_tanggal_selesai; ?>">
                <button type="submit">Filter</button>
                <a href="laporan_transaksi.php" style="text-decoration: none; padding: 5px 10px; background: #007bff; color: white; border-radius: 4px;">Reset</a>
            </div>
        </form>

        <!-- Tabel Data -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data jika ada hasil
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id_transaksi']}</td>
                                <td>{$row['tanggal']}</td>
                                <td>{$row['nama_barang']}</td>
                                <td>{$row['jumlah']}</td>
                                <td>" . number_format($row['total_harga'], 2) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada transaksi yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            </main>
</body>
</html>
