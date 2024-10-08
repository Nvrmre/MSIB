<?php
include 'src/koneksi.php';

$sql = "SELECT * FROM gudang";
$result = $conn->query($sql);

// Cek apakah ada kesalahan dalam query
if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Warehouse</title>
</head>
<body>
    <?php $no = 1;
    ?>
    <h1>Warehouse</h1>
    <table border="1">
        <tr>
            <th>NO</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Kapasitas</th>
            <th>Waktu Buka</th>
            <th>Waktu Tutup</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo htmlspecialchars($row['capacity']); ?></td>
            <td><?php echo htmlspecialchars($row['opening_hour']); ?></td>
            <td><?php echo htmlspecialchars($row['closing_hour']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="src/update.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="src/delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </td> 
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="src/create.php">tambahin</a>
    
</body>
</html>
