<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM msib_data WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "UPDATE msib_data SET nama='$nama', email='$email' WHERE id=$id";
    
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
<link rel="stylesheet" href="../css/style.css">
<head>
    <title>Update Data</title>
</head>
<body>
    <h1>Update Data</h1>
    <form method="POST" action="">
        Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
    <p><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p>
</body>
</html>
