-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 09:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_trpl2c`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `prodi_id`, `foto`) VALUES
('1001009', 'Raden Darren', 4, 'photo_2024-12-10_10-57-20.jpg'),
('21110909', 'Wielino Raja Iblis', 1, 'photo_2024-12-10_10-57-25.jpg'),
('211109090', 'Raden Darren', 7, 'photo_2024-12-10_10-57-20.jpg'),
('22847738', 'lois botman', 3, 'uploads/1736493911_FB_IMG_1719661142148.jpg'),
('56987431', 'Javier wkwkwk', 5, 'photo_2024-12-10_10-57-23.jpg'),
('878789', 'Si Paling Dingin', 6, 'FB_IMG_1721235605219.jpg'),
('9095678', 'Akane', 3, 'photo_2024-12-10_10-57-28.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `email`, `nim`, `gender`, `hobi`, `alamat`, `prodi_id`) VALUES
(1, 'Drenzzzzzzzzzzzzzzz', 'hayyukk@gmail.com', '49', '', 'Salto, Terbang, Khutbah', 'Padang Kota', 7),
(5, 'Drenz', 'realdrenzzz@gmail.com', '999', '', 'Salto, Terbang', 'Padang', NULL),
(6, 'fufufafa', 'fufufafa@gmail.com', '2', 'Laki-laki', 'Salto, Terbang', 'entah berantah', NULL),
(9, 'fufufafa', 'fufufafa@gmail.com', '2990', 'Laki-laki', 'Salto, Terbang', 'entah berantah', 3),
(11, 'fufufafa', 'fufufafa@gmail.com', '02', 'Laki-laki', 'Salto, Terbang', 'entah berantah', NULL),
(12, 'miaw', 'miaw@gmail.com', '1230', 'Laki-laki', 'Salto, Terbang, Khutbah', 'rumah', 3),
(13, 'apalah', 'lelellelel@gmail.com', '123123733', 'Perempuan', 'Salto', 'antartika', 3),
(16, '1C_Muhammad Naufal Nazya Azzhari', 'naufalnazya@gmail.com', '1112222', 'Laki-laki', 'Terbang, Khutbah', 'Jl kusuma bakti, Kel. Campago Ipuh, Kec. Mandiangin Koto Selayan', NULL),
(18, 'amba', 'amba@aapalah.com', '1901901910', 'Perempuan', 'Salto', 'amerika barat', NULL),
(19, 'miaw', 'xyz@gmail.com', '990909090876545', 'Perempuan', 'Salto, Terbang', 'rumah', 1),
(20, 'kewer', 'apalah@gmail.com', '56565656', 'Perempuan', 'Salto, Terbang, Khutbah', 'tiang listrik kuranji', 3),
(21, 'realdrenzzz', 'realdrenzzz@gmail.com', '4909', 'Laki-laki', 'Salto, Khutbah', 'rumah asli padang', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(64) NOT NULL,
  `sks` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mk`, `nama_mk`, `sks`, `prodi_id`, `semester`) VALUES
('1001', 'Sejarah Kedokteran', 23, 1, 1),
('9', 'Algoritma', 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` enum('D2','D3','D4','S1','S2') NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `jenjang`, `keterangan`) VALUES
(1, 'Teknik Kedokteran', 'S1', 'tidak ada'),
(3, 'Teknik Hukum', 'S2', 'apalah'),
(4, 'Sastra Informatika', 'D4', 'cihuy'),
(5, 'Teknik Seni Budaya', 'D4', 'aku mau sprei gratis'),
(6, 'Pendidikan Keolahragaan', 'S1', 'Menjadi Pemain Bola Profesional'),
(7, 'Teknik Mesin', 'D4', 'Solidarity M Forever'),
(8, 'Psikologi', 'S1', 'pesikolog');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin@gmail.com', 'a7ef174d3ed272acd2b72913a7ef9d40', 'Administrator\r\n', 'admin'),
(2, 'staff@gmail.com', 'a7ef174d3ed272acd2b72913a7ef9d40', 'Staff Akademik', 'staff'),
(3, 'naufalnazya@gmail.com', 'd61155f6f6120c0f17546b5311b08f9e', 'Owner', 'admin'),
(4, 'staff@gmail.com', '1253208465b1efa876f982d8a9e73eef', 'Member Hitam', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `fk_prodi2` (`prodi_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `fk_prodi` (`prodi_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mk`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_prodi2` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
