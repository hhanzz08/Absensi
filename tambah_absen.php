<?php
session_start();
include "koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['login_status'])) {
    header("Location: login.php");
    exit;
}

// Initialize variables for data retrieval and error handling
$data = [];
$errors = [];

// Check if the add form is submitted
if (isset($_POST['add'])) {
    // Get the data from the form
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $waktu_absen = $_POST['waktu_absen'];
    $status = $_POST['status'];

    // Validate the data if needed

    // Insert the absensi data into the database
    $query = "INSERT INTO absen (nisn, nama, kelas, waktu_absen, status) VALUES ('$nisn', '$nama', '$kelas', '$waktu_absen', '$status')";
    $result = mysqli_query($koneksi, $query);

    // Check if the insert query was successful
    if ($result) {
        // Redirect back to the index page
        header("Location: index.php");
        exit;
    } else {
        // If the insert query failed, set an error message
        $errors[] = "Failed to add absensi data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Absensi</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Tambah Data Absensi</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <label for="nisn">NISN:</label><br>
        <input type="number" id="nisn" name="nisn" required><br>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br>
        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" required><br>
        <label for="waktu_absen">Waktu Absen:</label><br>
        <input type="datetime-local" id="waktu_absen" name="waktu_absen" required><br>
        <label for="status">Status:</label><br>
            <select id="status" name="status" required>
                <option value="hadir">Hadir</option>
                <option value="sakit">Sakit</option>
                <option value="izin">Izin</option>
            </select><br><br>
        <input type="submit" name="add" value="Tambah"><br><br>
        <button><a href="tampil_absen.php">kembali</a></button><br><br>
    </form>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
