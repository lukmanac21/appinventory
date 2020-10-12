-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 02:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appin`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer`
--

CREATE TABLE `mst_customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `updateddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_customer`
--

INSERT INTO `mst_customer` (`id`, `nama`, `alamat`, `telp`, `createdby`, `createddate`, `updateddate`, `updatedby`) VALUES
(1, 'Linda Novanti', 'Jl. BKR Pelajar No. 43 Surabaya', '(031) 7419521', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Eko Kurniawan Purnomo', 'Jl. Pasar Turi 1', '(031) 7411229', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'Buyung Hidayat Rachman', 'Jl. Tanggulangin No. 12 Surabaya', '(031) 7415162', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'Nono Indriyatno', 'Jl. Tambakrejo VI/2 Surabaya', '(031) 3895784', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 'Ridwan Mubarun', 'Jl. Mendut No. 7 Surabaya', '(031) 5354808', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'Suprayitno', 'Jl. Gubeng Airlangga I/2 Surabaya', '(031) 5660219', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'Agus Tjahyono', 'Jl. Gresik No. 49 Surabaya', '(031) 5326564', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'Siti Hindun Robba Humaidiyah', 'Jl. Sultan Iskandar Muda No. 16 Surabaya', '(031) 7523788', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'Dewanto Kusumo Legowo', 'Jl. Teluk Sampit No. 2A Surabaya', '(031) 8281662', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 'Tomi Ardiyanto', 'Jl. Cisedane No. 51 Surabaya', '(031) 8281723', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, 'Yunus', 'Jl. Raya Dukuh Kupang No. 83A Surabaya', '(031) 8437413', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 'R. Dodot Wahluyo', 'Jl. Kebraon V Gang Praja Surabaya', '(031) 8432069', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 'Eko Budi Susilo', 'Jl. Jemursari II/33 Surabaya', '(031) 8703616', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 'Denny Christupel Tupamahu', 'Jl. Rungkut Asri Utara No. 1 Surabaya', '(031) 3816902', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 'Yanu Mardianto', 'Jl. Nginden Semolo No. 89 Surabaya', '(031) 7521576', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 'Amalia Kurniawati', 'Jl. Kedung Cowek No. 350 Surabaya', '(031) 7402204', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, 'Henni Indriaty', 'Jl. Raya KedungSememi Surabaya', '(031) 51503131', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(18, 'Muslich Hariadi', 'Jl. Raya Lakarsantri No. 7476 Surabaya', '(031) 5924796', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(19, 'Harun Ismail', 'Jl. Mulyorejo Utara No. 201 Surabaya', '(031) 8417067', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(20, 'Sair', 'Jl. Prapen Indah I Surabaya', '(031) 7663130', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, 'Ahmad Daya Prasetyono', 'Jl. Gunung Anyar Timur No. 62 Surabaya', '(031) 7402201', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(22, 'Maria Agustin Yuristina', 'Jl. Jambangan Sawah No. 2 Surabaya', '(031) 5671960', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(23, 'Annita Hapsari Oktorina Sesoria', 'Jl. Masjid Agung Timur No. 2 Surabaya', '(031) 5677877', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(24, 'Soedibyo', 'Jl. Raya Menganti Wiyung Surabaya', '(031) 3295130', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(25, 'Budiono', 'Jl. Dukuh Kupang Barat XXIV/17 Surabaya', '(031) 3293575', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(26, 'Iin Trisnoningsih', 'Jl. Asem Raya No. 2A Surabaya', '(031) 3526571', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(27, 'Bambang Udi Ukoro', 'Jl. Simomulyo I / 31', '(031) 5329324', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(28, 'Budi Hermanto', 'Jl. Kyai Tambak Deres No. 252 Surabaya', '(031) 5015564', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(29, 'Tranggono Wahyu Wibowo', 'Jl. Raya Babat Jerawat No. 1A Surabaya', '(031) 5032003', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(30, 'Ferdhie Ardiansyah', 'Jl. Raya Sambikerep No. 2 Surabaya', '(031) 3716576', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(31, 'Adhitya Burhan Mustofa', 'Jl. Pattimura 51 Malang', '(031) 5676530', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(32, 'Dendy dwi haryono', 'Jl. Kasembon 8B Malang', '(031) 5345604', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(33, 'Handoko Agung Prabowo', 'Jl. Kaliurang Barat 121 Malang', '(031) 5345077', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(34, 'Budi Setiawan', 'Jl. MGR S Pranoto 32 Malang', '(034) 1325861', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(35, 'Praditya Eko Wibowo', 'Jl. Arismunandar, Malang', '(034) 1353060', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(36, 'Ridhya Rachman Dasuki', 'Jl. Nusa Kambangan, Malang', '(034) 1352134', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(37, 'Fahmi', 'Jl. Welirang 20C Malang', '(034) 1325764', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(38, 'Slamet Sujoko', 'Jl. Bareng Tennes IV/158 Malang', '(034) 1327767', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(39, 'yuliyanti', 'Jl. Galunggung 5 Malang', '(034) 1325985', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(40, 'Kusnanto', 'Jl. Terusan Cikampek 147 Malang', '(034) 1322412', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(41, 'Leo Nigohando Nainggolan', 'Jl. KH Hasyim Asyari 21 Malang', '(034) 1353122', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(42, 'Novitrian', 'Jl. LA Sucipto 15 Malang', '(034) 1326647', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(43, 'Moch. Ansor', 'Jl. Balearjosari 9 Malang', '(034) 1583520', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(44, 'Yendra Malik', 'Jl. Teluk Pelabuhan Ratu 378 Malang', '(034) 1362019', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(45, 'Irfan Firdaus', 'Jl. A Yani Utara 148 Malang', '(034) 1491601', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(46, 'Mardiansyah Putra', 'Jl. A Yani Utara 2A Malang', '(034) 1481119', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(47, 'Denny dharma setiawan', 'Jl. DKH Kenongo Baru, Malang', '(034) 1481146', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(48, 'Moh Arif Kusnadi', 'Jl. Tembaga 3 Malang', '(034) 1547575', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(49, 'Sri Widodo', 'Jl. Hamid Rusdi 91 Malang', '(034) 1482216', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(50, 'Apriansyah', 'Jl. Panglima Sudirman 18 Malang', '(034) 1473852', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(51, 'Fendri priyanto', 'Jl. Puntodewo 29 Malang', '(034) 1492727', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(52, 'Fuad Fannani', 'Jl. Jodipan Wetan 11 Malang', '(034) 1368905', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(53, 'Budi Mulyanna', 'Jl. Raya Tasikmadu, Malang', '(034) 1356944', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(54, 'Rudy halim', 'Jl. Raya Bawang 1 Malang', '(034) 1352053', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(55, 'Riza Rusmawan', 'Jl. Mertojoyo 1 Malang', '(034) 1353067', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(56, 'Robi sumarno', 'Jl. Raya Tlogomas 56 Malang', '(034) 1473391', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(57, 'Minanul Wasik', 'Jl. MT Haryono XIII Malang', '(034) 1484160', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(58, 'Harry Santoso', 'Jl. Bend. Siguragura 31 Malang', '(034) 1580525', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(59, 'Nurrochim', 'Jl. Kertosentono 103 Malang', '(034) 1650649', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(60, 'Akhmad fauzan', 'Jl. Simbar Menjangan 37 Malang', '(034) 1551818', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(61, 'Parawin Wijayanto', 'Jl. Ikan Piranha Atas 206 Malang', '(034) 1560390', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(62, 'Adiwijaya Cahyo Budi Santoso', 'Jl. Sudimoro 17 Malang', '(034) 1572514', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(63, 'Mohammad Avino Pradipta', 'Jl. Bantaran Barat II Malang', '(034) 1472111', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(64, 'Adma tomi caisar', 'Jl. S Supriyadi 15 Malang', '(034) 1497111', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_jenis`
--

