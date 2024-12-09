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

// Query untuk menghapus data destinasi
$sql = "DELETE FROM DestinasiWisata WHERE ID_Destinasi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_destinasi);
$stmt->execute();

// Redirect ke halaman destinasi wisata setelah delete
header("Location: destinasi_wisata.php");
exit;

$stmt->close();
$conn->close();
?>