<?php
session_start();

// Koneksi ke database
$servername = "localhost"; // Ganti jika perlu
$username = "root"; // Ganti jika perlu
$password = ""; // Ganti jika perlu
$dbname = "task_manager";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi sesi jika belum ada
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Fungsi untuk memuat tugas dari database
function loadTasks($conn) {
    $sql = "SELECT * FROM tasks";
    return $conn->query($sql);
}

// Tambah Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    $stmt = $conn->prepare("INSERT INTO tasks (task, priority) VALUES (?, ?)");
    $stmt->bind_param("ss", $task, $priority);
    $stmt->execute();
    $stmt->close();
}

// Hapus Task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Edit Task
if (isset($_POST['edit_task'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    $stmt = $conn->prepare("UPDATE tasks SET task = ?, priority = ? WHERE id = ?");
    $stmt->bind_param("ssi", $task, $priority, $id);
    $stmt->execute();
    $stmt->close();
}

// Muat tugas dari database
$tasks = loadTasks($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <form method="POST">
        <input type="text" name="task" placeholder="Add Task" required>
        <select name="priority">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <h2>Daftar Tugas</h2>
    <ul>
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($task['task']) . " (Priority: " . htmlspecialchars($task['priority']) . ")"; ?>
                <a href="index.php?delete=<?php echo $task['id']; ?>">Delete</a>
                <button onclick="document.getElementById('editForm-<?php echo $task['id']; ?>').style.display='block'">Edit</button>
            </li>
            <div id="editForm-<?php echo $task['id']; ?>" style="display:none;">
                <form method="POST">
                    <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
                    <select name="priority">
                        <option value="low" <?php if ($task['priority'] == 'low') echo 'selected'; ?>>Low</option>
                        <option value="medium" <?php if ($task['priority'] == 'medium') echo 'selected'; ?>>Medium</option>
                        <option value="high" <?php if ($task['priority'] == 'high') echo 'selected'; ?>>High</option>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit" name="edit_task">Update Task</button>
                </form>
            </div>
        <?php endwhile; ?>
    </ul>
</body>
</html>

<?php
$conn->close();
?>
