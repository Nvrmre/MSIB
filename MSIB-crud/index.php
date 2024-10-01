<?php
include 'src/koneksi.php';

$sql = "SELECT * FROM msib_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/style.css">
<head>
    <title>Data</title>
</head>
<body>
    <h1>Data</h1>
    <a href="src/create.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="src/update.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="src/delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
