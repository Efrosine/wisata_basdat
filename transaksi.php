<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisatadb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data transaksi, pendaftaran dan metode pembayaran
$sql = "SELECT t.ID_Transaksi, t.Total_Pembayaran, t.Status_Pembayaran, t.Tanggal_Transaksi, 
                p.ID_Pendaftaran, w.Nama_Wisatawan
        FROM transaksi t
        LEFT JOIN pendaftaranwisatawan p ON t.ID_Pendaftaran = p.ID_Pendaftaran
        LEFT JOIN wisatawan w ON p.ID_Wisatawan = w.ID_Wisatawan
        ORDER BY t.Tanggal_Transaksi DESC";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WisataDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="destinasi_wisata.php">Destinasi Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wisatawan.php">Wisatawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="paket_wisata.php">Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pendaftaran_wisatawan.php">Pendaftaran Wisatawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pemandu_wisata.php">Pemandu Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jadwal_wisata.php">Jadwal Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Data Transaksi</h2>
        <!-- <a href="tambah_transaksi.php" class="btn btn-primary mb-3">Tambah Transaksi</a> -->

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>ID Pendaftaran</th>
                        <th>Nama Wisatawan</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Transaksi']; ?></td>
                            <td><?php echo $row['ID_Pendaftaran']; ?></td>
                            <td><?php echo $row['Nama_Wisatawan']; ?></td>
                            <td>Rp <?php echo number_format($row['Total_Pembayaran'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['Status_Pembayaran']; ?></td>
                            <td><?php echo $row['Tanggal_Transaksi']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">Tidak ada data transaksi yang tersedia.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>