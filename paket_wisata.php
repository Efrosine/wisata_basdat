<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisatadb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT PaketWisata.ID_Paket, 
           PaketWisata.Nama_Paket, 
           PaketWisata.Harga_Paket, 
           PaketWisata.Durasi_Paket, 
           PaketWisata.Tipe_Paket, 
           DestinasiWisata.Nama_Destinasi
    FROM PaketWisata
    JOIN DestinasiWisata ON PaketWisata.ID_Destinasi = DestinasiWisata.ID_Destinasi
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata</title>
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
        <h2>Daftar Paket Wisata</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Paket</th>
                    <th>Nama Paket</th>
                    <th>Destinasi</th>
                    <th>Harga Paket</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["ID_Paket"] . "</td>
                                <td>" . $row["Nama_Paket"] . "</td>
                                <td>" . $row["Nama_Destinasi"] . "</td>
                                <td>" . $row["Harga_Paket"] . "</td>
                                <td>" . $row["Durasi_Paket"] . " hari</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>