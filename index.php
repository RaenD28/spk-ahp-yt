<?php
include "service/connection.php";
session_start(); // memulai session untuk menyimpan data login

$login_message = ""; // inisialisasi variabel login_message untuk menampung pesan login

// if (isset($_SESSION['is_login'])) {
//    header("Location: dashboard.php"); // jika session is_login sudah ada maka redirect ke halaman dashboard.php
// }

if (isset($_POST['login'])) { // jika tombol 'login' pada form dengan method POST ditekan maka: 
    $username = $_POST['username']; // ambil data username dari form
    $password = $_POST['password']; // ambil data password dari form

    // Menyiapkan prepared statement untuk mencegah SQL injection
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // untuk mengikat parameter ke dalam statement. ini untuk mencegah SQL injection. SQL injection adalah teknik yang digunakan oleh hacker untuk menyisipkan kode SQL ke dalam query yang dikirimkan ke database. ini bisa menyebabkan data di database diubah atau dihapus oleh hacker.
    $stmt->execute(); // mengeksekusi statement yang sudah disiapkan
    $result = $stmt->get_result(); // eksekusi statement dan ambil hasilnya

    if ($result->num_rows > 0) { // jika data yang diketik cocok dengan data yang ada di database maka:
        $data = $result->fetch_assoc(); // ambil data dari database
        $_SESSION['username'] = $data['username']; // simpan data username ke dalam session. session digunakan untuk menyimpan data sementara di server. session ini akan aktif selama browser masih terbuka. jika browser ditutup atau logout maka session akan hilang.
        $_SESSION['is_login'] = true; // simpan data is_login ke dalam session. is_login

        header("Location: kategori-konten.php"); // redirect ke halaman dashboard.php
    } else {
        $login_message = "Username atau password tidak ditemukan!"; // jika tidak ada data yang cocok maka tampilkan pesan ini
    }
    $stmt->close(); // untuk menutup koneksi ke database. ini penting untuk menghindari memory leak. 
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
    <div class="login-page">
        <img src="img/login-bg.png" alt="login background" class="login-img">
        <form action="index.php" method="post" class="login-form">
            <h2 class="login-title"> P, Login! </h2>
            <div class="login-content">
                <div class="login-box">
                    <label for="username" class="login-label">Username:</label><br><br>
                    <input type="text" id="username" name="username" class="login-input" required><br><br>
                </div>
                <div class="login-box">
                    <label for="password" class="login-label">Password:</label><br><br>
                    <input type="password" id="password" name="password" class="login-input" required><br>
                </div>
                <i class="login-message"> <?= $login_message ?> </i><br>
            </div>
            <button type="submit" class="login-button" name="login"> Login </button>
            <p class="to-regist"> Belum punya akun? Silakan daftar <span class="span-regist"> <a href="register.php" class="regist-a">di sini</a> </span> ygy</p>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/fc767d5de0.js" crossorigin="anonymous"></script>
</body>

</html>