<?php
session_start(); // memulai session untuk menyimpan data sementara di server
if (isset($_POST['logout'])) { // jika tombol logout pada form dengan method POST ditekan maka:
    session_unset(); // menghapus semua variabel yang ada di session. ini akan menghapus semua data yang ada di session.
    session_destroy(); // menghancurkan session yang sudah ada. ini akan menghapus semua data yang ada di session.
    header("Location: index.php"); // redirect ke halaman index.php
}
include_once 'service/kriteria-func.php'; // menghubungkan ke database
// $pro = new Kriteria($db);
// $stmt = $pro->readAll();
// $count = $pro->countAll();
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
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="js/script.js"></script>
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="kriteria-content">
        <h2 class="kriteria-title"> Data Kriteria </h2>

        <table class="kriteria-table">
            <thead>
                <tr>
                    <th>ID Kriteria</th>
                    <th>Nama Kriteria</th>
                    <!-- <th>Jumlah</th>
                    <th>Bobot Kriteria </th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    // Sertakan file koneksi database
                    include 'service/connection.php';

                    // Query untuk mengambil data dari tabel "kriteria"
                    $sql = "SELECT * FROM kriteria";
                    $result = $db->query($sql);

                    // Periksa apakah ada data
                    if ($result->num_rows > 0) {
                        // Loop melalui setiap baris data
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_kriteria"] . "</td>";
                            echo "<td>" . $row["nama_kriteria"] . "</td>";
                            // echo "<td>" . $row["jumlah_kriteria"] . "</td>";
                            // echo "<td>" . $row["bobot_kriteria"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'> Tidak ada kriteria yang masuk. </td></tr>";
                    }
                    // Tutup koneksi database
                    $db->close();
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>