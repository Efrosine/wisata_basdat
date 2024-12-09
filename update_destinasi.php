<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisatadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil ID destinasi dari URL
$id_destinasi = $_GET['id'];

// Query untuk mengambil data destinasi berdasarkan ID
$sql = "SELECT * FROM DestinasiWisata WHERE ID_Destinasi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_destinasi);
$stmt->execute();
$result = $stmt->get_result();
$destinasi = $result->fetch_assoc();

// Jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_destinasi = $_POST['nama_destinasi'];
    $lokasi = $_POST['lokasi'];
    $tipe_wisata = $_POST['tipe_wisata'];
    $harga_tiket = $_POST['harga_tiket'];
    $jam_operasional = $_POST['jam_operasional'];

    // Update data destinasi
    $update_sql = "UPDATE DestinasiWisata SET Nama_Destinasi=?, Lokasi=?, Tipe_Wisata=?, Harga_Tiket=?, Jam_Operasional=? WHERE ID_Destinasi=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $nama_destinasi, $lokasi, $tipe_wisata, $harga_tiket, $jam_operasional, $id_destinasi);
    $update_stmt->execute();

    // Redirect ke halaman destinasi wisata setelah update
    header("Location: destinasi_wisata.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WisataDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="destinasi_wisata.php">Destinasi Wisata</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Update Destinasi Wisata</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_destinasi" class="form-label">Nama Destinasi</label>
                <input type="text" name="nama_destinasi" class="form-control" id="nama_destinasi"
                    value="<?php echo $destinasi['Nama_Destinasi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" id="lokasi"
                    value="<?php echo $destinasi['Lokasi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipe_wisata" class="form-label">Tipe Wisata</label>
                <input type="text" name="tipe_wisata" class="form-control" id="tipe_wisata"
                    value="<?php echo $destinasi['Tipe_Wisata']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                <input type="text" name="harga_tiket" class="form-control" id="harga_tiket"
                    value="<?php echo $destinasi['Harga_Tiket']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jam_operasional" class="form-label">Jam Operasional</label>
                <input type="text" name="jam_operasional" class="form-control" id="jam_operasional"
                    value="<?php echo $destinasi['Jam_Operasional']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>