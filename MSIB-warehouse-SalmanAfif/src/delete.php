<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM gudang WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    header('Location:../index.php');
} else {
    $_SESSION['message'] = "Error: " . $conn->error;
}
?>
