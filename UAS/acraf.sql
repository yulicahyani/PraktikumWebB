-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 03:12 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acraf`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id_destinasi` int(11) NOT NULL,
  `id_awal` int(11) DEFAULT NULL,
  `id_akhir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id_destinasi`, `id_awal`, `id_akhir`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_dp` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(200) DEFAULT NULL,
  `harga_subtotal` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `pesan_batal` varchar(200) DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `id_sp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_dp`, `jumlah`, `catatan`, `harga_subtotal`, `id_user`, `tgl_pesan`, `tgl_kirim`, `tgl_selesai`, `pesan_batal`, `id_pesanan`, `id_item`, `id_sp`) VALUES
(4, 1, 'mantap oi', 30000, 1, '2020-12-22', '2020-12-22', '0000-00-00', '', 4, 3, 4),
(5, 1, 'cepetan bro', 150000, 1, '2020-12-22', '0000-00-00', '0000-00-00', 'sdad', 4, 4, 5),
(10, 2, 'mantap oi', 60000, 1, '2020-12-22', '0000-00-00', '0000-00-00', '', 10, 3, 2),
(11, 1, 'cepetan bro', 150000, 1, '2020-12-19', '2020-12-19', '0000-00-00', '', 10, 4, 4),
(12, 1, '', 100000, 1, '0000-00-00', '0000-00-00', '0000-00-00', '', 12, 11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nama_item` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `status_item` varchar(50) DEFAULT NULL,
  `deskripsi_item` varchar(1000) DEFAULT NULL,
  `gambar_item` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_item`, `stock`, `status_item`, `deskripsi_item`, `gambar_item`, `kategori`, `harga`, `id_toko`) VALUES
(3, 'Bokor Cantik', 8, 'tersedia', 'Bokor bali hand made. Bisa untuk ke pura atau bisa untuk tempat hiasan di rumah atau di kamar. Terbuat dari bahan yang ramah lingkungan. Awet dan kuat. Tahan air dan tersedia dengan banyak model dan warna.', '1-bokor.jpg', 'Handcraft', 30000, 1),
(4, 'Keben Elite Bulat ', 14, 'tersedia', 'Keben Elite Bulat isi permata Pejati, Diameter 28cm,Berat 2kg/pcs, Harga sudah termasuk packing dan buble wrap agar aman dikirim. Sebelum dikirim, produk sudah lolos pengecekan. Jadi tidak ada barang reject kami kirim. Sementara pengiriman pakai pos kilat, kalau mau lebih murah pakai pos jalur darat. Chat mimin info lengkapnya.', '1-keben.jpg', 'Handcraft', 150000, 1),
(5, 'Kursi Astetik', 5, 'tersedia', 'Kursi teras cantik busa dudukan - kursi tamu sofa minimalis jati', '1-kursi.jpg', 'Furniture', 300000, 1),
(6, 'Lampu Hias Batu', 3, 'tersedia', ' Lampu Hias Batu Taman Berkualitas Dengan Harga Murah', '1-lampu batu 2.jpg', 'Furniture', 250000, 1),
(7, 'Lampu Hias Taman', 6, 'tersedia', ' Lampu Hias Batu Taman Berkualitas Dengan Harga Murah', '1-lampu batu.jpg', 'Furniture', 270000, 1),
(8, 'Patung Tari Bali', 2, 'tersedia', 'Patung tari bali unik dan cantik.', '1-patung wanita.jpg', 'Statue', 500000, 1),
(9, 'Patung Wanita Bali', 3, 'tersedia', 'Patung wanita bali cantik dan indah. Dibuat dari batu yang berkualitas tinggi.', '1-patung wanita2.jpg', 'Statue', 150000, 1),
(10, 'Patung Souvenir Garuda', 15, 'tersedia', 'patung garuda kecil cocok untuk hiasan meja di ruangan', '1-patung.jpg', 'Souvenir', 75000, 1),
(11, 'Tas Rajut Hand Made', 25, 'tersedia', 'Tas rajutan buatan tangan berkualitas tinggi. Cocok untuk berpergian', '1-tas2.jpg', 'Handcraft', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jasa_pengiriman`
--

