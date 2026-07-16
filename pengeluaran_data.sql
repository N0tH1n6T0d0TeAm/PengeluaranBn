-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2022 pada 07.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengeluaran_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cafes`
--

CREATE TABLE `cafes` (
  `id_cafe` int(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cafes`
--

INSERT INTO `cafes` (`id_cafe`, `nama_barang`) VALUES
(16, 'Ayam Bakar'),
(19, 'Indomies'),
(15, 'Mie Kwetiau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail__cafes`
--

CREATE TABLE `detail__cafes` (
  `id` int(11) NOT NULL,
  `id_cafe` int(10) NOT NULL,
  `id_transaksi_cafe` int(10) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `kwantitas` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail__cafes`
--

INSERT INTO `detail__cafes` (`id`, `id_cafe`, `id_transaksi_cafe`, `harga`, `kwantitas`, `satuan`, `diskon`, `total`) VALUES
(1, 16, 1, '12000', '2', 'kg', '12000', '12000'),
(2, 19, 2, '12000', '2', 'kg', '0', '24000'),
(3, 16, 3, '12000', '2', 'kg', '2000', '22000'),
(4, 19, 3, '15000', '2', 'ons', '1000', '29000'),
(5, 16, 4, '12000', '2', 'kg', '2000', '22000'),
(6, 19, 5, '12000', '2', 'kg', '12000', '12000'),
(7, 16, 5, '10000', '4', 'dus', '0', '40000'),
(8, 15, 6, '12000', '2', 'dus', '0', '24000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama_menu`) VALUES
(29, 'Ayam Lengkuas'),
(27, 'Bawang Putih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian__details`
--

CREATE TABLE `pembelian__details` (
  `id` int(11) NOT NULL,
  `id_rempah` int(20) NOT NULL,
  `id_transaksi` int(10) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `kwantitas` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian__details`
--

INSERT INTO `pembelian__details` (`id`, `id_rempah`, `id_transaksi`, `harga`, `kwantitas`, `satuan`, `diskon`, `total`) VALUES
(1, 27, 1, '12000', '2', 'kg', '12000', '12000'),
(2, 27, 2, '12000', '2', 'kg', '12000', '12000'),
(3, 28, 2, '15000', '2', 'kg', '2000', '28000'),
(4, 27, 3, '15000', '2', 'kg', '12000', '18000'),
(5, 28, 3, '15000', '2', 'kg', '0', '30000'),
(6, 27, 4, '12000', '2', 'kg', '12000', '12000'),
(7, 27, 5, '12000', '2', 'kg', '0', '24000'),
(8, 29, 6, '12000', '2', 'kg', '12000', '12000'),
(9, 27, 7, '12000', '2', 'kg', '12000', '12000'),
(10, 29, 8, '12000', '2', 'kg', '0', '24000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL,
  `transaksi_jumlah` varchar(255) NOT NULL,
  `pembayaran` int(255) NOT NULL,
  `no_nota` int(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `nama_toko`, `metode_pembayaran`, `kembalian`, `transaksi_jumlah`, `pembayaran`, `no_nota`, `tanggal`) VALUES
(4, 'Daffa', 'Cash', '0', '12000', 12000, 221013001, '2022-10-13'),
(5, 'Eden Farm', 'Debit', '1000', '24000', 25000, 221013002, '2022-10-13'),
(6, 'Eden Farm', 'Debit', '0', '12000', 12000, 221014001, '2022-10-14'),
(8, 'Matahari', 'Cash', '1000', '24000', 25000, 221014002, '2022-11-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi__cafes`
--

CREATE TABLE `transaksi__cafes` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL,
  `transaksi_jumlah` varchar(255) NOT NULL,
  `pembayaran` int(255) NOT NULL,
  `no_nota` int(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi__cafes`
--

INSERT INTO `transaksi__cafes` (`id`, `nama_toko`, `metode_pembayaran`, `kembalian`, `transaksi_jumlah`, `pembayaran`, `no_nota`, `tanggal`) VALUES
(1, 'Daffa', 'Cash', '2000', '12000', 12000, 221012003, '2022-10-12'),
(4, 'Eden Farms', 'Cash', '1000', '22000', 23000, 221013001, '2022-10-13'),
(6, 'Daffa', 'Debit', '1000', '24000', 25000, 221014002, '2022-11-23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cafes`
--
ALTER TABLE `cafes`
  ADD PRIMARY KEY (`id_cafe`),
  ADD UNIQUE KEY `cafes` (`nama_barang`);

--
-- Indeks untuk tabel `detail__cafes`
--
ALTER TABLE `detail__cafes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus` (`nama_menu`);

--
-- Indeks untuk tabel `pembelian__details`
--
ALTER TABLE `pembelian__details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi__cafes`
--
ALTER TABLE `transaksi__cafes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cafes`
--
ALTER TABLE `cafes`
  MODIFY `id_cafe` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `detail__cafes`
--
ALTER TABLE `detail__cafes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `pembelian__details`
--
ALTER TABLE `pembelian__details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi__cafes`
--
ALTER TABLE `transaksi__cafes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
