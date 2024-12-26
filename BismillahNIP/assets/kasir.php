<?php
 include "../admin/cong.php";
 include "../admin/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Kasir</title>
    <link rel="stylesheet" href="../admin/style_input.css">
    <script>
        function calculateTotal() {
            const harga = parseFloat(document.getElementById('harga').value) || 0;
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            document.getElementById('total').value = harga * jumlah;
        }
    </script>
</head>
<body>
    <div class="dashboard">
        <?php include "../admin/header.php";
        ?>
        <!-- Main Content -->
        <main class="content">
            <h1>Menu Kasir</h1>

            <!-- Form Transaksi -->
            <section class="form-section">
                <h2>Input Transaksi</h2>
                <form action="../assets/kasir_process.php" method="POST" class="form">
                    <label for="barang">Pilih Barang:</label>
                    <select id="barang" name="barang" onchange="updateHarga()" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $query = "SELECT * FROM file_barang";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}' data-harga='{$row['harga_barang']}'>{$row['nama_barang']}</option>";
                        }
                        ?>
                    </select>

                    <label for="harga">Harga (Rp):</label>
                    <input type="number" id="harga" name="harga" readonly>

                    <label for="jumlah">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah" oninput="calculateTotal()" required>

                    <label for="total">Total (Rp):</label>
                    <input type="number" id="total" name="total" readonly>

                    <button type="submit" class="btn">Tambahkan</button>
                </form>
            </section>

            <!-- Tabel Transaksi -->
            <section class="table-section">
                <h2>Daftar Transaksi</h2>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT t.id, b.nama_barang, t.harga, t.jumlah, t.total, t.tanggal
                                  FROM transaksi t
                                  JOIN file_barang b ON t.nama_barang = b.id
                                  ORDER BY t.tanggal DESC";
                        $result = mysqli_query($db, $query);

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['harga']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        function updateHarga() {
            const barang = document.getElementById('barang');
            const harga = barang.options[barang.selectedIndex].getAttribute('data-harga');
            document.getElementById('harga').value = harga;
            calculateTotal();
        }
    </script>
</body>
</html>
