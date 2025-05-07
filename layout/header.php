<?php
session_start(); // memulai session untuk menyimpan data sementara di server
?>
<nav class="header">
    <div class="header-logo">
        <a href="dashboard.php">
            <img src="icon/youtube-iconkw.png" alt="Logo" class="header-logo-img">
        </a>
    </div>
    <div class="header-nav">
        <div class="nav-button">
            <a href="dashboard.php">Home</a>
        </div>
        <div class="nav-button">
            <a href="kriteria.php">Kriteria</a>
        </div>
        <div class="nav-button">
            <a href="alternatif.php">Alternatif</a>
        </div>
        <div class="nav-button">
            <a href="analisis.php">Analisis</a>
        </div>
    </div>
    <div class="header-profile" onclick="toggleDropdown()">
        <h2 class="profile-text"> <?= $_SESSION['username'] ?> </h2>
        <div class="dropdown-menu" id="dropdownMenu">
            <form action="" method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        var menu = document.getElementById('dropdownMenu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
</script>