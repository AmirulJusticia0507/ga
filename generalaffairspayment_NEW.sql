-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2023 pada 10.24
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paymentreceipt_apps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvalpaymentreceipt`
--

CREATE TABLE `approvalpaymentreceipt` (
  `approval_id` int(3) NOT NULL,
  `approveby` varchar(100) NOT NULL,
  `departments_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `archieved`
--

CREATE TABLE `archieved` (
  `id_archieved` int(3) NOT NULL,
  `payments_id` int(3) DEFAULT NULL,
  `namarequestPR` varchar(150) NOT NULL,
  `managerapproved` varchar(150) NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `hargarencana` int(10) DEFAULT NULL,
  `hargaaktual` int(10) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` int(3) DEFAULT NULL,
  `usage` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `base`
--

CREATE TABLE `base` (
  `base_id` bigint(20) UNSIGNED NOT NULL,
  `basename` varchar(20) NOT NULL,
  `keteranganbase` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `base`
--

INSERT INTO `base` (`base_id`, `basename`, `keteranganbase`) VALUES
(1, 'Balikpapan', 'Sultan Aji Muhammad Sulaiman Sepinggan International Airport, Balikpapan'),
(3, 'Jakarta', 'Bandar Udara Halim Perdanakusuma, Jakarta'),
(4, 'Kupang', 'Bandara Internasional El Tari Kupang'),
(5, 'Malinau', 'Bandar Udara Malinau Robert Atty Bessing, Kabupaten Malinau, Provinsi Kalimantan Utara'),
(7, 'Medan', 'Bandar Udara Internasional Kualanamu, Medan'),
(8, 'Nabire', 'Bandar Udara Nabire, Papua'),
(9, 'Sentani', 'Bandar Udara Internasional Dortheys Hiyo Eluay, Sentani, Jayapura'),
(10, 'Tarakan', 'Bandara Internasional Juwata Tarakan, Kalimantan Utara'),
(11, 'Bengkulu', 'Bandara Fatmawati Soekarno Bengkulu'),
(12, 'Wamena', 'Bandar Udara Wamena'),
(13, 'Timika', 'Bandar Udara Internasional Mozes Kilangin Timika'),
(14, 'Pangandaran', 'Bandar Udara Nusawiru Cijulang, Pangandaran, Jabar'),
(15, 'Biak', 'Bandar Udara Internasional Frans Kaisiepo, Biak, Papua'),
(16, 'Survey', NULL),
(17, 'Other-Make Comment', NULL),
(18, 'Ketapang', 'Bandara Rahadi Oesman, Ketapang, Kalimantan Barat'),
(19, 'Sulawesi', 'Bandar Udara Internasional Sultan Hasanuddin, Makassar, Sulsel'),
(20, 'Merauke', 'Bandar Udara Internasional Mopah, Merauke,Papua Selatan'),
(22, 'Palangkaraya', 'Bandar Udara Tjilik Riwut, Palangkaraya, Kalimantan Tengah'),
(23, 'Banda Aceh', 'Bandar Udara Internasional Sultan Iskandar Muda, Banda Aceh'),
(24, 'Jambi', 'Bandara Sultan Thaha Saifuddin, Jambi'),
(25, 'Padang', 'Bandar Udara Internasional Minangkabau, Padang, Sumatera Barat'),
(26, 'Manokwari', 'Bandara Rendani Manokwari'),
(27, 'Ternate', 'Bandara Sultan Babullah Ternate'),
(28, 'Ambon', 'Bandar Udara Internasional Pattimura Ambon, Maluku'),
(29, 'Samarinda', 'Bandar Udara Internasional Aji Pangeran Tumenggung Pranoto, Samarinda, Kalimantan Timur'),
(30, 'Dabo', 'Bandar Udara Dabo Singkep, Kepulauan Singkep, Kabupaten Lingga, provinsi Kepulauan Riau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(3) UNSIGNED NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`categories_id`, `kategori`) VALUES
(1, 'Akomodasi'),
(2, 'Building Maintenance'),
(3, 'Inventory'),
(4, 'Office Service'),
(5, 'Percetakan'),
(6, 'Transportasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `department`
--

CREATE TABLE `department` (
  `department_id` int(5) NOT NULL,
  `nama_department` varchar(100) NOT NULL,
  `keterangandepartment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `department`
--

INSERT INTO `department` (`department_id`, `nama_department`, `keterangandepartment`) VALUES
(1, 'GA', 'General Affair'),
(2, 'Safety', 'Safety'),
(3, 'FF', 'Flight Following'),
(4, 'IT', 'Information Technology'),
(5, 'OCC', 'Operation and Call Center'),
(6, 'Media', 'Media Room'),
(7, 'ACC', 'Accounting'),
(8, 'SIM', 'Simulator'),
(9, 'Training', 'Training');

-- --------------------------------------------------------

--
-- Struktur dari tabel `generalaffairs`
--

CREATE TABLE `generalaffairs` (
  `generalaffairs_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `usagegeneralaffair` varchar(255) DEFAULT NULL,
  `deskripsi_items` varchar(255) DEFAULT NULL,
  `jumlah_items` int(11) DEFAULT NULL,
  `units_id` int(11) DEFAULT NULL,
  `hargaitems` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `price_estimate` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `inputdate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `generalaffairspayment`
--

CREATE TABLE `generalaffairspayment` (
  `GApayment_id` int(3) NOT NULL,
  `request_id` int(3) DEFAULT NULL,
  `department_id` int(3) DEFAULT NULL,
  `source_id` int(3) DEFAULT NULL,
  `tanggal_pembelian` date NOT NULL,
  `user_id` int(3) DEFAULT NULL,
  `usagegeneralaffair` varchar(255) DEFAULT NULL,
  `deskripsi_items` varchar(255) DEFAULT NULL,
  `jumlah_items` int(5) DEFAULT NULL,
  `units_id` int(3) DEFAULT NULL,
  `hargaitems` int(20) DEFAULT NULL,
  `total_harga` int(20) DEFAULT NULL,
  `price_estimate` int(10) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `inputdate` timestamp NULL DEFAULT NULL,
  `status` enum('Checked','Processed','Pending','Cancelled','Finished') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `generalaffairspayment`
--

INSERT INTO `generalaffairspayment` (`GApayment_id`, `request_id`, `department_id`, `source_id`, `tanggal_pembelian`, `user_id`, `usagegeneralaffair`, `deskripsi_items`, `jumlah_items`, `units_id`, `hargaitems`, `total_harga`, `price_estimate`, `keterangan`, `inputdate`, `status`) VALUES
(17, 6, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 1, 3, 500, 500, 0, '', '2023-01-23 03:56:39', NULL),
(18, 7, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 1, 4, 500000, 0, 0, '', '2023-01-23 04:53:11', NULL),
(19, 8, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 1, 4, 300000, 300000, 0, '', '2023-01-23 04:58:45', NULL),
(20, 9, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 3, 4, 500000, 1500000, 0, '', '2023-01-23 06:35:06', NULL),
(22, 11, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 10, 4, 50000, 500000, 0, '', '2023-01-23 06:41:35', NULL),
(24, 13, 0, NULL, '0000-00-00', 0, 'pangandaran', 'Tinta Printer', 4, 6, 25000, 100000, 0, '', '2023-01-22 17:00:00', NULL),
(25, 13, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HVS', 1, 4, 500000, 500000, 0, '', '2023-01-22 17:00:00', NULL),
(26, 13, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HDD', 10, 4, 500000, 5000000, 0, '', '2023-01-22 17:00:00', NULL),
(27, 13, 0, NULL, '0000-00-00', 0, 'pangandaran', 'Keyboard', 3, 5, 500000, 1500000, 0, '', '2023-01-22 17:00:00', NULL),
(31, 14, 0, NULL, '0000-00-00', 0, 'pangandaran', 'HDD', 1, 11, 500000, 500000, 0, '', '2023-01-22 17:00:00', NULL),
(32, 15, 0, NULL, '0000-00-00', 4, 'pangandaran', 'Tinta Printer', 1, 4, 500000, 0, 0, '', '2023-01-22 17:00:00', NULL),
(33, 16, 0, NULL, '0000-00-00', 3, 'pangandaran', 'HVS', 1, 4, 500000, 500000, 0, '', '2023-01-22 17:00:00', NULL),
(34, 17, 0, NULL, '0000-00-00', 5, 'pangandaran', 'HVS', 1, 4, 25000, 25000, 0, '', '2023-01-22 17:00:00', NULL),
(35, 17, 0, NULL, '0000-00-00', 5, 'pangandaran', 'Tinta Printer', 2, 3, 500000, 1000000, 0, '', '2023-01-22 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `procurements`
--

CREATE TABLE `procurements` (
  `proc_id` int(3) NOT NULL,
  `id_users` int(3) NOT NULL,
  `sources_id` int(3) NOT NULL,
  `departments_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `requestbase`
--

CREATE TABLE `requestbase` (
  `regbase_id` int(3) NOT NULL,
  `namarequestbase` varchar(150) NOT NULL,
  `jabatan` varchar(150) DEFAULT NULL,
  `kode_base` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `requests`
--

CREATE TABLE `requests` (
  `request_id` int(5) NOT NULL,
  `nama_request` varchar(200) NOT NULL,
  `department_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `requests`
--

INSERT INTO `requests` (`request_id`, `nama_request`, `department_id`) VALUES
(1, 'Agni Setyo', 4),
(2, 'Amirul Putra Justicia', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `unit_id` int(3) NOT NULL,
  `namasatuan` varchar(20) NOT NULL,
  `keterangansatuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`unit_id`, `namasatuan`, `keterangansatuan`) VALUES
(1, 'unit', 'Unit'),
(2, 'pcs', 'PCS'),
(3, 'lb', 'Lembar'),
(4, 'box', 'Box'),
(5, 'buah', 'Buah'),
(6, 'set', 'Set'),
(7, 'paket', 'Paket'),
(8, 'roll', 'Roll'),
(9, 'pack', 'Packs'),
(10, 'rim', 'Rim'),
(11, 'lusin', 'Lusin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sourcesproc`
--

CREATE TABLE `sourcesproc` (
  `sources_id` int(3) NOT NULL,
  `source` enum('Online','Offline') DEFAULT NULL,
  `namatoko` varchar(100) DEFAULT NULL,
  `nomortelptoko` varchar(15) DEFAULT NULL,
  `rekeningtoko` varchar(20) DEFAULT NULL,
  `namabarang` varchar(255) DEFAULT NULL,
  `linkpembelian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sourcesproc`
--

INSERT INTO `sourcesproc` (`sources_id`, `source`, `namatoko`, `nomortelptoko`, `rekeningtoko`, `namabarang`, `linkpembelian`) VALUES
(1, 'Offline', 'Toko berkah', '2147483647', '112234', 'barang xxxx', NULL),
(4, 'Online', NULL, NULL, NULL, 'SSD V-Gen 256GB - Sata 3 VGen 256 GB', 'https://www.tokopedia.com/jayapc/ssd-v-gen-256gb-sata-3-vgen-256-gb?extParam=ivf%3Dfalse%26src%3Dsearch');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `users_id` int(3) NOT NULL,
  `departments_id` int(3) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo_profile` mediumtext DEFAULT NULL,
  `users_role` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`users_id`, `departments_id`, `fullname`, `username`, `password`, `photo_profile`, `users_role`, `ip`) VALUES
(1, 4, 'Amirul Putra Justicia', 'amirulputra20221036', 'susiair312', 'user_1/', 'admin', NULL),
(2, 4, 'admin', 'admin', 'admin123', 'user_2/avatar5.png', 'admin', NULL),
(3, 1, 'Nadya Umaro', 'nadnad', 'susiair312', 'user_3/', 'admin', NULL),
(4, 8, 'Arif', 'arif', 'susiair312', 'user_4/', 'admin', NULL),
(5, 8, 'Radityo', 'radit', 'susiair312', 'user_5/', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approvalpaymentreceipt`
--
ALTER TABLE `approvalpaymentreceipt`
  ADD PRIMARY KEY (`approval_id`);

--
-- Indeks untuk tabel `archieved`
--
ALTER TABLE `archieved`
  ADD PRIMARY KEY (`id_archieved`);

--
-- Indeks untuk tabel `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`base_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indeks untuk tabel `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indeks untuk tabel `generalaffairs`
--
ALTER TABLE `generalaffairs`
  ADD PRIMARY KEY (`generalaffairs_id`);

--
-- Indeks untuk tabel `generalaffairspayment`
--
ALTER TABLE `generalaffairspayment`
  ADD PRIMARY KEY (`GApayment_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indeks untuk tabel `procurements`
--
ALTER TABLE `procurements`
  ADD PRIMARY KEY (`proc_id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `sources_id` (`sources_id`),
  ADD KEY `departments_id` (`departments_id`);

--
-- Indeks untuk tabel `requestbase`
--
ALTER TABLE `requestbase`
  ADD PRIMARY KEY (`regbase_id`);

--
-- Indeks untuk tabel `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `sourcesproc`
--
ALTER TABLE `sourcesproc`
  ADD PRIMARY KEY (`sources_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `departments_id` (`departments_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approvalpaymentreceipt`
--
ALTER TABLE `approvalpaymentreceipt`
  MODIFY `approval_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `archieved`
--
ALTER TABLE `archieved`
  MODIFY `id_archieved` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `base`
--
ALTER TABLE `base`
  MODIFY `base_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `generalaffairs`
--
ALTER TABLE `generalaffairs`
  MODIFY `generalaffairs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `generalaffairspayment`
--
ALTER TABLE `generalaffairspayment`
  MODIFY `GApayment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `procurements`
--
ALTER TABLE `procurements`
  MODIFY `proc_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `requestbase`
--
ALTER TABLE `requestbase`
  MODIFY `regbase_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `unit_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sourcesproc`
--
ALTER TABLE `sourcesproc`
  MODIFY `sources_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
