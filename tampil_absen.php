<?php
session_start();
include "koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['login_status'])) {
    header("Location: login.php");
    exit;
}

// Fetch absensi data
$result = mysqli_query($koneksi, "SELECT * FROM absen");

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>
    <style>
        /* Resetting some default styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
    max-width: 800px;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

td {
    border-bottom: 1px solid #ddd;
}

td:last-child {
    display: flex;
    justify-content: space-around;
}

button {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    opacity: 0.8;
}

button[type="submit"] {
    background-color: #007bff;
    color: white;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

button[type="button"] {
    background-color: #dc3545;
    color: white;
}

button[type="button"]:hover {
    background-color: #c82333;
}

form {
    margin: 0;
}

form[action="logout.php"] {
    margin-top: 20px;
}

form[action="logout.php"] button {
    width: 100%;
    max-width: 150px;
}

    </style>
</head>
<body>
    <h2>Data Absensi</h2>
    <table border="1">
        <tr>
         
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Waktu Absen</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($d = mysqli_fetch_assoc($result)): ?>
        <tr>
          
                    <td><?= $d['nisn']; ?></td>
                    <td><?= $d['nama']; ?></td>
                    <td><?= $d['kelas']; ?></td>
                    <td><?= $d['waktu_absen']; ?></td>
                    <td><?= $d['status']; ?></td>
                    <td>
                        <form method="get" action="edit_absen.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $d['nisn']; ?>">
                    <button type="submit">Edit</button>
                         </form>
                        <form method="get" action="delete.php" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?= $d['nisn']; ?>">
                    <button type="submit">Hapus</button>
                        </form>
                    </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <form method="post" action="tambah_absen.php">
        <button type="submit">Ayo Absen</button>
    </form><br><br>
    
    <form method="post" action="index.php">
        <button type="submit">Kembali</button>
    </form>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
