<?php
 include "../admin/cong.php";
 include "../admin/session.php";


// Ambil daftar barang dari database
$query_barang = "SELECT id, nama_barang, harga_barang, stok_barang FROM file_barang";
$result_barang = mysqli_query($db, $query_barang);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Transaksi</title>
    <link rel="stylesheet" href="../admin/style_input.css">
</head>
<body>
    <div class="dashboard">
    <?php include "../admin/header.php";
    ?>
        <main class="content">
            <h1>Menu Transaksi</h1>
            
            <!-- Form untuk Menambah Barang ke Transaksi -->
            <form action="../assets/add_to_cart.php" method="POST" class="transaction-form">
                <div class="form-group">
                    <label for="barang">Pilih Barang:</label>
                    <select name="barang" id="barang" required>
                        <option value="" disabled selected>-- Pilih Barang --</option>
                        <?php while ($row = mysqli_fetch_assoc($result_barang)) { ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['nama_barang']; ?> - Rp <?php echo number_format($row['harga_barang'], 0, ',', '.'); ?> - Stok <?php echo $row['stok_barang'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" name="jumlah" id="jumlah" required min="1" placeholder="Masukkan jumlah">
                </div>

                <button type="submit" class="btn btn-primary">Tambah ke Transaksi</button>
            </form>

            <!-- Tabel Barang dalam Transaksi -->
            <h2>Daftar Barang dalam Transaksi</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan barang yang ada di transaksi sementara (keranjang)
                    $total_transaksi = 0;
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $index => $item) {
                            $total_item = $item['harga_barang'] * $item['jumlah'];
                            $total_transaksi += $total_item;
                            echo "<tr>
                                    <td>" . ($index + 1) . "</td>
                                    <td>{$item['nama_barang']}</td>
                                    <td>Rp " . number_format($item['harga_barang'], 0, ',', '.') . "</td>
                                    <td>{$item['jumlah']}</td>
                                    <td>Rp " . number_format($total_item, 0, ',', '.') . "</td>
                                    <td>
                                        <a href='../assets/remove_from_cart.php?index=$index' class='btn btn-danger'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada barang dalam transaksi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Total Transaksi -->
            <h3>Total Transaksi: Rp <?php echo number_format($total_transaksi, 0, ',', '.'); ?></h3>

            <!-- Tombol untuk Menyelesaikan Transaksi -->
            <form action="../assets/checkout.php" method="POST">
                <button type="submit" class="btn btn-success">Selesaikan Transaksi</button>
            </form>
        </main>
    </div>
</body>
</html>
