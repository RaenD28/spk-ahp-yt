<?php
session_start(); // memulai session untuk menyimpan data sementara di server
include "service/connection.php"; // menghubungkan ke database
if (isset($_POST['logout'])) { // jika tombol logout pada form dengan method POST ditekan maka:
    session_unset(); // menghapus semua variabel yang ada di session. ini akan menghapus semua data yang ada di session.
    session_destroy(); // menghancurkan session yang sudah ada. ini akan menghapus semua data yang ada di session.
    header("Location: index.php"); // redirect ke halaman index.php
}

$tableName = '';
switch ($_SESSION['kategori']) {
    case 'Edukasi':
        $tableName = 'alter_edukasi';
        break;
    case 'Vtuber':
        $tableName = 'alter_vtuber';
        break;
    case 'Programming':
        $tableName = 'alter_programming';
        break;
    case 'Music':
        $tableName = 'alter_music';
        break;
    case 'Gaming':
        $tableName = 'alter_gaming';
        break;
    default:
        // Handle jika kategori tidak valid
        echo "Kategori tidak valid";
        exit();
}

$sql = "SELECT id_alter, nama_alter, subscriber, views, kategori, link FROM " . $tableName;
$res = $db->query($sql);
$alternatif = [];
while ($row = $res->fetch_assoc()) {
    $alternatif[] = $row['nama_alter'];
}

$kriteria = [];
$result = $db->query("SELECT * FROM kriteria");
while ($row = $result->fetch_assoc()) {
    $kriteria[] = $row['nama_kriteria'];
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
    <link rel="stylesheet" href="css/kriteria.css">
    <link rel="stylesheet" href="css/analisis.css">
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <?php include 'layout/header.php'; ?>

    <div class="perbandingan-kri-content">
        <h2 class="perbandingan-kri-title"> 1. Perbandingan Kriteria </h2>
        <table id="matrixInput" class="perbandingan-kri-table">
            <thead>
                <tr>
                    <th>Kriteria</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table> <br>

        <h2 class="perbandingan-kri-title"> 2. Perbandingan Alternatif <?php echo $_SESSION['kategori'] ?></h2>
        <table id="alternatifInput" class="perbandingan-kri-table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table> <br>
        <div class="hitung-container">
            <button class="hitung-ahp" onclick="hitungAHP()">Hitung AHP</button>
            <button class="hitung-ahp" id="resetButton">Reset perhitungan</button>
        </div>

        <div id="hasil"></div>
        <div id="hasilAlternatif"></div>
    </div>
    <?php include 'layout/footer.php'; ?>
    <script>
        window.kriteriaFromPHP = <?php echo json_encode($kriteria); ?>;
        window.alternatifFromPHP = <?php echo json_encode($alternatif); ?>;
    </script>
    <script src="js/script.js"></script>
</body>

</html>