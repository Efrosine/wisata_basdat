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

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wisatawan = $_POST['Nama_Wisatawan'];
    $jenis_kelamin = $_POST['Jenis_Kelamin'];
    $tanggal_lahir = $_POST['Tanggal_Lahir'];
    $email = $_POST['Email'];
    $no_telepon = $_POST['No_Telepon'];

    // Query untuk insert data wisatawan
    $sql = "INSERT INTO wisatawan (Nama_Wisatawan, Jenis_Kelamin, Tanggal_Lahir, Email, No_Telepon)
            VALUES ('$nama_wisatawan', '$jenis_kelamin', '$tanggal_lahir', '$email', '$no_telepon')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='wisatawan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Wisatawan</title>
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
        <h2>Form Pendaftaran Wisatawan</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="Nama_Wisatawan" class="form-label">Nama Wisatawan</label>
                <input type="text" class="form-control" id="Nama_Wisatawan" name="Nama_Wisatawan" required>
            </div>
            <div class="mb-3">
                <label for="Jenis_Kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="Jenis_Kelamin" name="Jenis_Kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="Tanggal_Lahir" name="Tanggal_Lahir" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" required>
            </div>
            <div class="mb-3">
                <label for="No_Telepon" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="No_Telepon" name="No_Telepon" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>