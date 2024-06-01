<?php

include "koneksi.php";



// Initialize variables for data retrieval and error handling
$data = [];
$errors = [];

// Check if the add form is submitted
if (isset($_POST['add'])) {
    // Get the data from the form
    $nisn = $_POST['id_user'];
    $nama = $_POST['email'];
    $kelas = $_POST['password']; 
    $waktu_absen = $_POST['role'];
    $status = $_POST['status'];

    // Validate the data if needed

    // Insert the absensi data into the database
    $query = "INSERT INTO absen (id_user, email, password, role, status) VALUES ('$nisn', '$nama', '$kelas', '$waktu_absen', '$status')";
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
        <label for="id_user">ID:</label><br>
        <input type="number" id="id-user" name="id_user"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password"><br>
        <label for="role">Role:</label><br>
        <input type="number" id="role" name="role" value="1" readonly> <br>
        <label for="status">Status:</label><br>
        <input type="number" id="status" name="status"><br>
        <input type="submit" name="add" value="Tambah"><br><br>
        <button><a href="tampil_user.php">kembali</a></button><br><br>
    </form>
</body>
</html>