CREATE TABLE `jasa_pengiriman` (
  `id_jp` int(11) NOT NULL,
  `nama_jp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa_pengiriman`
--

INSERT INTO `jasa_pengiriman` (`id_jp`, `nama_jp`) VALUES
(1, 'JNE'),
(2, 'Pos Indonesia'),
(3, 'Si Cepat');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Gianyar'),
(2, 'Klungkung'),
(3, 'Denpasar'),
(4, 'Buleleng'),
(5, 'Badung'),
(6, 'Tabanan'),
(7, 'Karangasem'),
(8, 'Bangli'),
(9, 'Jembrana');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `harga_ongkir` int(11) DEFAULT NULL,
  `lama_pengiriman` int(11) DEFAULT NULL,
  `id_destinasi` int(11) DEFAULT NULL,
  `id_jp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `harga_ongkir`, `lama_pengiriman`, `id_destinasi`, `id_jp`) VALUES
(1, 15000, 2, 1, 1),
(6, 17000, 1, 1, 2),
(7, 23000, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `harga_total` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `harga_total`, `metode_pembayaran`, `id_ongkir`, `id_toko`) VALUES
(4, 195000, 'Transfer Bank', 1, 1),
(10, 225000, 'Transfer Bank', 1, 1),
(11, 225000, 'Transfer Bank', 1, 1),
(12, 1, '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `id_sp` int(11) NOT NULL,
  `nama_sp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pesanan`
--

INSERT INTO `status_pesanan` (`id_sp`, `nama_sp`) VALUES
(1, 'belum bayar'),
(2, 'dikemas'),
(3, 'dikirim'),
(4, 'selesai'),
(5, 'batal'),
(6, 'dikeranjang');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat_toko` varchar(200) DEFAULT NULL,
  `deskripsi_toko` varchar(1000) DEFAULT NULL,
  `status_toko` varchar(50) DEFAULT NULL,
  `gambar_toko` varchar(100) DEFAULT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `expert` varchar(100) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `id_user`, `nama_toko`, `alamat_toko`, `deskripsi_toko`, `status_toko`, `gambar_toko`, `rekening`, `expert`, `id_kota`) VALUES
(1, 2, 'Kerajinan Adit Suherman', 'Jl. Supratman no. 256, Abianbase, Gianyar, Bali', 'toko ini sangatlah bagus, aplagi kerajinannya. Pokoknya ah mantapp.', 'buka', 'toko1.jpg', '123456789', 'Statue', 1),
(5, 1, 'NI WAYAN NURHAENI', 'BR.TENGKULAK MAS', 'sdcvdvad', 'tutup', '-handcraf.jpg', '1231123', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_depan` varchar(50) DEFAULT NULL,
  `nama_belakang` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `handphone` varchar(15) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat_user` varchar(200) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `passwords` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(100) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_depan`, `nama_belakang`, `username`, `email`, `handphone`, `tgl_lahir`, `alamat_user`, `provinsi`, `passwords`, `kode_pos`, `id_kota`) VALUES
(1, 'Aditya', 'Pratama', 'adityap17', 'aditya@gmail.com', '082144507080', '2000-01-01', 'Jl. Supratman no. 256, Abianbase, Gianyar, Bali', 'Bali', '123', '18085', 1),
(2, 'Ari ', 'Surya', 'arisurya', 'arisurya@gmail.com', '087796991398', '2020-12-02', 'Jl. Ir sutami', 'Bali', '123', '1234', 2),
(3, 'Yuli', 'Cahyani', 'yuli', 'yulicahyani1101@gmail.com', '0897897678', '2000-01-11', 'Br. Batu, Desa Pererenan', 'Bali', '123', '3414', 5),
(4, 'Rai', 'Santhi', 'santhi', 'santhi@gmail.com', '085675678765', '2000-08-11', 'Br. Klungkung', 'Bali', '123', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id_destinasi`),
  ADD KEY `id_awal` (`id_awal`),
  ADD KEY `id_akhir` (`id_akhir`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_dp`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `jasa_pengiriman`
--
ALTER TABLE `jasa_pengiriman`
  ADD PRIMARY KEY (`id_jp`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`),
  ADD KEY `id_destinasi` (`id_destinasi`),
  ADD KEY `id_jp` (`id_jp`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_ongkir` (`id_ongkir`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kota` (`id_kota`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kota` (`id_kota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_dp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jasa_pengiriman`
--
ALTER TABLE `jasa_pengiriman`
  MODIFY `id_jp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD CONSTRAINT `destinasi_ibfk_1` FOREIGN KEY (`id_awal`) REFERENCES `kota` (`id_kota`),
  ADD CONSTRAINT `destinasi_ibfk_2` FOREIGN KEY (`id_akhir`) REFERENCES `kota` (`id_kota`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `detail_pesanan_ibfk_4` FOREIGN KEY (`id_sp`) REFERENCES `status_pesanan` (`id_sp`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD CONSTRAINT `ongkir_ibfk_1` FOREIGN KEY (`id_destinasi`) REFERENCES `destinasi` (`id_destinasi`),
  ADD CONSTRAINT `ongkir_ibfk_2` FOREIGN KEY (`id_jp`) REFERENCES `jasa_pengiriman` (`id_jp`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `toko_ibfk_2` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
