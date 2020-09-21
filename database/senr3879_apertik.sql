-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2020 at 04:07 PM
-- Server version: 10.2.33-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senr3879_apertik`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_button`
--

CREATE TABLE `ref_button` (
  `id_button` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `ket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_button`
--

INSERT INTO `ref_button` (`id_button`, `nilai`, `ket`) VALUES
(1, 0, 'Stop');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrean`
--

CREATE TABLE `tbl_antrean` (
  `id_antrean` int(11) NOT NULL,
  `jenis_pengunjung` enum('Dewasa','Anak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga`
--

CREATE TABLE `tbl_harga` (
  `id_harga` int(11) NOT NULL,
  `harga_D` float NOT NULL,
  `harga_A` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_harga`
--

INSERT INTO `tbl_harga` (`id_harga`, `harga_D`, `harga_A`) VALUES
(4, 10000, 5000),
(14, 1500, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapatan`
--

CREATE TABLE `tbl_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_D` float NOT NULL,
  `jumlah_A` float NOT NULL,
  `sub_total_d` float NOT NULL,
  `sub_total_a` float NOT NULL,
  `total_bayar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendapatan`
--

INSERT INTO `tbl_pendapatan` (`id_pendapatan`, `tanggal`, `jumlah_D`, `jumlah_A`, `sub_total_d`, `sub_total_a`, `total_bayar`) VALUES
(1, '2020-09-03', 2, 0, 20000, 0, 20000),
(2, '2020-09-03', 3, 0, 30000, 0, 30000),
(3, '2020-09-07', 2, 0, 20000, 0, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_aplikasi`
--

CREATE TABLE `tbl_setting_aplikasi` (
  `id_setting` int(11) NOT NULL,
  `set_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting_aplikasi`
--

INSERT INTO `tbl_setting_aplikasi` (`id_setting`, `set_harga`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` enum('Pemilik','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'pemilik', '827ccb0eea8a706c4c34a16891f84e7b', 'Febi', 'Pemilik'),
(3, 'petugas', '827ccb0eea8a706c4c34a16891f84e7b', 'Dendi', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_button`
--
ALTER TABLE `ref_button`
  ADD PRIMARY KEY (`id_button`);

--
-- Indexes for table `tbl_antrean`
--
ALTER TABLE `tbl_antrean`
  ADD PRIMARY KEY (`id_antrean`);

--
-- Indexes for table `tbl_harga`
--
ALTER TABLE `tbl_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `tbl_setting_aplikasi`
--
ALTER TABLE `tbl_setting_aplikasi`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_button`
--
ALTER TABLE `ref_button`
  MODIFY `id_button` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_antrean`
--
ALTER TABLE `tbl_antrean`
  MODIFY `id_antrean` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_harga`
--
ALTER TABLE `tbl_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_setting_aplikasi`
--
ALTER TABLE `tbl_setting_aplikasi`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
