<?php
include "service/connection.php"; // Menghubungkan dengan file koneksi database

$register_message = ""; // Inisialisasi variabel untuk pesan registrasi

if (isset($_POST['register'])) {
    // Cek jika tombol register ditekan
    $username = $_POST['username']; // Ambil username dari form
    $password = $_POST['password']; // Ambil password dari form

    // Validasi jika username dan password kosong
    if (empty($username) || empty($password)) {
        $register_message = "Username dan password harus diisi!";
    } else {
        // Validasi panjang username
        if (strlen($username) > 20) {
            $register_message = "Username tidak boleh lebih dari 20 karakter!";
        } else {
            // Menggunakan prepared statement MySQLi untuk menghindari SQL Injection
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

            if ($stmt === false) {
                die('Prepare statement gagal: ' . $db->error);
            }

            // Bind parameter dengan tipe data yang sesuai
            // 's' untuk string (username), 's' untuk string (password)
            $stmt->bind_param('ss', $username, $password);

            // Eksekusi statement dan cek apakah berhasil
            if ($stmt->execute()) {
                header("Location: index.php"); // Redirect jika berhasil
                exit(); // Pastikan script berhenti setelah redirect
            } else {
                $register_message = "Data gagal masuk, silakan coba lagi!"; // Pesan error jika gagal
            }

            $stmt->close(); // Menutup statement setelah selesai
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <div class="regist-page">
        <img src="img/login-bg.png" alt="login background" class="regist-img">
        <form action="register.php" method="post" class="regist-form">
            <h2 class="regist-title"> Daftar sekarang! </h2>
            <div class="regist-content">
                <div class="regist-box">
                    <label for="username" class="regist-label">Username:</label><br><br>
                    <input type="text" id="username" name="username" class="regist-input" required><br><br>
                </div>
                <div class="regist-box">
                    <label for="password" class="regist-label">Password:</label><br><br>
                    <input type="password" id="password" name="password" class="regist-input" required><br><br>
                </div>
                <i> <?= $register_message ?></i><br>
            </div>
            <a href="index.php">
                <button type="submit" class="regist-button" name="register"> Register </button>
            </a>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/fc767d5de0.js" crossorigin="anonymous"></script>
</body>

</html>