CREATE TABLE `mst_jenis` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_barang` double NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jenis`
--

INSERT INTO `mst_jenis` (`id`, `code`, `nama`, `harga_barang`, `createddate`, `createdby`, `id_satuan`) VALUES
(1, 'JKN001', 'Linen', 0, '2020-08-17 08:00:00', 1, 1),
(2, 'JKN002', 'Baby canvas', 0, '2020-08-17 08:00:00', 1, 1),
(3, 'JKN003', 'Lycra', 0, '2020-08-17 08:00:00', 1, 1),
(4, 'JKN004', 'Fleece', 0, '2020-08-17 08:00:00', 1, 1),
(5, 'JKN005', 'Organza', 0, '2020-08-17 08:00:00', 1, 1),
(6, 'JKN006', 'Micro', 0, '2020-08-17 08:00:00', 1, 1),
(7, 'JKN007', 'Diadora', 0, '2020-08-17 08:00:00', 1, 1),
(8, 'JKN008', 'Parasit', 0, '2020-08-17 08:00:00', 1, 1),
(9, 'JKN009', 'Beby tery', 0, '2020-08-17 08:00:00', 1, 1),
(10, 'JKN010', 'Taslan', 0, '2020-08-17 08:00:00', 1, 1),
(11, 'JKN011', 'Oscar', 0, '2020-08-17 08:00:00', 1, 1),
(12, 'JKN012', 'Lotto', 0, '2020-08-17 08:00:00', 1, 1),
(13, 'JKN013', 'Adidas', 0, '2020-08-17 08:00:00', 1, 1),
(14, 'JKN014', 'WP', 0, '2020-08-17 08:00:00', 1, 1),
(15, 'JKN015', 'Rastop', 0, '2020-08-17 08:00:00', 1, 1),
(16, 'JKN016', 'Lapis', 0, '2020-08-17 08:00:00', 1, 1),
(17, 'JKN017', 'Katun combed', 0, '2020-08-17 08:00:00', 1, 1),
(18, 'JKN018', 'Katun carded', 0, '2020-08-17 08:00:00', 1, 1),
(19, 'JKN019', 'Semi katun', 0, '2020-08-17 08:00:00', 1, 1),
(20, 'JKN020', 'Katun 30s', 0, '2020-08-17 08:00:00', 1, 1),
(21, 'JKN021', 'Katun 24s', 0, '2020-08-17 08:00:00', 1, 1),
(22, 'JKN022', 'Katun 20s', 0, '2020-08-17 08:00:00', 1, 1),
(23, 'JKN023', 'Katun Bambu', 0, '2020-08-17 08:00:00', 1, 1),
(24, 'JKN024', 'TC', 0, '2020-08-17 08:00:00', 1, 1),
(25, 'JKN025', 'Lacos', 0, '2020-08-17 08:00:00', 1, 1),
(26, 'JKN026', 'Spandex', 0, '2020-08-17 08:00:00', 1, 1),
(27, 'JKN027', 'Hyget', 0, '2020-08-17 08:00:00', 1, 1),
(28, 'JKN028', 'American Drill', 0, '2020-08-17 08:00:00', 1, 1),
(29, 'JKN029', 'Unione drill', 0, '2020-08-17 08:00:00', 1, 1),
(30, 'JKN030', 'Castilo Drill', 0, '2020-08-17 08:00:00', 1, 1),
(31, 'JKN031', 'Nagata drill', 0, '2020-08-17 08:00:00', 1, 1),
(32, 'JKN032', 'Oswot', 0, '2020-08-17 08:00:00', 1, 1),
(33, 'JKN033', 'Taipan Tropical', 0, '2020-08-17 08:00:00', 1, 1),
(34, 'JKN034', 'Taipan Drill', 0, '2020-08-17 08:00:00', 1, 1),
(35, 'JKN035', 'Katun Toyobo', 0, '2020-08-17 08:00:00', 1, 1),
(36, 'JKN036', 'Japan Drill', 0, '2020-08-17 08:00:00', 1, 1),
(37, 'JKN037', 'Twill', 0, '2020-08-17 08:00:00', 1, 1),
(38, 'JKN038', 'Baby Kanvas', 0, '2020-08-17 08:00:00', 1, 1),
(39, 'JKN039', 'Raphael', 0, '2020-08-17 08:00:00', 1, 1),
(40, 'JKN040', 'Cotton', 0, '2020-08-17 08:00:00', 1, 1),
(41, 'JKN041', 'Teteron Cotton', 0, '2020-08-17 08:00:00', 1, 1),
(42, 'JKN042', 'Polyester', 0, '2020-08-17 08:00:00', 1, 1),
(43, 'JKN043', 'Dryfit', 0, '2020-08-17 08:00:00', 1, 1),
(44, 'JKN044', 'Hyget', 0, '2020-08-17 08:00:00', 1, 1),
(45, 'JKN045', 'Spandex', 0, '2020-08-17 08:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_kain`
--

CREATE TABLE `mst_kain` (
  `id` int(11) NOT NULL,
  `stok` varchar(100) NOT NULL,
  `article` varchar(50) NOT NULL,
  `kain_id` int(11) NOT NULL,
  `warna_id` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `harga` double NOT NULL,
  `satuan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kain`
--

INSERT INTO `mst_kain` (`id`, `stok`, `article`, `kain_id`, `warna_id`, `createddate`, `createdby`, `harga`, `satuan_id`) VALUES
(1, '15', 'P01', 1, 1, '2020-09-01 14:33:22', 1, 20000, 1),
(2, '12', 'P02', 4, 3, '2020-09-01 14:33:22', 1, 23000, 1),
(3, '9', 'P03', 7, 5, '2020-09-01 14:33:22', 1, 22000, 1),
(4, '6', 'P04', 10, 7, '2020-09-01 14:33:22', 1, 23500, 1),
(5, '18', 'P05', 13, 9, '2020-09-01 14:33:22', 1, 24500, 1),
(6, '16', 'P06', 16, 11, '2020-09-01 14:33:22', 1, 25450, 1),
(7, '19', 'P07', 19, 13, '2020-09-01 14:33:22', 1, 26400, 1),
(8, '10', 'P08', 22, 15, '2020-09-01 14:33:22', 1, 27350, 1),
(9, '22', 'P09', 25, 17, '2020-09-01 14:33:22', 1, 28300, 1),
(10, '13', 'P10', 28, 19, '2020-09-01 14:33:22', 1, 29250, 1),
(11, '10', 'P11', 31, 21, '2020-09-01 14:33:22', 1, 30200, 1),
(12, '9', 'P12', 34, 23, '2020-09-01 14:33:22', 1, 31150, 1),
(13, '10', 'P13', 37, 25, '2020-09-01 14:33:22', 1, 32100, 1),
(14, '12', 'P14', 40, 27, '2020-09-01 14:33:22', 1, 33050, 1),
(15, '15', 'P15', 43, 29, '2020-09-01 14:33:22', 1, 34000, 1),
(16, '12', 'P16', 2, 2, '2020-09-01 14:33:22', 1, 20000, 1),
(17, '19', 'P17', 3, 4, '2020-09-01 14:33:22', 1, 23000, 1),
(18, '11', 'P18', 5, 6, '2020-09-01 14:33:22', 1, 22000, 1),
(19, '8', 'P19', 6, 8, '2020-09-01 14:33:22', 1, 23500, 1),
(20, '9', 'P20', 8, 10, '2020-09-01 14:33:22', 1, 24500, 1),
(21, '12', 'P21', 9, 12, '2020-09-01 14:33:22', 1, 25450, 1),
(22, '19', 'P22', 11, 14, '2020-09-01 14:33:22', 1, 26400, 1),
(23, '11', 'P23', 12, 16, '2020-09-01 14:33:22', 1, 27350, 1),
(24, '7', 'P24', 14, 18, '2020-09-01 14:33:22', 1, 28300, 1),
(25, '9', 'P25', 15, 20, '2020-09-01 14:33:22', 1, 29250, 1),
(26, '12', 'P26', 17, 22, '2020-09-01 14:33:22', 1, 30200, 1),
(27, '19', 'P27', 18, 24, '2020-09-01 14:33:22', 1, 31150, 1),
(28, '11', 'P28', 20, 26, '2020-09-01 14:33:22', 1, 32100, 1),
(29, '8', 'P29', 21, 28, '2020-09-01 14:33:22', 1, 33050, 1),
(30, '19', 'P30', 23, 30, '2020-09-01 14:33:22', 1, 34000, 1),
(31, '12', 'P31', 18, 24, '2020-09-01 14:33:22', 1, 34950, 1),
(32, '22', 'P32', 18, 25, '2020-09-01 14:33:22', 1, 35900, 1),
(33, '11', 'P33', 19, 25, '2020-09-01 14:33:22', 1, 36850, 1),
(34, '18', 'P34', 19, 26, '2020-09-01 14:33:22', 1, 37800, 1),
(35, '9', 'P35', 29, 33, '2020-09-01 14:33:22', 1, 38750, 1),
(36, '12', 'P36', 39, 40, '2020-09-01 14:33:22', 1, 39700, 1),
(37, '19', 'P37', 22, 48, '2020-09-01 14:33:22', 1, 40650, 1),
(38, '11', 'P38', 33, 55, '2020-09-01 14:33:22', 1, 41600, 1),
(39, '28', 'P39', 12, 62, '2020-09-01 14:33:22', 1, 42550, 1),
(40, '9', 'P40', 44, 70, '2020-09-01 14:33:22', 1, 43500, 1),
(41, '3', 'P41', 11, 77, '2020-09-01 14:33:22', 1, 44450, 1),
(42, '9', 'P42', 19, 90, '2020-09-01 14:33:22', 1, 45400, 1),
(43, '11', 'P43', 19, 88, '2020-09-01 14:33:22', 1, 46350, 1),
(44, '7', 'P44', 19, 78, '2020-09-01 14:33:22', 1, 47300, 1),
(45, '9', 'P45', 19, 32, '2020-09-01 14:33:22', 1, 48250, 1),
(46, '12', 'P46', 20, 10, '2020-09-01 14:33:22', 1, 49200, 1),
(47, '9', 'P47', 20, 23, '2020-09-01 14:33:22', 1, 50150, 1),
(48, '1', 'P48', 20, 31, '2020-09-01 14:33:22', 1, 51100, 1),
(49, '4', 'P49', 20, 34, '2020-09-01 14:33:22', 1, 52050, 1),
(50, '2', 'P50', 20, 34, '2020-09-01 14:33:22', 1, 53000, 1),
(51, '2', 'P51', 20, 36, '2020-09-01 14:33:22', 1, 53950, 1),
(52, '20', 'P52', 20, 39, '2020-09-01 14:33:22', 1, 54900, 1),
(53, '8', 'P53', 20, 41, '2020-09-01 14:33:22', 1, 55850, 1),
(54, '23', 'P54', 20, 44, '2020-09-01 14:33:22', 1, 56800, 1),
(55, '7', 'P55', 20, 46, '2020-09-01 14:33:22', 1, 57750, 1),
(56, '22', 'P56', 20, 49, '2020-09-01 14:33:22', 1, 58700, 1),
(57, '9', 'P57', 20, 52, '2020-09-01 14:33:22', 1, 59650, 1),
(58, '10', 'P58', 20, 54, '2020-09-01 14:33:22', 1, 40600, 1),
(59, '18', 'P59', 21, 57, '2020-09-01 14:33:22', 1, 31550, 1),
(60, '3', 'P60', 21, 59, '2020-09-01 14:33:22', 1, 22500, 1),
(61, '3', 'P61', 21, 62, '2020-09-01 14:33:22', 1, 23450, 1),
(62, '10', 'P62', 21, 65, '2020-09-01 14:33:22', 1, 30000, 1),
(63, '14', 'P63', 21, 67, '2020-09-01 14:33:22', 1, 25400, 1),
(64, '14', 'P64', 21, 70, '2020-09-01 14:33:22', 1, 33500, 1),
(65, '5', 'P65', 21, 72, '2020-09-01 14:33:22', 1, 22000, 1),
(66, '2', 'P66', 21, 75, '2020-09-01 14:33:22', 1, 20000, 1),
(67, '19', 'P67', 21, 77, '2020-09-01 14:33:22', 1, 24000, 1),
(68, '12', 'P68', 21, 80, '2020-09-01 14:33:22', 1, 21000, 1),
(69, '22', 'P69', 21, 83, '2020-09-01 14:33:22', 1, 27000, 1),
(70, '4', 'P70', 21, 85, '2020-09-01 14:33:22', 1, 26100, 1),
(71, '12', 'P71', 21, 88, '2020-09-01 14:33:22', 1, 27200, 1),
(72, '14', 'P72', 22, 90, '2020-09-01 14:33:22', 1, 28300, 1),
(73, '17', 'P73', 22, 93, '2020-09-01 14:33:22', 1, 29400, 1),
(74, '13', 'P74', 22, 96, '2020-09-01 14:33:22', 1, 30500, 1),
(75, '10', 'P75', 22, 98, '2020-09-01 14:33:22', 1, 31600, 1),
(76, '9', 'P76', 22, 101, '2020-09-01 14:33:22', 1, 32700, 1),
(77, '6', 'P77', 22, 103, '2020-09-01 14:33:22', 1, 33800, 1),
(78, '3', 'P78', 22, 106, '2020-09-01 14:33:22', 1, 34900, 1),
(79, '2', 'P79', 22, 108, '2020-09-01 14:33:22', 1, 36000, 1),
(80, '5', 'P80', 22, 111, '2020-09-01 14:33:22', 1, 37100, 1),
(81, '17', 'P81', 22, 114, '2020-09-01 14:33:22', 1, 38200, 1),
(82, '20', 'P82', 22, 52, '2020-09-01 14:33:22', 1, 39300, 1),
(83, '15', 'P83', 22, 88, '2020-09-01 14:33:22', 1, 40400, 1),
(84, '12', 'P84', 22, 89, '2020-09-01 14:33:22', 1, 41500, 1),
(85, '8', 'P85', 23, 100, '2020-09-01 14:33:22', 1, 42600, 1),
(86, '7', 'P86', 23, 99, '2020-09-01 14:33:22', 1, 43700, 1),
(87, '5', 'P87', 23, 21, '2020-09-01 14:33:22', 1, 44800, 1),
(88, '8', 'P88', 23, 130, '2020-09-01 14:33:22', 1, 45900, 1),
(89, '19', 'P89', 23, 44, '2020-09-01 14:33:22', 1, 47000, 1),
(90, '20', 'P90', 23, 56, '2020-09-01 14:33:22', 1, 48100, 1),
(91, '12', 'P91', 23, 22, '2020-09-01 14:33:22', 1, 49200, 1),
(92, '1', 'P92', 23, 21, '2020-09-01 14:33:22', 1, 50300, 1),
(93, '3', 'P93', 23, 58, '2020-09-01 14:33:22', 1, 51400, 1),
(94, '54', 'P94', 17, 9, '2020-10-07 09:54:30', 1, 800000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_level`
--

CREATE TABLE `mst_level` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_level`
--

INSERT INTO `mst_level` (`id`, `nama`) VALUES
(1, 'Admin'),
(3, 'Staff Admin'),
(4, 'Staff Produksi'),
(5, 'Staff Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `mst_level_menu`
--

CREATE TABLE `mst_level_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(5) NOT NULL,
  `is_insert` int(11) NOT NULL,
  `is_update` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `is_delete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_level_menu`
--

INSERT INTO `mst_level_menu` (`id`, `menu`, `is_insert`, `is_update`, `id_level`, `is_delete`) VALUES
(148, 'DHB', 1, 1, 5, 1),
(149, 'LGN', 1, 1, 5, 1),
(150, 'PRF', 1, 1, 5, 1),
(151, 'DHB', 1, 1, 4, 1),
(152, 'LGN', 1, 1, 4, 1),
(153, 'PRF', 1, 1, 4, 1),
(164, 'DJK', 1, 1, 3, 1),
(165, 'OB', 1, 1, 3, 1),
(166, 'JP', 1, 1, 3, 1),
(167, 'LP', 1, 1, 3, 1),
(168, 'PS', 1, 1, 3, 1),
(169, 'ST', 1, 1, 3, 1),
(170, 'PR', 1, 1, 3, 1),
(171, 'LGN', 1, 1, 3, 1),
(172, 'PRF', 1, 1, 3, 1),
(173, 'DHB', 1, 1, 3, 1),
(174, 'DJK', 1, 1, 1, 1),
(175, 'OB', 1, 1, 1, 1),
(176, 'JP', 1, 1, 1, 1),
(177, 'LP', 1, 1, 1, 1),
(178, 'PS', 1, 1, 1, 1),
(179, 'ST', 1, 1, 1, 1),
(180, 'PR', 1, 1, 1, 1),
(181, 'PMT', 1, 1, 1, 1),
(182, 'IMP', 1, 1, 1, 1),
(183, 'PJL', 1, 1, 1, 1),
(184, 'PMK', 1, 1, 1, 1),
(185, 'PLR', 1, 1, 1, 1),
(186, 'PHT', 1, 1, 1, 1),
(187, 'PNG', 1, 1, 1, 1),
(188, 'LVL', 1, 1, 1, 1),
(189, 'LGN', 1, 1, 1, 1),
(190, 'PRF', 1, 1, 1, 1),
(191, 'DHB', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_pembayaran`
--

CREATE TABLE `mst_pembayaran` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `no_pembayaran` varchar(25) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_produk`
--

CREATE TABLE `mst_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `harga` double NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updateddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_produk`
--

INSERT INTO `mst_produk` (`id`, `nama`, `id_kain`, `ukuran`, `harga`, `createddate`, `createdby`, `updatedby`, `updateddate`) VALUES
(1, 'Jaket Fleece', 1, 'S', 125000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(2, 'Jaket Fleece', 1, 'M', 130000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(3, 'Jaket Linen', 1, 'L', 150000, '2020-09-28 04:21:53', 1, 1, '2020-10-07 09:59:25'),
(4, 'Jaket Linen', 1, 'XL', 170000, '2020-09-28 04:22:15', 1, 1, '2020-10-07 09:47:42'),
(5, 'Jaket Linen', 1, 'S', 120000, '2020-09-28 04:22:59', 1, 1, '2020-10-07 09:47:32'),
(6, 'Jakte Fleece', 3, 'M', 100000, '2020-10-07 04:09:00', 1, 0, '0000-00-00 00:00:00'),
(7, 'Kaos Diadora', 3, 'S', 70000, '2020-10-07 08:25:33', 1, 0, '0000-00-00 00:00:00'),
(8, 'Kaos Diadora', 3, 'M', 75000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(9, 'Kaos Diadora', 3, 'L', 80000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(10, 'Kaos Diadora', 3, 'XL', 85000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(11, 'Kaos Diadora', 3, 'XXL', 90000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(12, 'Jaket Diadora', 3, 'S', 150000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(13, 'Jaket Diadora', 3, 'M', 155000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(14, 'Jaket Diadora', 3, 'L', 160000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(15, 'Jaket Diadora', 3, 'XL', 165000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(16, 'Jaket Diadora', 3, 'XXL', 170000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(17, 'Kaos Katun Combed', 94, 'S', 90000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(18, 'Kaos Katun Combed', 94, 'M', 95000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(19, 'Kaos Katun Combed', 94, 'L', 100000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(20, 'Kaos Katun Combed', 94, 'XL', 105000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(21, 'Kaos Katun Combed', 94, 'XXL', 110000, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_satuan`
--

CREATE TABLE `mst_satuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_satuan`
--

INSERT INTO `mst_satuan` (`id`, `nama`, `createddate`, `createdby`) VALUES
(1, 'Roll', '0000-00-00 00:00:00', 0),
(2, 'Meter', '2020-08-19 03:34:19', 1),
(6, 'Kilogram', '2020-10-07 12:52:01', 1),
(7, 'PCS', '2020-10-07 12:52:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_supplier`
--

CREATE TABLE `mst_supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updateddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_supplier`
--

INSERT INTO `mst_supplier` (`id`, `nama`, `alamat`, `telp`, `createdby`, `createddate`, `updatedby`, `updateddate`) VALUES
(1, 'Gloria Textile', 'Jl. Bunguran No.45, Bongkaran, Pabean Cantian, Surabaya', '(031) 3557286', 1, '2020-09-06 00:00:00', 1, '2020-10-07 12:51:26'),
(2, 'UD. Subur Jaya (Lumintu) \r\n', 'Jl. Kapasan no.194-B, Sidodadi, Simokerto, Surabaya, Jawa Timur 60145\r\n', '0812-3158-2411', 1, '2020-09-06 00:00:00', 1, '2020-09-06 00:00:00'),
(3, 'UD Mitra Mulia - grosir kain textile\r\n', 'Jl. Bunguran no.63-H, Bongkaran, Pabean Cantian, S...\r\n', '(031) 3536326', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(4, 'UD. Gita Sarana\r\n', 'Jl. KH Mas Mansyur nomor 120, Ampel, Semampir, Sur...\r\n', '(031) 3551741', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(5, 'UD. Mitra Kurnia\r\n', 'Ruko Semut Square C-10, Jl. Semut Baru, Bongkaran,...\r\n', '0823-3430-8880', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(6, 'Javva Phoenix Textile\r\n', 'Jl. Coklat No.32, Bongkaran, Pabean Cantian, Surabaya, Jatim 60161\r\n', '(031) 3553250', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(7, 'Cottonsari Showroom', 'Jl. Kapasan No.62, Simokerto, Simokerto, Surabaya, Jatim 60141\r\n', '(031) 3721725', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(8, 'Nagata Drill Surabaya\r\n', 'Jl. Kopi no.21, Bongkaran, kec. Pabean Cantian, kota Surabaya, Jatim 60161\r\n', '(031) 3558333', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(9, 'New Rukun Jaya\r\n', 'Jl. Pucang Sawit No.17, Pucang Sewu, Gubeng, Surabaya, Jawa Timur 60283\r\n', '(031) 5022981', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(10, 'Bombay Textile JMP Surabaya\r\n', 'Jl. Taman Jayeng Rono, No. 2-4, Krembangan Seltn, Krembangan, Surabaya, Jatim 60175\r\n', '(031) 3556152', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(11, 'The Oscar International \r\n', 'Jl. Mayjen Sungkono No.180, Dukuh Pakis, Dukuhpakis, Surabaya, Jatim 60189\r\n', '(031) 5673671', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(12, 'Textile Jago PGS\r\n', 'Jl. Dupak Raya No.1, Gundih, Bubutan, Surabaya, Jatim 60172\r\n', '(031) 52403915', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(13, 'UD Kemenangan Surabaya\r\n', 'Jl. Gula no.14-M, Bongkaran, Pabean Cantian, Surabaya, Jatim 60161\r\n', '(031) 3550672', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(14, 'UD Mimi\r\n', 'Jl. Kapasan no. 169-D, Kapasan, Simokerto, Surabaya, Jatim, 60141\r\n', '(031) 3715753', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(15, 'Mekar Jaya\r\n', 'Jl. Kapasan no. 212, Kapasan, Simokerto, kota Surabaya, Jatim 60141\r\n', '(031) 9900732', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(16, 'Rajatex \r\n', 'Jl. Kapasan nomor 52, Kapasan, Simokerto, Surabaya, Jawa Timur 60141\r\n', '(031) 3712392', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(17, 'Bintang Warna\r\n', 'Jl. Kapasan 210-B, Sidodadi, Simokerto, Surabaya, kota Sby - Jatim 60141\r\n', '(031) 3726057', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `id` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `images` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id`, `nip`, `nama`, `jabatan`, `createddate`, `createdby`, `username`, `password`, `email`, `images`, `status`, `id_level`) VALUES
(1, 'N01-8934798234', 'Super Admin', 'super admin', '0000-00-00 00:00:00', 0, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'gunawansutrisno123@gmail.com', '', 1, 1),
(2, 'N34234', 'Customer Service', 'Guru Matematika', '0000-00-00 00:00:00', 1, 'gunawan', '8758ef7d6048afdf8d423ed01a59deb499a6ff1a', 'siswadiafandi@gmail.com', '', 1, 2),
(3, '', 'Gunawan Sutrisno', '', '0000-00-00 00:00:00', 0, 'gunawan', '8758ef7d6048afdf8d423ed01a59deb499a6ff1a', '', '', 1, 5),
(4, '', 'gunawan', '', '0000-00-00 00:00:00', 0, 'gunawans', '8758ef7d6048afdf8d423ed01a59deb499a6ff1a', '', '', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mst_warna`
--

CREATE TABLE `mst_warna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_warna`
--

INSERT INTO `mst_warna` (`id`, `nama`, `createdby`, `createddate`) VALUES
(1, 'Merah Indian', 1, '2020-08-17'),
(2, 'Koral terang', 1, '2020-08-17'),
(3, 'Salmon', 1, '2020-08-17'),
(4, 'Salmon gelap', 1, '2020-08-17'),
(5, 'Salmon terang', 1, '2020-08-17'),
(6, 'Krimson', 1, '2020-08-17'),
(7, 'Merah', 1, '2020-08-17'),
(8, 'Merah Bata', 1, '2020-08-17'),
(9, 'Merah tua', 1, '2020-08-17'),
(10, 'Merah muda', 1, '2020-08-17'),
(11, 'Merah muda terang', 1, '2020-08-17'),
(12, 'Merah muda panas', 1, '2020-08-17'),
(13, 'Merah muda dalam', 1, '2020-08-17'),
(14, 'MediumVioletRed', 1, '2020-08-17'),
(15, 'PaleVioletRed', 1, '2020-08-17'),
(16, 'Salmon terang', 1, '2020-08-17'),
(17, 'Koral', 1, '2020-08-17'),
(18, 'Tomat', 1, '2020-08-17'),
(19, 'Merah oranye', 1, '2020-08-17'),
(20, 'Jingga tua', 1, '2020-08-17'),
(21, 'Jingga', 1, '2020-08-17'),
(22, 'Emas', 1, '2020-08-17'),
(23, 'Kuning', 1, '2020-08-17'),
(24, 'Kuning terang', 1, '2020-08-17'),
(25, 'LemonChiffon', 1, '2020-08-17'),
(26, 'LightGoldenrodYellow', 1, '2020-08-17'),
(27, 'PapayaWhip', 1, '2020-08-17'),
(28, 'Moccasin', 1, '2020-08-17'),
(29, 'PeachPuff', 1, '2020-08-17'),
(30, 'PaleGoldenrod', 1, '2020-08-17'),
(31, 'Khaki', 1, '2020-08-17'),
(32, 'DarkKhaki', 1, '2020-08-17'),
(33, 'Lavender', 1, '2020-08-17'),
(34, 'Thistle', 1, '2020-08-17'),
(35, 'Plum', 1, '2020-08-17'),
(36, 'Violet', 1, '2020-08-17'),
(37, 'Orchid', 1, '2020-08-17'),
(38, 'Fuchsia', 1, '2020-08-17'),
(39, 'Magenta', 1, '2020-08-17'),
(40, 'MediumOrchid', 1, '2020-08-17'),
(41, 'MediumPurple', 1, '2020-08-17'),
(42, 'BlueViolet', 1, '2020-08-17'),
(43, 'DarkViolet', 1, '2020-08-17'),
(44, 'DarkOrchid', 1, '2020-08-17'),
(45, 'DarkMagenta', 1, '2020-08-17'),
(46, 'Ungu', 1, '2020-08-17'),
(47, 'Indigo', 1, '2020-08-17'),
(48, 'SlateBlue', 1, '2020-08-17'),
(49, 'DarkSlateBlue', 1, '2020-08-17'),
(50, 'GreenYellow', 1, '2020-08-17'),
(51, 'Chartreuse', 1, '2020-08-17'),
(52, 'LawnGreen', 1, '2020-08-17'),
(53, 'Lime', 1, '2020-08-17'),
(54, 'LimeGreen', 1, '2020-08-17'),
(55, 'PaleGreen', 1, '2020-08-17'),
(56, 'LightGreen', 1, '2020-08-17'),
(57, 'MediumSpringGreen', 1, '2020-08-17'),
(58, 'SpringGreen', 1, '2020-08-17'),
(59, 'MediumSeaGreen', 1, '2020-08-17'),
(60, 'SeaGreen', 1, '2020-08-17'),
(61, 'ForestGreen', 1, '2020-08-17'),
(62, 'Hijau', 1, '2020-08-17'),
(63, 'DarkGreen', 1, '2020-08-17'),
(64, 'YellowGreen', 1, '2020-08-17'),
(65, 'OliveDrab', 1, '2020-08-17'),
(66, 'Olive', 1, '2020-08-17'),
(67, 'DarkOliveGreen', 1, '2020-08-17'),
(68, 'MediumAquamarine', 1, '2020-08-17'),
(69, 'DarkSeaGreen', 1, '2020-08-17'),
(70, 'LightSeaGreen', 1, '2020-08-17'),
(71, 'DarkCyan', 1, '2020-08-17'),
(72, 'Teal', 1, '2020-08-17'),
(73, 'Aqua', 1, '2020-08-17'),
(74, 'Cyan', 1, '2020-08-17'),
(75, 'LightCyan', 1, '2020-08-17'),
(76, 'PaleTurquoise', 1, '2020-08-17'),
(77, 'Aquamarine', 1, '2020-08-17'),
(78, 'Turquoise', 1, '2020-08-17'),
(79, 'MediumTurquoise', 1, '2020-08-17'),
(80, 'DarkTurquoise', 1, '2020-08-17'),
(81, 'CadetBlue', 1, '2020-08-17'),
(82, 'SteelBlue', 1, '2020-08-17'),
(83, 'LightSteelBlue', 1, '2020-08-17'),
(84, 'PowderBlue', 1, '2020-08-17'),
(85, 'LightBlue', 1, '2020-08-17'),
(86, 'SkyBlue', 1, '2020-08-17'),
(87, 'LightSkyBlue', 1, '2020-08-17'),
(88, 'DeepSkyBlue', 1, '2020-08-17'),
(89, 'DodgerBlue', 1, '2020-08-17'),
(90, 'CornflowerBlue', 1, '2020-08-17'),
(91, 'MediumSlateBlue', 1, '2020-08-17'),
(92, 'RoyalBlue', 1, '2020-08-17'),
(93, 'Biru', 1, '2020-08-17'),
(94, 'MediumBlue', 1, '2020-08-17'),
(95, 'DarkBlue', 1, '2020-08-17'),
(96, 'Navy', 1, '2020-08-17'),
(97, 'MidnightBlue', 1, '2020-08-17'),
(98, 'Cornsilk', 1, '2020-08-17'),
(99, 'BlanchedAlmond', 1, '2020-08-17'),
(100, 'Bisque', 1, '2020-08-17'),
(101, 'NavajoWhite', 1, '2020-08-17'),
(102, 'Wheat', 1, '2020-08-17'),
(103, 'BurlyWood', 1, '2020-08-17'),
(104, 'Tan', 1, '2020-08-17'),
(105, 'RosyBrown', 1, '2020-08-17'),
(106, 'SandyBrown', 1, '2020-08-17'),
(107, 'Goldenrod', 1, '2020-08-17'),
(108, 'DarkGoldenrod', 1, '2020-08-17'),
(109, 'Peru', 1, '2020-08-17'),
(110, 'Chocolate', 1, '2020-08-17'),
(111, 'SaddleBrown', 1, '2020-08-17'),
(112, 'Sienna', 1, '2020-08-17'),
(113, 'Brown', 1, '2020-08-17'),
(114, 'Maroon', 1, '2020-08-17'),
(115, 'Putih', 1, '2020-08-17'),
(116, 'Snow', 1, '2020-08-17'),
(117, 'Honeydew', 1, '2020-08-17'),
(118, 'MintCream', 1, '2020-08-17'),
(119, 'Azure', 1, '2020-08-17'),
(120, 'AliceBlue', 1, '2020-08-17'),
(121, 'GhostWhite', 1, '2020-08-17'),
(122, 'WhiteSmoke', 1, '2020-08-17'),
(123, 'Seashell', 1, '2020-08-17'),
(124, 'Beige', 1, '2020-08-17'),
(125, 'OldLace', 1, '2020-08-17'),
(126, 'FloralWhite', 1, '2020-08-17'),
(127, 'Ivory', 1, '2020-08-17'),
(128, 'AntiqueWhite', 1, '2020-08-17'),
(129, 'Linen', 1, '2020-08-17'),
(130, 'LavenderBlush', 1, '2020-08-17'),
(131, 'MistyRose', 1, '2020-08-17'),
(132, 'Gainsboro', 1, '2020-08-17'),
(133, 'Abu-abu Muda', 1, '2020-08-17'),
(134, 'Silver', 1, '2020-08-17'),
(135, 'Abu-abu Tua', 1, '2020-08-17'),
(136, 'Abu-abu', 1, '2020-08-17'),
(137, 'DimGray', 1, '2020-08-17'),
(138, 'LightSlateGray', 1, '2020-08-17'),
(139, 'SlateGray', 1, '2020-08-17'),
(140, 'DarkSlateGray', 1, '2020-08-17'),
(141, 'Hitam', 1, '2020-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `tr_pemasukan`
--

CREATE TABLE `tr_pemasukan` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `createddate` datetime NOT NULL,
  `updateddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `updatedby` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pemasukan`
--

INSERT INTO `tr_pemasukan` (`id`, `supplier_id`, `status`, `tanggal`, `createddate`, `updateddate`, `createdby`, `updatedby`, `subtotal`) VALUES
(2, 1, 0, '2020-09-16', '2020-09-15 09:56:28', '2020-09-15 10:13:36', 1, 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pemasukan_detail`
--

CREATE TABLE `tr_pemasukan_detail` (
  `id` int(11) NOT NULL,
  `id_pemasukan` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` double NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pemasukan_detail`
--

INSERT INTO `tr_pemasukan_detail` (`id`, `id_pemasukan`, `id_kain`, `jumlah`, `total`, `harga`) VALUES
(4, 2, 1, 1, 50000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pemesanan`
--

CREATE TABLE `tr_pemesanan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `updateddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pemesanan`
--

INSERT INTO `tr_pemesanan` (`id`, `tanggal`, `supplier_id`, `status`, `createddate`, `createdby`, `updateddate`, `updatedby`, `subtotal`) VALUES
(1, '2020-09-23', 1, 0, '2020-09-23 08:21:50', 1, '2020-09-23 08:21:56', 1, 123333),
(2, '2020-09-23', 2, 0, '2020-09-23 08:36:38', 1, '2020-09-25 04:45:58', 1, 96666);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pemesanan_detail`
--

CREATE TABLE `tr_pemesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` double NOT NULL,
  `harga` double NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pemesanan_detail`
--

INSERT INTO `tr_pemesanan_detail` (`id`, `id_pemesanan`, `id_kain`, `jumlah`, `total`, `harga`, `tanggal`) VALUES
(3, 1, 1, 2, 100000, 50000, '2020-09-23'),
(9, 2, 2, 2, 46666, 23333, '2020-09-23'),
(10, 2, 1, 2, 50000, 50000, '2020-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `tr_pengeluaran`
--

CREATE TABLE `tr_pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `updateddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pengeluaran`
--

INSERT INTO `tr_pengeluaran` (`id`, `tanggal`, `status`, `createdby`, `createddate`, `updateddate`, `updatedby`) VALUES
(1, '2020-09-21', 1, 1, '2020-09-22 06:11:06', '2020-09-23 04:43:21', 1),
(2, '2020-09-25', 0, 1, '2020-09-23 04:43:33', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pengeluaran_detail`
--

CREATE TABLE `tr_pengeluaran_detail` (
  `id` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pengeluaran_detail`
--

INSERT INTO `tr_pengeluaran_detail` (`id`, `id_pengeluaran`, `id_kain`, `jumlah`) VALUES
(11, 1, 1, 3),
(12, 2, 1, 1),
(13, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_penjualan`
--

CREATE TABLE `tr_penjualan` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `subtotal` double NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `updateddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_penjualan_detail`
--

CREATE TABLE `tr_penjualan_detail` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `total` double NOT NULL,
  `ukuran` varchar(11) NOT NULL,
  `motif` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_permintaan`
--

CREATE TABLE `tr_permintaan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updateddate` datetime NOT NULL,
  `updatedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_permintaan`
--

INSERT INTO `tr_permintaan` (`id`, `tanggal`, `createddate`, `createdby`, `status`, `updateddate`, `updatedby`) VALUES
(1, '2020-09-08 00:00:00', '2020-09-09 03:27:12', 1, 1, '2020-10-06 04:13:19', 1),
(2, '2020-09-15 00:00:00', '2020-09-15 03:18:28', 1, 1, '2020-10-02 08:04:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_permintaan_detail`
--

CREATE TABLE `tr_permintaan_detail` (
  `id` int(11) NOT NULL,
  `permintaan_id` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `biaya_simpan` double NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_permintaan_detail`
--

INSERT INTO `tr_permintaan_detail` (`id`, `permintaan_id`, `id_kain`, `jumlah`, `biaya_simpan`, `harga`) VALUES
(15, 2, 2, 1, 200, 23.333),
(16, 1, 1, 1, 200, 50000),
(17, 1, 2, 2, 100, 46666);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_customer`
--
ALTER TABLE `mst_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_jenis`
--
ALTER TABLE `mst_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kain`
--
ALTER TABLE `mst_kain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_level`
--
ALTER TABLE `mst_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_level_menu`
--
ALTER TABLE `mst_level_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_pembayaran`
--
ALTER TABLE `mst_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_supplier`
--
ALTER TABLE `mst_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_warna`
--
ALTER TABLE `mst_warna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pemasukan`
--
ALTER TABLE `tr_pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pemasukan_detail`
--
ALTER TABLE `tr_pemasukan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pemesanan`
--
ALTER TABLE `tr_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pemesanan_detail`
--
ALTER TABLE `tr_pemesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pengeluaran`
--
ALTER TABLE `tr_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pengeluaran_detail`
--
ALTER TABLE `tr_pengeluaran_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_penjualan`
--
ALTER TABLE `tr_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_penjualan_detail`
--
ALTER TABLE `tr_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_permintaan`
--
ALTER TABLE `tr_permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_permintaan_detail`
--
ALTER TABLE `tr_permintaan_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `mst_jenis`
--
ALTER TABLE `mst_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `mst_kain`
--
ALTER TABLE `mst_kain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `mst_level`
--
ALTER TABLE `mst_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_level_menu`
--
ALTER TABLE `mst_level_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `mst_pembayaran`
--
ALTER TABLE `mst_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_produk`
--
ALTER TABLE `mst_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_supplier`
--
ALTER TABLE `mst_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_warna`
--
ALTER TABLE `mst_warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tr_pemasukan`
--
ALTER TABLE `tr_pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_pemasukan_detail`
--
ALTER TABLE `tr_pemasukan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_pemesanan`
--
ALTER TABLE `tr_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_pemesanan_detail`
--
ALTER TABLE `tr_pemesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tr_pengeluaran`
--
ALTER TABLE `tr_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_pengeluaran_detail`
--
ALTER TABLE `tr_pengeluaran_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tr_penjualan`
--
ALTER TABLE `tr_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tr_penjualan_detail`
--
ALTER TABLE `tr_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tr_permintaan`
--
ALTER TABLE `tr_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_permintaan_detail`
--
ALTER TABLE `tr_permintaan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
