<?php
session_start();
if (isset($_POST['kategori'])) {
    $_SESSION['kategori'] = $_POST['kategori'];
    $_SESSION['is_login'] = true;
    header("Location: dashboard.php");
    exit;
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
    <link rel="stylesheet" href="css/kategori.css">
    <link rel="icon" href="icon/youtube-iconkw.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title> SPK AHP Rekomendasi Channel Youtube </title>
</head>

<body>
    <div class="kategori-content">
        <img src="img/kategori-bg.jpg" alt="category background" class="kategori-img">
        <div class="kategori-container">
            <h1> Haloo <?= $_SESSION['username'] ?>! Silakan pilih kategori yang kamu suka!</h1>
            <div class="kategori-button-group">
                <button class="kategori-button" data-kategori="Edukasi"><img src="icon/edukasi.svg" alt=""> Edukasi</button>
                <button class="kategori-button" data-kategori="Vtuber"><img src="icon/vtuber.svg" alt=""> Vtuber</button>
                <button class="kategori-button" data-kategori="Programming"><img src="icon/programming.svg" alt=""> Programming</button>
                <button class="kategori-button" data-kategori="Music"><img src="icon/music.svg" alt=""> Music</button>
                <button class="kategori-button" data-kategori="Gaming"><img src="icon/gaming.svg" alt=""> Gaming</button>
            </div>
            <form id="kategori-form" action="" method="POST">
                <input type="hidden" name="kategori" id="kategori-terpilih">
                <button id="lanjut" type="submit" disabled> Lanjut</button>
            </form>
        </div>
    </div>

    <script>
        const buttons = document.querySelectorAll('.kategori-button');
        const lanjutButton = document.getElementById('lanjut');
        const kategoriInput = document.getElementById('kategori-terpilih');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('selected'));
                button.classList.add('selected');
                lanjutButton.disabled = false;
                kategoriInput.value = button.dataset.kategori;
            });
        });
    </script>

    <script src="https://kit.fontawesome.com/fc767d5de0.js" crossorigin="anonymous"></script>
</body>

</html>