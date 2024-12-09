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

// Ambil ID destinasi dari URL
$destinasi_id = $_GET['id'];

// Query untuk mengambil data destinasi
$sql_destinasi = "SELECT * FROM DestinasiWisata WHERE ID_Destinasi = ?";
$stmt = $conn->prepare($sql_destinasi);
$stmt->bind_param("i", $destinasi_id);
$stmt->execute();
$result_destinasi = $stmt->get_result();
$destinasi = $result_destinasi->fetch_assoc();

// Query untuk mengambil feedback
$sql_feedback = "SELECT f.Komentar, f.Rating, f.Tanggal_Feedback, w.Nama_Wisatawan
                 FROM feedback f
                 JOIN wisatawan w ON f.ID_Wisatawan = w.ID_Wisatawan
                 WHERE f.ID_Destinasi = ?";
$stmt_feedback = $conn->prepare($sql_feedback);
$stmt_feedback->bind_param("i", $destinasi_id);
$stmt_feedback->execute();
$result_feedback = $stmt_feedback->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi Wisata</title>
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
        <h2>Detail Destinasi Wisata: <?php echo $destinasi['Nama_Destinasi']; ?></h2>
        <p><strong>Lokasi:</strong> <?php echo $destinasi['Lokasi']; ?></p>
        <p><strong>Tipe Wisata:</strong> <?php echo $destinasi['Tipe_Wisata']; ?></p>
        <p><strong>Harga Tiket:</strong> <?php echo $destinasi['Harga_Tiket']; ?></p>
        <p><strong>Jam Operasional:</strong> <?php echo $destinasi['Jam_Operasional']; ?></p>

        <h4>Feedback Pengunjung</h4>
        <?php
        if ($result_feedback->num_rows > 0) {
            while ($feedback = $result_feedback->fetch_assoc()) {
                echo "<div class='mb-3'>
                        <p><strong>" . $feedback['Nama_Wisatawan'] . " (" . $feedback['Tanggal_Feedback'] . ")</strong></p>
                        <p><strong>Rating:</strong> " . $feedback['Rating'] . "/5</p>
                        <p><strong>Komentar:</strong> " . $feedback['Komentar'] . "</p>
                    </div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }
        ?>

        <!-- <h4>Berikan Feedback</h4> -->
        <!-- <form action="submit_feedback.php" method="POST">
            <input type="hidden" name="id_destinasi" value="<?php echo $destinasi['ID_Destinasi']; ?>">
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
            </div>
            <div class="mb-3">
                <label for="komentar" class="form-label">Komentar</label>
                <textarea name="komentar" id="komentar" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Feedback</button>
        </form> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$stmt_feedback->close();
$conn->close();
?>