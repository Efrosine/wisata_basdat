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

// Query untuk mendapatkan data jadwal, paket, dan pemandu
$sql = "SELECT jw.ID_Jadwal, jw.Tanggal_Jadwal, jw.Kuota_Max, jw.Lokasi_Berkumpul, 
                p.Nama_Paket, pm.Nama_Pemandu
        FROM jadwalwisata jw
        LEFT JOIN paketwisata p ON jw.ID_Paket = p.ID_Paket
        LEFT JOIN pemanduwisata pm ON jw.ID_Pemandu = pm.ID_Pemandu
        ORDER BY jw.Tanggal_Jadwal";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Wisata</title>
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
        <h2>Jadwal Wisata</h2>
        <a href="tambah_jadwal.php" class="btn btn-primary mb-3">Tambah Jadwal Wisata</a>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Jadwal</th>
                        <th>Tanggal Jadwal</th>
                        <th>Nama Paket</th>
                        <th>Nama Pemandu</th>
                        <th>Lokasi Berkumpul</th>
                        <th>Kuota Max</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Jadwal']; ?></td>
                            <td><?php echo $row['Tanggal_Jadwal']; ?></td>
                            <td><?php echo $row['Nama_Paket']; ?></td>
                            <td><?php echo $row['Nama_Pemandu']; ?></td>
                            <td><?php echo $row['Lokasi_Berkumpul']; ?></td>
                            <td><?php echo $row['Kuota_Max']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">Tidak ada jadwal wisata yang tersedia.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>