<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'absensi');

if (mysqli_connect_errno()) {
    echo 'koneksi gagal: '.mysqli_connect_error();
}
