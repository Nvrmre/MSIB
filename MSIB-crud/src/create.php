<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "INSERT INTO msib_data (nama, email) VALUES ('$nama', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Data berhasil ditambahkan!";
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../css/style.css">
<head>
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="POST" action="">
        Nama: <input type="text" name="nama" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Tambah">
    </form>
    <p><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p>
</body>
</html>
