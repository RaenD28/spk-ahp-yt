<?php
session_start(); // memulai session untuk menyimpan data sementara di server
if (isset($_POST['logout'])) { // jika tombol logout pada form dengan method POST ditekan maka:
    session_unset(); // menghapus semua variabel yang ada di session. ini akan menghapus semua data yang ada di session.
    session_destroy(); // menghancurkan session yang sudah ada. ini akan menghapus semua data yang ada di session.
    header("Location: index.php"); // redirect ke halaman index.php
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
    <link rel="stylesheet" href="css/alternatif.css">
    <script src="js/script.js"></script>
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="alternatif-content">
        <h2 class="alternatif-title">Data Alternatif</h2>
        <h3>Kategori: <?php echo $_SESSION['kategori'] ?></h3>
        <table class="alternatif-table">
            <thead>
                <tr>
                    <th>ID Alternatif</th>
                    <th>Nama Alternatif </th>
                    <th>Subscriber</th>
                    <th>Views </th>
                    <th>Kategori </th>
                    <th>Link </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    include 'service/connection.php';
                    $kategori = $_SESSION['kategori'];
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
                            echo "<tr><td colspan='6'>Kategori tidak valid.</td></tr>";
                            exit();
                    }

                    $sql = "SELECT id_alter, nama_alter, subscriber, views, kategori, link FROM " . $tableName;
                    $result = $db->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id_alter"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama_alter"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["subscriber"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["views"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["kategori"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["link"]) . "</td>";
                                echo "</tr>";
                            }
                            $result->free(); // Bebaskan hasil query
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data untuk kategori ini.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Error executing query: " . $db->error . "</td></tr>";
                    }

                    $db->close(); // Tutup koneksi database
                    ?>
                </tr>
            </tbody>
        </table>
        <div class="note">
            <h3> - Data Mei 2025 </h3>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/fc767d5de0.js" crossorigin="anonymous"></script>
</body>

</html>