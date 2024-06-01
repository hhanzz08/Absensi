<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna memiliki akses yang sesuai
function checkAccess($allowedRoles) {
    // Periksa apakah pengguna telah login
    if (!isset($_SESSION['login_status'])) {
        header("Location: login.php");
        exit;
    }

    // Periksa apakah peran pengguna sesuai dengan yang diizinkan
    $userRole = $_SESSION['login_status']['role'];
    if (!in_array($userRole, $allowedRoles)) {
        header("Location: unauthorized.php");
        exit;
    }
}

// Atur halaman sesuai dengan peran pengguna
if (isset($_SESSION['login_status'])) {
    $userRole = $_SESSION['login_status']['role'];
    if ($userRole == 1) {
        // Jika peran adalah 1 (admin)
        checkAccess([1]); // Admin hanya dapat mengakses home
    } elseif ($userRole == 2) {
        
        checkAccess([2]); 
    } elseif ($userRole == 3) {
        
        checkAccess([3]); 
    }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color:#101e23;
        }

        header {
            background-color: #2c7a8b;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            background-color: #a7a738;
        }

        nav ul li a:hover {
            background-color: #777;
        }

        .logout-button-container {
            text-align: center;
            margin-top: auto;
            margin-bottom: 20px;
        }

        .logout-button {
            border: none;
            background-color: #00000000;
            color: #14ff49;
            padding: 10px 20px;
            text-align: center;
            justify-content: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang</h1>
        <nav>
            <ul>
                <?php
                // Tampilkan menu sesuai dengan peran pengguna
                if ($userRole == 1) { // Admin
                    echo '<li><a href="tampil_user.php">Daftar User</a></li>';
                } elseif ($userRole == 2) { // siswa
                    echo '<li><a href="tampil_absen.php">Absen</a></li>';
                } elseif ($userRole == 3) { // guru
                    echo '<li><a href="tampil_absen.php">Absen</a></li>';
                }
                ?>
               
            </ul>
           
        </nav>
        
    </header>
    <button class="logout-button" onclick="location.href='logout.php';">Logout</button>
    <!-- Konten halaman home -->
</body>
</html>



