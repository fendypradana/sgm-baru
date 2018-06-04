-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Feb 2018 pada 21.26
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sgm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`) VALUES
('admin', 'admin', 'Administrator', 'sgm@mail.com', '082308230823', 'admin', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(6) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'Sport'),
(5, 'Bebek'),
(6, 'Matic');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kustomer`
--

CREATE TABLE `kustomer` (
  `id_kustomer` int(5) NOT NULL,
  `password` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `telpon` varchar(12) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kustomer`
--

INSERT INTO `kustomer` (`id_kustomer`, `password`, `nama_lengkap`, `alamat`, `email`, `telpon`) VALUES
(24, 'fendy', 'FENDY PRADANA', 'Lamongan', 'fendy@gmail.com', '08123456789'),
(25, '123', 'Nasrum Sahab', 'Dusun Balonggatel, Desa Karangwedoro, Kecamatan Turi', 'nassroom@gmail.com', '081554154514');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(5) NOT NULL,
  `status_order` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT 'Diproses',
  `petugas` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `tgl_kirim` date NOT NULL,
  `jam_kirim` time NOT NULL,
  `id_kustomer` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `tgl` varchar(20) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `petugas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(10) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `telpon`) VALUES
(1, 'Saiful', '081285766542'),
(2, 'Arifin', '081365897567');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1',
  `diskon` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`, `diskon`) VALUES
(42, 4, 'Sonic REPSOL LP', 'Aggressive DOHC 6-Speed Engine\r\n\r\nGenerasi terbaru mesin balap kelas dunia Honda, DOHC 4 katup, 6 kecepatan serta berpendingin cairan, merupakan hasil pengembangan teknologi terbaru yang mewujudkan pengendalian sesuai keinginan pengendaranya.\r\n', 23035000, 3, '0.00', '2017-10-13', '60SONIC REPSOL.jpg', 1, 0),
(53, 5, 'SUPRA X FI SP', 'Tipe Mesin         	       :	4-Langkah, SOHC, Silinder Tunggal\r\nVolume Langkah	               :	124,89 cc\r\nSistem Pendingin	       :	Pendingin Udara\r\nSistem Suplai Bahan Bakar :	PGM-FI (Programmed Fuel Injection)\r\nDiameter x Langkah	       :	52,4 x 57,9 mm\r\nTipe Transmisi	               :	4 Speed, Rotary\r\nRasio Kompresi	               :	9,3:1\r\nDaya Maksimum	               :	7,40 kW (10,1 PS) / 8.000 rpm\r\nTorsi Maksimum	               :	9,30 Nm (0,95 kgf.m) / 4.000 rpm\r\nPola Pengoperan Gigi	       :	N-1-2-3-4-N\r\nTipe Starter	               :	Starter Kaki dan Elektrik\r\nTipe Kopling	               :	Multiplate Wet Clutch with Coil Spring\r\nKapasitas Minyak Pelumas  :	0,7 Liter pada penggantian periodik', 17720000, 5, '0.00', '2017-11-24', '9supra x fi sp.jpg', 1, 0),
(54, 5, 'REVO SP FI', 'Honda Revo FI sanggup menahan beban pengendaranya meski sedang dipakai berboncengan. Sementara untuk meningkatkan kenyaman berkendara, sudha disediakan suspensi depan bertipe teleskopik, dan memakai suspensi belakang bertipe lengan ayun dengan dua buah shockbreaker untuk menaha setiap goncangan agar tetap nyaman, meski dipakai pada jalan berlubang. Kemudian untuk sistem pengereman, sudah disediakan rem cakram hidrolik dengan piston tungul pada sisi depan Honda Revo FI. Sementara pada sisi belakang memakai rem berjenis tromol.', 15210000, 5, '0.00', '2017-11-24', '23REVO SP FI.jpg', 1, 0),
(55, 4, 'NEW CB150R SPECIAL EDITION LP', '– Sasis tralis warna merah\r\n– Velg juga warna merah\r\n– Blok mesin kiri – kanan warna emas aka gold\r\n– Ada tambahan visor kecil di jidat\r\n– Undercowl, aksesoris di bawah mesin, pelindung dari cipratan lumpur', 26455000, 4, '0.00', '2017-11-24', '183cb.jpg', 1, 0),
(44, 5, 'SUPRA X 125 FI CW', 'Honda Supra X 125 CW adalah singkatan dari Casted Wheel, yang artinya adalah bahwa Supra X 125 ini menggunakan velg palang (bukan yang ruji). \r\n\r\nHonda Supra X 125 PGM-FI adalah varian Supra X 125 yang menggunakan Progammed Fuel Injection, yang artinya adalah pasokkan bahan bakar dari tangki bahan bakar ke ruang bakar kendaraan sudah tidak diakomodir oleh karburator lagi, tapi sudah terkomputerisasi dengan pusat pengaturan ECU (Electric Control Unit). Pada tipe ini, bahan bakar disuplai ke mesin tidak hanya berdasar pada level bukaan gas, tapi juga berbagai sensor, seperti sensor suhu, sensor laju udara yang terhisap, dll. Input pada sensor tadi akan dikirim ke ECU untuk kemudian diolah supaya nantinya ECU dapat memerintahkan pompa bahan bakar memompakan bahan bakar sesuai dengan kebutuhan mesin lalu disemprotkan melalui injektor untuk nantinya bahan bakar bisa bercampur dengan udara dan digunakan untuk proses pembakaran di ruang bakar mesin. ', 18790000, 6, '0.00', '2017-10-13', '60supra.jpg', 1, 0),
(45, 4, 'Mega Pro', 'PERFORMA MOTOR SEMAKIN MANTAP DENGAN INJEKTOR KELAS DUNIA TEKNOLOGI HONDA PGM-FI\r\n\r\nMesin baru 150cc, PGM-FI yang dilengkapi dengan sensor dan injektor canggih mampu menyemburkan tenaga yang besar serta daya tahan yang optimal namun tetap efisien dan ramah lingkungan. Performa tangguh untuk melengkapi perjalanan bagi pengendara.\r\n', 21000000, 1, '0.00', '2017-10-13', '80megapro.jpg', 2, 0),
(46, 6, 'ALL NEW SCOOPYSTYLISH LP', 'NEW INNOVATION FOR\r\nUNIQUE GENERATION\r\n\r\nMesin 110cc berpendingin udara, eSP, yang terbukti bertenaga,\r\nirit,dan ramah lingkungan\r\n', 18605000, 4, '0.00', '2017-10-13', '52Honda-Scoopy-Stylish.jpg', 1, 0),
(47, 6, 'Vario 150 exclusive', 'Rasakan performa mesin matik eSP 150cc yang didukung dengan teknologi PGM-FI Honda. Dirancang untuk hasilkan pembakaran sempurna yang mampu memberikan tenaga besar dan akselerasi responsif dengan efisiensi bahan bakar sehingga lebih ramah lingkungan.\r\n\r\nAdanya Emblem/Emboss Tiga Dimensi di bagian List Vario Exclusive, selain dengan Emboss 3D dan Design yang simpel namun Elegan, disana juga terdapat tambahan tulisan 150 Techno Idling Stop.', 21940000, 13, '0.00', '2017-10-13', '82vario.jpg', 0, 0),
(52, 5, 'REVO FIT FI', 'Desain New Honda Revo FI terlihat lebih gagah dibandingkan Honda Revo generasi sebelumnya. Terlihat dari penempatan lampu headlamp pada sisi depan yang dibuat runcing sehingga terkesan lebih gagah dan elegan. Sementara untuk ukuran dimensinya memiliki panjang 1.919 m x lebar 709 mm x tinggi 1080 mm, dan memiliki berat kosong sekitar 97.5 mm. Kemudian beralih kebawah jok, sudah ada tangki bakan bakar berkapasitas maksimum 4 liter, dan disediakan bagasi luas yang bisa menampung barang bawan mencapai 7 liter.', 14510000, 10, '0.00', '2017-11-14', '32REVO FIT FI.jpg', 1, 0),
(56, 4, 'CBR 150 (repsol) LP', 'volume langkah : 149.516cc\r\nsistem pendingin : liquid cooled with auto fan\r\nsistem suplai bahan bakar: PGM-FI', 34785000, 4, '0.00', '2017-11-24', '868cbr 150.jpg', 1, 0),
(57, 5, 'SUPRA X FI CW Luxury', 'Motor bebek ini mengusung rangka body dengan tipe yang sama seperti Revo FI, yakni berupa rangka Tulang Punggung. Ranka tersebut pastinya sangat kuat dan sudah di uji terlebih dahulu untuk menjaga kualitas dan peforma Honda Supra X 125 Injeksi. Kemudian untuk sektor suspensi, sudah ada suspensi depan bertipe Teleskopik, dan suspensi belakang memakai lengan ayun dengan penambahan supsensi shockbreaker ganda. Sementara untuk sistem pengeremannya, hadir membawa rem cakram ganda khusus untuk Honda Supra X 125 FI CW, sehingga meningkatkan keselamatan ketika berhenti mendadak saat melaju pada kecepatan tinggi.', 18790000, 3, '0.00', '2017-11-24', '15Honda-Supra-X-125-FI-CW-Luxury-White.jpg', 1, 0),
(58, 5, 'SUPRA X HI FI', '1. Mesin injeksi PGM-FI 125cc, terkenal ramah lingkungan dan sudah gak pakai choke lagi.\r\n2. Tangki bensin 5.6liter.\r\n3. Tempat duduk yang besar sekali.\r\n4. Ada fosfor hijau di lubang kunci jadi kalau dalam gelap gak bakal salah tusuk lobang', 19140000, 2, '0.00', '2017-11-24', '62supra X HI FI.jpg', 1, 0),
(59, 5, 'SUPRA GTR SPORTY', 'Honda Supra GTR 150 2017 ini dibekali mesin 150cc DOHC bertenaga maksimal 11,6 kW (15,9 PS) / 9.000 rpm, top speed-nya mencapai 122 kpj dan akselerasi responsif 10,7 detik untuk jarak 0 – 200m. Klaimnya Honda, konsumsi BBM mencapai 42.2 km / liter dengan metode pengetesan EURO 3 via ECE R40 (EURO 2 : 47,41 km/l).', 22470000, 2, '0.00', '2017-11-24', '40HondaSupraGTR150 SPORTY.jpg', 1, 0),
(60, 5, 'SUPRA GTR EXCLUSIVE', 'Honda Supra GTR 150 2017 ini dibekali mesin 150cc DOHC bertenaga maksimal 11,6 kW (15,9 PS) / 9.000 rpm, top speed-nya mencapai 122 kpj dan akselerasi responsif 10,7 detik untuk jarak 0 – 200m. Klaimnya Honda, konsumsi BBM mencapai 42.2 km / liter dengan metode pengetesan EURO 3 via ECE R40 (EURO 2 : 47,41 km/l).', 22670000, 1, '0.00', '2017-11-24', '84new-honda-supra-gtr150 EXCLUSIVE.jpg', 1, 0),
(61, 5, 'REVO CW FI', 'Honda Revo FI hanya membutuhkan konsumsi BBM 62,2 km/liter yang membutnya menjadi salah satu motor bebek paling irit di Indonesia. Dengan sistem pembakaran lebih sempurna, tentu peforma mesin akan meningkat tajam dibandingkan Honda Revo karburator. Sementara untuk transmisinya memiliki transmisi 4 kecepatan (N – 1 – 2 – 3 – 4 – N) dengan tipe kopling Multiple wet clutch yang didalamnya dilengkapi teknologi Diaphragm Spring.', 16110000, 1, '0.00', '2017-11-24', '20REVO CW FI.jpg', 1, 0),
(62, 4, 'SONIC LP', 'Sonic 150R sudah didukung oleh Jenis Mesin 4 Langkah DOHC, 4 Valve dengan Silinder Tunggal dan mempunyai Diameter x Langkah sebesar 57.3 mm x 57.8 mm dengan Kapasitas Mesin sebesar 149.16 cc sehingga dengan khualitas Mesin dan Kapasitas Mesin Honda Sonic 150R tersebut maka mampu memuntahkan Tenaga Mesin Secara Maksimal sebesar 11.8 kW per putaran 9.000 rpm dengan Torsi Secara Maksimal sebesar 13.5 Nm per putaran 6.500 rpm.', 22435000, 2, '0.00', '2017-11-24', '3418sonic.jpg', 1, 0),
(63, 4, 'VERZA 150 SP LP', 'PERFORMA MOTOR SEMAKIN MANTAP\r\nDENGAN INJEKTOR KELAS DUNIA\r\nTEKNOLOGI HONDA PGM-FI\r\n\r\nsuspensi belakang dengan warna baru\r\ndesain strimping terbaru\r\npelindung panas crom', 19575000, 3, '0.00', '2017-11-24', '12Honda-Verza-150-SP.jpg', 1, 0),
(64, 4, 'VERZA 150 CW LP', 'PERFORMA MOTOR SEMAKIN MANTAP\r\nDENGAN INJEKTOR KELAS DUNIA\r\nTEKNOLOGI HONDA PGM-FI\r\n\r\nMotor yang ramah lingkungan karena menghasilkan bahan bakar terhemat dibandingkan motor sport lain di kelasnya, yaitu 48 km/liter.', 20425000, 1, '0.00', '2017-11-24', '35Honda-Verza-150-CW.jpg', 1, 0),
(65, 4, 'SONIC SPESIAL', 'Sonic 150R sudah didukung oleh Jenis Mesin 4 Langkah DOHC, 4 Valve dengan Silinder Tunggal dan mempunyai Diameter x Langkah sebesar 57.3 mm x 57.8 mm dengan Kapasitas Mesin sebesar 149.16 cc sehingga dengan khualitas Mesin dan Kapasitas Mesin Honda Sonic 150R tersebut maka mampu memuntahkan Tenaga Mesin Secara Maksimal sebesar 11.8 kW per putaran 9.000 rpm dengan Torsi Secara Maksimal sebesar 13.5 Nm per putaran 6.500 rpm.', 22835000, 3, '0.00', '2017-11-24', '54SONIC SPESIAL.jpg', 1, 0),
(66, 5, 'BLADE R', '1. Kapasitas tangki BBM yang besar hingga 4 liter.\r\n2. Kapasitas bagasi hinga 7.3 liter.\r\n3. Lampu utama ganda yang dilengkapi multireflektor, memberikan jangkauan lampu lebih luas dan terang.\r\n4. Mesin injeksi 125 cc, SOHC, empat langkah, silinder tunggal.\r\n5. Front & Rear Disc Brake – rek cakram.\r\n6. Secure Key Shutter – Sistem penguncian bermagnet yang kuat dan nyaman, mengurangi resiko pencurian.', 17640000, 3, '0.00', '2017-11-24', '93Honda-Blade-125-FI-R.jpg', 1, 0),
(67, 5, 'BLADE REPSOL', '1. Kapasitas tangki BBM yang besar hingga 4 liter.\r\n2. Kapasitas bagasi hinga 7.3 liter.\r\n3. Lampu utama ganda yang dilengkapi multireflektor, memberikan jangkauan lampu lebih luas dan terang.\r\n4. Mesin injeksi 125 cc, SOHC, empat langkah, silinder tunggal.\r\n5. Front & Rear Disc Brake – rek cakram.\r\n6. Secure Key Shutter – Sistem penguncian bermagnet yang kuat dan nyaman, mengurangi resiko pencurian.', 18040000, 5, '0.00', '2017-11-24', '96blade repsol.jpg', 1, 0),
(68, 6, 'VARIO 110 ESP CBS', 'Fitur Pengereman Combi Brake System (CBS) sangat berguna sekali untuk memberikan keseimbangan pengereman pada Roda Belakang dan Roda Depan sehingga pengereman sangat nyaman sekali jika digunakan disegala kondisi\r\n\r\n1. Kapasitas mesin 110 CC\r\n2. Terdapat Answer Back System (untuk tipe Vario 110 eSP CBS ISS dan Vario 110 eSP Advance CBS ISS)\r\n3. Lampu depan sudah menggunakan LED\r\n4. Kapasitas bagasi 13 liter dan belum Helm-In\r\n5. Kapasitas tanki bahan bakar 3,7 liter', 17470000, 4, '0.00', '2017-11-24', '75vario 110 cbs.jpg', 1, 0),
(69, 6, 'VARIO 110 ESP CBS ISS', 'Fitur Pengereman Combi Brake System (CBS) sangat berguna sekali untuk memberikan keseimbangan pengereman pada Roda Belakang dan Roda Depan sehingga pengereman sangat nyaman sekali jika digunakan disegala kondisi dan telah didukung oleh Fitur – Fitur Teknologi Modern lainnya seperti Fitur Idling Stop System (ISS)\r\n\r\n\r\n1. Kapasitas mesin 110 CC\r\n2. Terdapat Answer Back System (untuk tipe Vario 110 eSP CBS ISS dan Vario 110 eSP Advance CBS ISS)\r\n3. Lampu depan sudah menggunakan LED\r\n4. Kapasitas bagasi 13 liter dan belum Helm-In\r\n5. Kapasitas tanki bahan bakar 3,7 liter', 18260000, 4, '0.00', '2017-11-24', '78vario 110 cbs iss.jpg', 1, 0),
(70, 6, 'New VARIO 125 FI CBS', '1. Panel analog dan digital, kombinasi panel analog & digital elektrik \r\n2. Helm in, tempat menaruh helm berkapasitas 18 liter \r\n3. Side Stand Switch, standar samping automatis \r\n4. Rak serba guna, berkapasitas 2 liter \r\n5. DC otomatis headlight on, \r\n6. Idling Stop Sistem, mesin dapat mati apabila motor berhenti lebih dari 3 detik & automatic menyala kembali disaat tuas \r\n    gas ditarik. \r\n7. Combi Brake Sistem, memungkinkan rem belakang & rem depan berfungsi dgn tepat. \r\n8. Lampu depan ganda', 19050000, 5, '0.00', '2017-11-26', '58NEW VARIO 125 FI.jpg', 1, 0),
(71, 6, 'VARIO 150 SPORTY', 'Model Sporty tampil dengan List Biasa seperti halnya versi Vario yang sebelumnya.\r\n\r\nSkuter matic Honda Vario 150 eSP ini didukung dengan mesin berkapasitas 149.3 cc. Pada Saat diajak untuk berakselerasi dari angka 0/100 km/jam dapat ditempuh hanya dengan waktu 20.8 detik saja. meskipun tenaga yang dihasilkan sangat besar dan responsif, namun konsumsi bahan bakar yang dibutuhkan sangatlah irit. Untuk setiap 1 liter bahan bakar bensin mampu menempuh hingga jarak 52.9 km', 21830000, 6, '0.00', '2017-11-26', '58VARIO 150 SPORTY.jpg', 1, 0),
(72, 6, 'BEAT SPORTY CW', 'Tinggi tempat duduk BeAT eSP yakni 740 mm, jarak terendah dengan tanah 144 mm.', 16180000, 7, '0.00', '2017-11-26', '7Honda-Beat-eSP-CW.jpg', 1, 0),
(73, 6, 'BEAT SPORTY CBS', '1. Tinggi tempat duduk BeAT eSP yakni 740 mm, jarak terendah dengan tanah 144 mm.\r\n2. Combi Break System (CBS), di mana dengan menarik tuas rem kiri maka rem depan dan belakang akan berfungsi \r\n    secara optimal. Fitur CBS ini khusus pada tipe Honda Beat CBS.', 16380000, 6, '0.00', '2017-11-26', '36Perbedaan-Honda-Beat-eSP-CBS.jpg', 1, 0),
(74, 6, 'BEAT SPORTY CBS-ISS', '1. Tinggi tempat duduk BeAT eSP yakni 740 mm, jarak terendah dengan tanah 144 mm.\r\n2. Combi Break System (CBS), di mana dengan menarik tuas rem kiri maka rem depan dan belakang akan berfungsi \r\n    secara optimal. Fitur CBS ini khusus pada tipe Honda Beat CBS.\r\n3. Idling Stop System (ISS), di mana mesin akan mati saat motor berhenti lebih dari 3 detik. Fitur ini terdapat pada tipe \r\n    Honda Beat CBS ISS.', 16850000, 5, '0.00', '2017-11-26', '3Honda-Beat-eSP-CBS-ISS.jpg', 1, 0),
(75, 6, 'BEAT STREET CBS', '1. Tinggi setang Honda Beat Street naik 1,3 cm, dan didesain lebih mendekati pengendara. Tinggi tempat duduk sama \r\n    dengan Beat Sporty eSP, yakni 740 mm, atau lebih tinggi 5 mm dibandingkan Beat PPOP di level 735 mm. Jarak \r\n    terendah dengan tanah, Beat Street dan Beat Sporty sama, yakni 144 mm, sementara Beat POP 140 mm.\r\n2. Combi Break System (CBS), di mana dengan menarik tuas rem kiri maka rem depan dan belakang akan berfungsi \r\n   secara optimal. Fitur CBS ini khusus pada tipe Honda Beat CBS.', 16850000, 3, '0.00', '2017-11-26', '84Honda-Beat-Street-eSP.jpg', 1, 0),
(76, 6, 'BEAT POP Esp CW', 'Honda Beat POP eSP desainnya lebih dinamis dengan stiker yang makin atraktif. Tipe ini memiliki tinggi tempat duduk 735 mm dan jarak terendah dengan tanah 140 mm.\r\n\r\nHonda Beat POP eSP juga memiliki tiga varian, yaitu Beat POP eSP CW, Beat POP eSP CBS dan Beat POP eSP CBS ISS. Perbedaan teknologi pada varian Beat POP ini juga sama seperti Beat Sporty, yakni teknologi CBS dan ISS.\r\n \r\nKecepatan Maksimum 95 km/jam\r\n\r\nVolume Silinder 108 cc', 15780000, 1, '0.00', '2017-11-26', '59BEAT POP CW.jpg', 1, 0),
(77, 6, 'BEAT POP Esp CBS', '1.  Kecepatan Maksimum 95 km/jam\r\n2. Volume Silinder 108 cc\r\n3. Combi Break System (CBS), di mana dengan menarik tuas rem kiri maka rem depan dan belakang akan berfungsi \r\n    secara optimal. Fitur CBS ini khusus pada tipe Honda Beat CBS.', 15970000, 5, '0.00', '2017-11-26', '31BEAT POP CBS.jpg', 1, 0),
(78, 6, 'BEAT POP Esp CBS-ISS', '1. Combi Break System (CBS), di mana dengan menarik tuas rem kiri maka rem depan dan belakang akan berfungsi \r\n    secara optimal. Fitur CBS ini khusus pada tipe Honda Beat CBS.\r\n2. Idling Stop System (ISS), di mana mesin akan mati saat motor berhenti lebih dari 3 detik. Fitur ini terdapat pada tipe \r\n    Honda Beat CBS ISS.\r\n3. Tinggi tempat duduk 735 mm dan jarak terendah dengan tanah 140 mm.', 16460000, 5, '0.00', '2017-11-26', '72BEAT POP CBS ISS.jpg', 1, 0),
(79, 6, 'SPACY HI FI', 'MESIN 110CC HONDA PGM-FI\r\n\r\nPERFORMA MOTOR SEMAKIN MANTAP DENGAN INJEKTOR KELAS DUNIA TEKNOLOGI HONDA PGM-FI\r\n\r\nSistem suplai bahan bakar dengan teknologi kontrol elektronis yang memasok bahan bakar dan udara secara optimal sehingga lebih hemat bahan bakar dan ramah lingkungan sesuai regulasi EURO 3.', 15460000, 3, '0.00', '2017-11-26', '14spacy.jpg', 1, 0),
(80, 6, 'PCX', 'HIGH END 150CC\r\nENGINE TECHNOLOGY\r\n\r\nPerpaduan inovasi dan teknologi terbaru built in cooled engine eSP yang didukung teknologi PGM-FI Honda untuk sensasi berkendara mengagumkan dan ramah lingkungan bagi pribadi matang dan elegan', 42570000, 2, '0.00', '2017-11-26', '84HONDA PCX.jpg', 1, 0),
(81, 6, 'SCOOPY SPORTY LP', 'NEW INNOVATION FOR\r\nUNIQUE GENERATION\r\n\r\nMesin 110cc berpendingin udara, eSP, yang terbukti bertenaga,\r\nirit,dan ramah lingkungan', 18605000, 2, '0.00', '2017-11-26', '6Honda-Scoopy-Sporty.jpg', 1, 0),
(82, 6, 'SCOOPY PLAYFULL LP', 'NEW INNOVATION FOR\r\nUNIQUE GENERATION\r\n\r\nMesin 110cc berpendingin udara, eSP, yang terbukti bertenaga,\r\nirit,dan ramah lingkungan', 18605000, 4, '0.00', '2017-11-26', '2597scoopy.jpg', 1, 0),
(83, 4, 'MEGA PRO FI LP', '150CC, PGM–FI ENGINE\r\nPOWERFUL, RESPONSIF, LOW FC & ECO FRIENDLY\r\nPERFORMA MOTOR SEMAKIN MANTAP DENGAN INJEKTOR KELAS DUNIA TEKNOLOGI HONDA PGM-FI\r\n\r\nMesin baru 150cc, PGM-FI yang dilengkapi dengan sensor dan injektor canggih mampu menyemburkan tenaga yang besar serta daya tahan yang optimal namun tetap efisien dan ramah lingkungan. Performa tangguh untuk melengkapi perjalanan bagi pengendara.', 22995000, 2, '0.00', '2017-11-26', '71MEGA PRO.jpg', 1, 0),
(84, 4, 'NEW CB150R LP', 'Aggressive DOHC 6-Speed Engine\r\n\r\nGenerasi terbaru mesin balap kelas dunia Honda, DOHC 4 katup, 6 kecepatan serta berpendingin cairan, merupakan hasil pengembangan teknologi terbaru yang mewujudkan pengendalian sesuai keinginan pengendaranya.\r\nLebih Bertenaga & Responsif\r\nLebih Efisien\r\nLebih Nyaman & Fun\r\n\r\n– Sasis tralis warna merah\r\n– Velg juga warna merah\r\n– Blok mesin kiri – kanan warna emas aka gold\r\n– Ada tambahan visor kecil di jidat\r\n– Undercowl, aksesoris di bawah mesin, pelindung dari cipratan lumpu\r\n\r\n', 26455000, 4, '0.00', '2017-11-26', '76CB150R.jpg', 1, 0),
(85, 4, 'CBR 250 RR STD', 'Tipe	4-Stroke, 8-Valve, Parallel Twin Cylinder, Liquid Cooled With Auto Electric Fan\r\nKapasitas	249.7 cc\r\nDiameter X Langkah	62.0 x 41.4 mm\r\nRasio Kompresi	11.5 : 1\r\nThrottle System	Throttle-By-Wire System with Accelerator Position Sensor\r\nSistem Bahan Bakar	PGM-FI\r\nStarter	Electric\r\nTransmsi	6 Speed (1-N-2-3-4-5-6)', 64495000, 2, '0.00', '2017-11-26', '80Honda-CBR250RR-STD.jpg', 1, 0),
(86, 4, 'CBR 250 RR ABS', 'CBR250RR mengandalkan 250cc liquid-cooled 4-stroke DOHC 8-valve, paralel twin cylinder yang mampu mengeluarkan tenaga maksimum mencapai 38.7 PS pada putaran 12.500 rpm.\r\n\r\nSedangkan torsi maksimal yang dimiliki CBR250RR menembus 23.3 Nm pada putaran 11.000 rpm. Tenaga yang dikeluarkan jauh lebih besar dibandingkan Kawasaki Ninja 250 FI dan berselisih sedikit dari Yamaha R25. Namun soal fitur, CBR250RR memiliki fitur lebih lengkap dan pastina lebih canggih. Hal ini tak lepas dari pemakaian suspensi depan Upside Down dan fitur Riding Mode yang tak dimiliki motor 250cc sekelasnya.', 70505000, 2, '0.00', '2017-11-26', '85Harga-CBR250RR-ABS.jpg', 2, 0),
(87, 4, 'CBR250RR KABUKI', 'Engine Type 4-Stroke, 8-Valve, Parallel Twin Cynlider\r\nDisplacement 249.7 cc\r\nCooling Sytem Liquid Cooled With Auto Electric Fan\r\nFuel Supply System PGM-FI\r\nThrottle System Throttle-By-Wire-System with Accelerator Position Sensor\r\nBore x Stroke 62.0 x 41.4 mm\r\nCompression Ratio 11.5 : 1\r\nMaximum Power 28.5 kW (38.7 PS) / 12.500 rpm\r\nMaximum Torque 23.3 Nm (2.4 kgf.m) / 11.000 rpm\r\nTransmission Manual, 6 Speed\r\nGear Shift Pattern 1-N-2-3-4-5-6\r\nStarting System Electric Starter\r\nClutch System Multiplate Wet Clutch with Coil Spring\r\nLubricant Type Wet (Pressing and Spray)\r\nOil Capacity 1.9L (Excharge)', 71205000, 1, '0.00', '2017-11-26', '71CBR250 KABUKI.jpg', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kustomer`
--
ALTER TABLE `kustomer`
  ADD PRIMARY KEY (`id_kustomer`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kustomer`
--
ALTER TABLE `kustomer`
  MODIFY `id_kustomer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
