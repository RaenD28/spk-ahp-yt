<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "spk_ahp"; // nama database

$db = mysqli_connect($hostname, $username, $password, $database); // / koneksi ke database 

if ($db->connect_error) { // jika koneksi gagal
    echo "Koneksi gagal"; // tampilkan pesan gagal`
    die("Connection failed: " . $db->connect_error); // tampilkan pesan error
}
