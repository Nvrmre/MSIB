<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM gudang WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $status = $_POST['status'];
    $lokasi =$_POST['location'];
    $kapasitas = $_POST['capacity'];
    $buka = $_POST['opening_hour'];
    $tutup = $_POST['closing_hour'];

    $sql = "UPDATE gudang SET 
         name='$nama',
          capacity='$kapasitas',
            location='$lokasi',
             opening_hour='$buka',
            closing_hour='$tutup',
         status='$status'

     WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Data berhasil diupdate!";
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
</head>
<body>
    <h1>Update Data</h1>
    <form method="POST" action="update.php">
        Nama: <input type="text" name="nama" value="<?php echo $nama['name'];?>"><br>
        Lokasi: <input type="text" name="location"><br>
        Kapasitas: <input type="number" name="capacity"><br>
        Status: 
        <select name="status">
            <option value="">Pilih Status</option>
            <option value="aktif">Aktif</option>
            <option value="tidak aktif">Tidak Aktif</option>
        </select>
        <br>
        Waktu Buka: <input type="time" name="opening_hour"><br>
        Waktu Tutup: <input type="time" name="closing_hour"><br>
        <input type="submit" value="Tambah">
    </form>
    <p><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p>
</body>
</html>
