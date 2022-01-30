-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2022 pada 13.05
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webberita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `adminberita`
--

CREATE TABLE `adminberita` (
  `id` int(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `adminberita`
--

INSERT INTO `adminberita` (`id`, `nama`, `username`, `password`) VALUES
(1, 'kelompok5', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel_berita`
--

CREATE TABLE `artikel_berita` (
  `id` int(15) NOT NULL,
  `judul_artikel` varchar(255) NOT NULL,
  `isi_artikel` text NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp(),
  `gambar_artikel` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `artikel_berita`
--

INSERT INTO `artikel_berita` (`id`, `judul_artikel`, `isi_artikel`, `kategori`, `tanggal_input`, `gambar_artikel`) VALUES
(61, 'Vivo V23 5G Sudah Tersedia Offline di Indonesia, Bisa Tukar Tambah', 'Setelah diluncurkan 25 Januari, Vivo kini secara resmi mengonfirmasi V23 5G sudah tersedia di seluruh nusantara. Baik secara online maupn offline.', 'Teknologi', '2022-01-30', 'Vivo v23.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel_tags`
--

CREATE TABLE `artikel_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_artikel` bigint(20) UNSIGNED NOT NULL,
  `id_tag` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_artikel`
--

CREATE TABLE `kategori_artikel` (
  `id` int(25) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `nama_kategori`, `alias`) VALUES
(22, 'Teknologi', 'teknologi'),
(23, 'Olahraga', 'olahraga');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `adminberita`
--
ALTER TABLE `adminberita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `artikel_berita`
--
ALTER TABLE `artikel_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `artikel_tags`
--
ALTER TABLE `artikel_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_artikel` (`nama_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `adminberita`
--
ALTER TABLE `adminberita`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `artikel_berita`
--
ALTER TABLE `artikel_berita`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `artikel_tags`
--
ALTER TABLE `artikel_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
