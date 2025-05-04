-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2025 at 02:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_ahp`
--

-- --------------------------------------------------------

--
-- Table structure for table `alter_edukasi`
--

CREATE TABLE `alter_edukasi` (
  `id_alter` varchar(10) NOT NULL,
  `nama_alter` varchar(50) NOT NULL,
  `subscriber` int NOT NULL,
  `views` bigint NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alter_edukasi`
--

INSERT INTO `alter_edukasi` (`id_alter`, `nama_alter`, `subscriber`, `views`, `kategori`, `link`) VALUES
('A01', 'Sisi Terang', 10000000, 2357740636, 'Edukasi', 'www.youtube.com/@SISITERANG'),
('A02', 'Kok Bisa?', 5700000, 1262546607, 'Edukasi', 'www.youtube.com/@KokBisa'),
('A03', 'Satu Persen - Indonesian Life School', 3410000, 211530513, 'Edukasi', 'www.youtube.com/@SatuPersenIndonesianLifeschool'),
('A04', 'Neuron', 1230000, 82004104, 'Edukasi', 'www.youtube.com/@Neuronmedia'),
('A05', 'Raymond Chins', 2890000, 790165403, 'Edukasi', 'www.youtube.com/@RaymondChins');

-- --------------------------------------------------------

--
-- Table structure for table `alter_gaming`
--

CREATE TABLE `alter_gaming` (
  `id_alter` varchar(10) NOT NULL,
  `nama_alter` varchar(50) NOT NULL,
  `subscriber` int NOT NULL,
  `views` bigint NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alter_gaming`
--

INSERT INTO `alter_gaming` (`id_alter`, `nama_alter`, `subscriber`, `views`, `kategori`, `link`) VALUES
('A01', 'MiawAug', 23800000, 7537220602, 'Gaming', 'www.youtube.com/@Miawaug'),
('A02', 'Windah Basudara', 16500000, 4465945486, 'Gaming', 'www.youtube.com/@WindahBasudara'),
('A03', 'Milyhya', 5780000, 942174979, 'Gaming', 'www.youtube.com/@MILYHYA'),
('A04', 'Windia Nata', 1960000, 467941104, 'Gaming', 'www.youtube.com/@WindiaNata'),
('A05', 'Droomp', 1360000, 298615979, 'Gaming', 'www.youtube.com/@Droomp');

-- --------------------------------------------------------

--
-- Table structure for table `alter_music`
--

CREATE TABLE `alter_music` (
  `id_alter` varchar(10) NOT NULL,
  `nama_alter` varchar(50) NOT NULL,
  `subscriber` int NOT NULL,
  `views` bigint NOT NULL,
  `kategori` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alter_music`
--

INSERT INTO `alter_music` (`id_alter`, `nama_alter`, `subscriber`, `views`, `kategori`, `link`) VALUES
('A01', 'NoCopyrightSounds', 34000000, 11736004576, 'Music', 'www.youtube.com/@NoCopyrightSounds'),
('A02', 'THE FIRST TAKE', 10700000, 5464657410, 'Music', 'www.youtube.com/@The_FirstTake'),
('A03', 'Ayase / YOASOBI', 7130000, 5578501438, 'Music', 'www.youtube.com/@Ayase_YOASOBI'),
('A04', 'TheFatRat', 6600000, 2088886463, 'Music', 'www.youtube.com/@TheFatRat'),
('A05', 'heiakim', 2070000, 303040899, 'Music', 'www.youtube.com/@heiakim');

-- --------------------------------------------------------

--
-- Table structure for table `alter_programming`
--

CREATE TABLE `alter_programming` (
  `id_alter` varchar(10) NOT NULL,
  `nama_alter` varchar(50) NOT NULL,
  `subscriber` int NOT NULL,
  `views` bigint NOT NULL,
  `kategori` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alter_programming`
--

INSERT INTO `alter_programming` (`id_alter`, `nama_alter`, `subscriber`, `views`, `kategori`, `link`) VALUES
('A01', 'Web Programming UNPAS', 946000, 100012154, 'Programming', 'www.youtube.com/@sandhikagalihWPU'),
('A02', 'Dea Afrizal', 524000, 36027114, 'Programming', 'www.youtube.com/@deaafrizal'),
('A03', 'Kelas Terbuka', 445000, 29148257, 'Programming', 'www.youtube.com/@KelasTerbuka'),
('A04', 'Programmer Zaman Now', 286000, 25840175, 'Programming', 'www.youtube.com/@ProgrammerZamanNow'),
('A05', 'sagalanichol', 178000, 54773883, 'Programming', 'www.youtube.com/@sagalanichol');

-- --------------------------------------------------------

--
-- Table structure for table `alter_vtuber`
--

CREATE TABLE `alter_vtuber` (
  `id_alter` varchar(10) NOT NULL,
  `nama_alter` varchar(50) NOT NULL,
  `subscriber` int NOT NULL,
  `views` bigint NOT NULL,
  `kategori` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alter_vtuber`
--

INSERT INTO `alter_vtuber` (`id_alter`, `nama_alter`, `subscriber`, `views`, `kategori`, `link`) VALUES
('A01', 'Kobo Kanaeru Ch. hololive-ID', 2670000, 212583162, 'Vtuber', 'www.youtube.com/@KoboKanaeru'),
('A02', 'Kureiji Ollie Ch. hololive-ID', 1370000, 88869342, 'Vtuber', 'www.youtube.com/@KureijiOllie'),
('A03', 'Moona Hoshinova hololive-ID', 1380000, 135054285, 'Vtuber', 'www.youtube.com/@MoonaHoshinova'),
('A04', 'Ayunda Risu Ch. hololive-ID', 944000, 78379014, 'Vtuber', 'www.youtube.com/@AyundaRisu'),
('A05', 'Kaela Kovalskia Ch. hololive-ID', 855000, 94781343, 'Vtuber', 'www.youtube.com/@KaelaKovalskia');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jumlah_kriteria` double DEFAULT NULL,
  `bobot_kriteria` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `jumlah_kriteria`, `bobot_kriteria`) VALUES
('K01', 'Kualitas Konten', 2.239, 0.56),
('K02', 'Konsistensi Upload', 1.058, 0.265),
('K03', 'Views', 0.489, 0.122),
('K04', 'Subscriber', 0.214, 0.053);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(20, 'Rendy aja', 'admin123'),
(21, 'vinabogor', 'admin123'),
(25, 'John', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alter_edukasi`
--
ALTER TABLE `alter_edukasi`
  ADD PRIMARY KEY (`id_alter`),
  ADD UNIQUE KEY `nama_alter` (`nama_alter`);

--
-- Indexes for table `alter_gaming`
--
ALTER TABLE `alter_gaming`
  ADD PRIMARY KEY (`id_alter`),
  ADD UNIQUE KEY `nama_alter` (`nama_alter`);

--
-- Indexes for table `alter_music`
--
ALTER TABLE `alter_music`
  ADD PRIMARY KEY (`id_alter`),
  ADD UNIQUE KEY `nama_alter` (`nama_alter`);

--
-- Indexes for table `alter_programming`
--
ALTER TABLE `alter_programming`
  ADD PRIMARY KEY (`id_alter`),
  ADD UNIQUE KEY `nama_alter` (`nama_alter`);

--
-- Indexes for table `alter_vtuber`
--
ALTER TABLE `alter_vtuber`
  ADD PRIMARY KEY (`id_alter`),
  ADD UNIQUE KEY `nama_alter` (`nama_alter`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
