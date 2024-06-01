<?php

session_start();
include "koneksi.php";

$errors = [];

if (!empty($_POST['save'])) {
    $email = $_POST['email'];
    $password = $_POST['password'] == '' ? null : md5($_POST['password']);

    if (empty($email) || empty($password)) {
        $errors[] = 'Email dan password harus diisi.';
    } else {
        $getUser = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");
        $user = mysqli_fetch_array($getUser);

        if (empty($user)) {
            $errors[] = 'Akun tidak ditemukan';
        } else {
            $_SESSION['login_status'] = [
                'role' => $user['role']
            ];
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-body {
    padding: 30px;
    background-color: #fff;
}

.form-label {
    margin-bottom: 10px;
    font-weight: bold;
    color: #555;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 20px;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.row {
    margin: 0;
}

.mt-5 {
    margin-top: 3rem !important;
}

.text-center {
    text-align: center;
}

.alert {
    color: red;
    text-align: center;
    margin-bottom: 20px;
}

    </style>
</head>
<body>
<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Login</h2>
                
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="LOGIN" />
                </form><br>
                <a href="info.php">belum punya akun?</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<?php

?>