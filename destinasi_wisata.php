<?php
$servername = "localhost"; // atau gunakan "127.0.0.1"
$username = "root"; // sesuaikan dengan username Anda
$password = ""; // sesuaikan dengan password Anda
$dbname = "wisatadb"; // nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM DestinasiWisata";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata</title>
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
        <h2>Daftar Destinasi Wisata</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Destinasi</th>
                    <th>Nama Destinasi</th>
                    <th>Lokasi</th>
                    <th>Tipe Wisata</th>
                    <th>Harga Tiket</th>
                    <th>Jam Operasional</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["ID_Destinasi"] . "</td>
                                <td><a href='detail_wisata.php?id=" . $row["ID_Destinasi"] . "'>" . $row["Nama_Destinasi"] . "</a></td>
                                <td>" . $row["Lokasi"] . "</td>
                                <td>" . $row["Tipe_Wisata"] . "</td>
                                <td>" . $row["Harga_Tiket"] . "</td>
                                <td>" . $row["Jam_Operasional"] . "</td>
                                 <td>
                        <a href='update_destinasi.php?id=" . $row["ID_Destinasi"] . "' class='btn btn-warning btn-sm'>Update</a>
                        <a href='delete_destinasi.php?id=" . $row["ID_Destinasi"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                    </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
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