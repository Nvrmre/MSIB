<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $lokasi = $_POST['location'];
    $kapasitas = $_POST['capacity'];
    $buka = $_POST['opening_hour'];
    $tutup = $_POST['closing_hour'];
    $status = $_POST['status'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO gudang (name, location, capacity, opening_hour, closing_hour, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $lokasi, $kapasitas, $buka, $tutup, $status);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Data berhasil ditambahkan!";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="POST" action="">
        Nama: <input type="text" name="name" required><br>
        Lokasi: <input type="text" name="location" required><br>
        Kapasitas: <input type="number" name="capacity" required><br>
        Status: 
        <select name="status" required>
            <option value="">Pilih Status</option>
            <option value="aktif">Aktif</option>
            <option value="tidak_aktif">Tidak Aktif</option>
        </select>
        <br>
        Waktu Buka: <input type="time" name="opening_hour" required><br>
        Waktu Tutup: <input type="time" name="closing_hour" required><br>
        <input type="submit" value="Tambah">
    </form>
    <p><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p>
</body>
</html>
