<?php
session_start(); // memulai session untuk menyimpan data sementara di server
if (isset($_POST['logout'])) { // jika tombol logout pada form dengan method POST ditekan maka:
    session_unset(); // menghapus semua variabel yang ada di session. ini akan menghapus semua data yang ada di session.
    session_destroy(); // menghancurkan session yang sudah ada. ini akan menghapus semua data yang ada di session.
    header("Location: index.php");
    exit; // redirect ke halaman index.php
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
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="js/script.js">
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="dashboard-content">
        <div class="welcome-container">
            <h1 class="welcome">Welcome, <?php echo $_SESSION['username'] ?>!</h1>
        </div>
        <h2 class="pengantar-sub">Analytic Hierarchy Process</h2>
        <p class="pengantar-text">
            AHP merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki, menurut Saaty (1993), hirarki didefinisikan sebagai suatu representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi-level dimana level pertama adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif. Dengan hirarki, suatu masalah yang kompleks dapat diuraikan ke dalam kelompok-kelompoknya yang kemudian diatur menjadi suatu bentuk hirarki sehingga permasalahan akan tampak lebih terstruktur dan sistematis (Syaifullah, 2010).</p>
        <p> AHP didasarkan pada prinsip decomposisi, perbandingan berpasangan, dan sintesis prioritas. Metode ini memungkinkan pengambil keputusan untuk: </p>
        <ul class="pengantar-list">
            <li>Mengurai masalah kompleks menjadi hierarki yang terdiri dari tujuan, kriteria, subkriteria, dan alternatif.</li>
            <li>Melakukan perbandingan berpasangan antara elemen-elemen dalam setiap tingkatan hierarki untuk menentukan tingkat kepentingan relatif mereka.</li>
            <li>Menggabungkan hasil perbandingan tersebut untuk menghitung prioritas akhir bagi setiap alternatif.</li>
        </ul>
        <hr>

        <h2 class="pengantar-sub">Tabel Skala Penilaian</h2>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th width="25%">Intensitas Kepentingan</th>
                    <th>Definisi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sama pentingnya dibandingkan yang lain</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sedikit lebih penting dibandingkan yang lain</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Cukup penting dibandingkan yang lain</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Sangat penting dibandingkan yang lain</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Mutlak lebih penting dibandingkan yang lain</td>
                </tr>
                <tr>
                    <td>1/(1-9)</td>
                    <td>Kebalikan dari nilai 1-9</td>
                </tr>
            </tbody>
        </table>
        <hr>

        <h2 class="pengantar-sub"> SPK rekomendasi channel youtube menggunakan metode AHP </h2>
        <p class="pengantar-text">
            Aplikasi ini menerapkan metode AHP untuk memberikan rekomendasi channel youtube berdasarkan kriteria yang telah ditentukan. Pengguna dapat melakukan perbandingan antar kriteria dan alternatif untuk mendapatkan hasil yang lebih akurat. Tergantung dari kategori yang dipilih, data alternatif yang ditampilkan akan disesuakan berdasarkan kategori tersebut. Dengan menggunakan aplikasi ini user hanya perlu menginput nilai pada kriteria yang telah disajikan dan nilai perbandingan terhadap masing-masing alternatif yang ada. Setelah itu, aplikasi akan menghitung bobot dari masing-masing alternatif berdasarkan kriteria yang telah ditentukan. Hasil akhir dari aplikasi ini adalah rekomendasi channel youtube yang sesuai dengan kriteria yang telah ditentukan oleh user.
        </p>
        <h3> Selamat mencoba ~ </h3> <br><br><br>

    </div>


    <?php include 'layout/footer.php'; ?>
    <script src="https://kit.fontawesome.com/fc767d5de0.js" crossorigin="anonymous"></script>
</body>

</html>