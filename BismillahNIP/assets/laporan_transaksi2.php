<?php

include '../admin/cong.php';
include '../admin/session.php'; // Koneksi ke database

// Inisialisasi variabel pencarian dan filter
$filter_transaksi = $_GET['filter_transaksi'] ?? '';
$filter_tanggal_mulai = $_GET['filter_tanggal_mulai'] ?? '';
$filter_tanggal_selesai = $_GET['filter_tanggal_selesai'] ?? '';

// Query untuk laporan transaksi
$query = "SELECT 
            t.id AS id_transaksi,
            t.tanggal,
            b.nama_barang,
            dt.jumlah,
            dt.harga,
            dt.total_harga,
            SUM(dt.total_harga) OVER (PARTITION BY t.id) AS total_transaksi
          FROM transaksi t
          JOIN detail_transaksi dt ON t.id = dt.id_transaksi
          JOIN file_barang b ON dt.id_barang = b.id
          WHERE 1=1";

// Menambahkan filter jika ada input
if (!empty($filter_transaksi)) {
    $query .= " AND t.id LIKE '%$filter_transaksi%'";
}
if (!empty($filter_tanggal_mulai) && !empty($filter_tanggal_selesai)) {
    $query .= " AND DATE(t.tanggal) BETWEEN '$filter_tanggal_mulai' AND '$filter_tanggal_selesai'";
}
$query .= " ORDER BY t.id, b.nama_barang";

$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css"> <!-- Pastikan file CSS -->
</head>
<body>
    <div class="container">
        <h1>Laporan Transaksi</h1>
        
        <!-- Form Filter -->
        <form method="GET" action="">
            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <input type="text" name="filter_transaksi" placeholder="Cari ID Transaksi" value="<?php echo $filter_transaksi; ?>">
                <input type="date" name="filter_tanggal_mulai" value="<?php echo $filter_tanggal_mulai; ?>">
                <input type="date" name="filter_tanggal_selesai" value="<?php echo $filter_tanggal_selesai; ?>">
                <button type="submit">Filter</button>
                <a href="laporan_transaksi2.php" style="text-decoration: none; padding: 5px 10px; background: #007bff; color: white; border-radius: 4px;">Reset</a>
            </div>
        </form>

        <!-- Tabel Data -->
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga Barang</th>
                    <th>Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $current_transaksi = ''; // Variabel untuk melacak ID transaksi saat ini
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Menampilkan ID Transaksi dan Total Transaksi hanya jika berbeda
                        if ($current_transaksi !== $row['id_transaksi']) {
                            $current_transaksi = $row['id_transaksi'];
                            echo "<tr style='background-color: #f8f9fa;'>
                                    <td><b>{$row['id_transaksi']}</b></td>
                                    <td><b>{$row['tanggal']}</b></td>
                                    <td colspan='4'></td>
                                    <td><b>" . number_format($row['total_transaksi'], 2) . "</b></td>
                                  </tr>";
                        }
                        // Menampilkan detail barang
                        echo "<tr>
                                <td></td>
                                <td></td>
                                <td>{$row['nama_barang']}</td>
                                <td>{$row['jumlah']}</td>
                                <td>" . number_format($row['harga'], 2) . "</td>
                                <td>" . number_format($row['total_harga'], 2) . "</td>
                                <td></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada transaksi yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
