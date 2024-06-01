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

// Check if an ID parameter is provided in the URL
if (isset($_GET['id'])) {
    // Get the ID parameter from the URL
    $id = $_GET['id'];

    // Fetch the specific absensi data based on the ID
    $query = "SELECT * FROM absen WHERE nisn = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the absensi data
        $data = mysqli_fetch_assoc($result);

        // Free the result variable
        mysqli_free_result($result);
    } else {
        // If the query failed, set an error message
        $errors[] = "Failed to fetch absensi data: " . mysqli_error($koneksi);
    }
} else {
    // If no ID parameter is provided, set an error message
    $errors[] = "ID parameter is missing.";
}

// Check if the edit form is submitted
if (isset($_POST['edit'])) {
    // Get the updated data from the form
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $waktu_absen = $_POST['waktu_absen'];
    $status = $_POST['status'];

    // Validate the data if needed

    // Update the absensi data in the database
    $query = "UPDATE absen SET nama='$nama', kelas='$kelas', waktu_absen='$waktu_absen', status='$status' WHERE nisn='$id'";
    $result = mysqli_query($koneksi, $query);

    // Check if the update query was successful
    if ($result) {
        // Redirect back to the index page
        header("Location: index.php");
        exit;
    } else {
        // If the update query failed, set an error message
        $errors[] = "Failed to update absensi data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Absensi</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Edit Data Absensi</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= isset($data['nama']) ? $data['nama'] : ''; ?>"><br>
        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" value="<?= isset($data['kelas']) ? $data['kelas'] : ''; ?>"><br>
        <label for="waktu_absen">Waktu Absen:</label><br>
        <input type="text" id="waktu_absen" name="waktu_absen" value="<?= isset($data['waktu_absen']) ? $data['waktu_absen'] : ''; ?>"><br>
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="<?= isset($data['status']) ? $data['status'] : ''; ?>"><br><br>
        <input type="submit" name="edit" value="Simpan">
    </form>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
