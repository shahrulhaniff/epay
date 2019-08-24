--
-- Database: cashless
--
/* DROP DATABASE cashless; */ 
 
 CREATE DATABASE cashless;  
 USE cashless; /* * /
 USE id9453057_cashless;


/* * / 
DROP TABLE transaksi; 
DROP TABLE kod_transaksi; 
DROP TABLE kod_jenistransaksi; 
DROP TABLE akaun_pengguna; 
DROP TABLE maklumat_pengguna; 
DROP TABLE kod_jenispengguna; 
DROP TABLE tracking; /* */
-- --------------------------------------------------------

--
-- Table structure for table user_account
--
CREATE TABLE kod_jenispengguna(
  kod_pengguna VARCHAR(12) NOT NULL,
  jenis_pengguna VARCHAR(10) NOT NULL,
  jabatan VARCHAR(40) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (kod_pengguna)
);

CREATE TABLE maklumat_pengguna (
  ic_pengguna VARCHAR(12) NOT NULL,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(40) NOT NULL,
  no_telefon VARCHAR(20),
  matr VARCHAR(20) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ic_pengguna)
);

CREATE TABLE akaun_pengguna (
  ic_pengguna VARCHAR(12) NOT NULL,
  kod_pengguna VARCHAR(10) NOT NULL,
  pwd VARCHAR(70) NOT NULL,
  jenis_akaun VARCHAR(10) NULL,
  status_aktif VARCHAR(5),
  ipaddress VARCHAR(30),
  lastlogin TIMESTAMP NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ic_pengguna,kod_pengguna),
  FOREIGN KEY (kod_pengguna) REFERENCES kod_jenispengguna (kod_pengguna),
  FOREIGN KEY (ic_pengguna) REFERENCES maklumat_pengguna (ic_pengguna)
);



-- --------------------------------------------------------

--
-- Table structure for table kod ptj
--
CREATE TABLE kod_jabatan (
  idptj VARCHAR(15) NOT NULL,
  singkatan VARCHAR(20) NOT NULL,
  namaptj VARCHAR(100) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (idptj)
  );
-- --------------------------------------------------------

--
-- Table structure for table transaksi
--

CREATE TABLE kod_jenistransaksi (
  id_jenistransaksi VARCHAR(16) NOT NULL,
  jenistransaksi VARCHAR(100) NOT NULL,
  jabatan VARCHAR(40) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_jenistransaksi)
  );

CREATE TABLE kod_transaksi (
  id_kodtransaksi INT(10) NOT NULL AUTO_INCREMENT,
  kod_pengguna VARCHAR(10) NOT NULL,
  no_sb VARCHAR(100) NOT NULL,
  description VARCHAR(300) NOT NULL,
  tarikhbuka DATE NOT NULL,
  tarikhtutup DATE NOT NULL,
  jam TIME NOT NULL,
  harga FLOAT(10,2) NOT NULL,
  id_jenistransaksi VARCHAR(16) NOT NULL,
  kelas VARCHAR(100) NOT NULL,
  keyin_by VARCHAR(100) NOT NULL,
  tarikh_keyin DATETIME NOT NULL,
  edit_by VARCHAR(100) NULL,
  tarikh_edit DATETIME NULL,
  dttaklimat DATETIME NULL,
  tempatlwtntapak VARCHAR(100) NULL,
  sulit VARCHAR(1) DEFAULT 'T', 
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_kodtransaksi),
  FOREIGN KEY (kod_pengguna) REFERENCES kod_jenispengguna (kod_pengguna),
  FOREIGN KEY (id_jenistransaksi) REFERENCES kod_jenistransaksi (id_jenistransaksi)
);



CREATE TABLE transaksi (
  id_transaksi INT(10) NOT NULL AUTO_INCREMENT,
  ic_pengguna VARCHAR(12) NOT NULL,
  id_kodtransaksi INT(10) NOT NULL,
  id_jenistransaksi VARCHAR(16) NOT NULL,
  tarikh DATETIME NOT NULL,
  jumlah FLOAT(10,2) NOT NULL,
  daripada VARCHAR(12) NOT NULL,
  kepada VARCHAR(12) NOT NULL,
  statustransaction VARCHAR(50) NOT NULL,
  norujukan VARCHAR(50) NULL,
  rf VARCHAR(50) NULL,
  merchantid VARCHAR(50) NULL,
  jeniskad VARCHAR(50)  NULL,
  status_dokumen VARCHAR(50) NOT NULL,
  doc_acceptby VARCHAR(50) NULL,
  doc_acceptby_nama VARCHAR(50) DEFAULT NULL COMMENT 'nama orang yang ambil',
  doc_giveby VARCHAR(50) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_transaksi),
  -- FOREIGN KEY (ic_pengguna) REFERENCES akaun_pengguna (ic_pengguna),
  FOREIGN KEY (id_kodtransaksi) REFERENCES kod_transaksi (id_kodtransaksi),
  FOREIGN KEY (id_jenistransaksi) REFERENCES kod_jenistransaksi (id_jenistransaksi)
);

CREATE TABLE site_visit (
  ic_pengguna VARCHAR(12) NOT NULL,
  id_kodtransaksi INT(10) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ic_pengguna,id_kodtransaksi));

CREATE TABLE tracking (
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  id_jenistransaksi VARCHAR(16) NOT NULL,
  jabatan VARCHAR(40) NOT NULL,
  description VARCHAR(300) NULL,
  tarikhbuka DATE NOT NULL,
  tarikhtutup DATE NOT NULL,
  harga FLOAT(10,2) NOT NULL,
  tindakan VARCHAR(15) NULL,
  edit_by VARCHAR(100) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
  );

--
-- Dumping data for table user_account
--

INSERT INTO `kod_jenispengguna` (`kod_pengguna`, `jenis_pengguna`, `jabatan`, `created_date`) VALUES
('1', 'user', NULL, '2019-04-23 05:40:35'),
('2', 'admin', 'Bendahari', '2019-04-23 05:40:35'),
('3', 'sub-admin', 'JPP', '2019-04-23 05:40:35'),
('4', 'sub-admin', 'PERPUSTAKAAN', '2019-05-11 02:28:46'),
('5', 'sub-admin', 'BPA', '2019-08-21 13:00:47'),
('6', 'sub-admin', 'PWIU', '2019-08-21 17:38:10'),
('7', 'sub-admin', 'PENERBIT', '2019-08-22 03:43:58');


INSERT INTO `maklumat_pengguna` (`ic_pengguna`, `nama`, `email`, `no_telefon`, `matr`, `created_date`) VALUES
('123', 'Masjid UniSZA', 'm24@unisza.edu.my', '123', NULL, '2019-08-21 17:38:54'),
('12345', 'Admin Library', 'lib@unisza.edu.my', '12345', '-', '2019-05-11 02:31:50'),
('780714115257', 'MIE COMEY', 'shahimi@unisza.edu.my', '012-6203024', NULL, '2019-08-22 03:56:57'),
('9100', 'Risham', 'risham@unisza.edu.my', '12345', '040472', '2019-08-22 04:25:00'),
('941013112203', 'Ahmad', 'ahmad@gmail.com', '0179372203', 'MATR', '2019-04-23 05:40:35'),
('941013115434', 'Amir Fitri', 'amir@unisza.edu.my', '0109668468', 'MATR', '2019-04-23 05:40:35'),
('941013115435', 'Shahrul Haniff', 'shahrul@unisza.edu.my', '0109668468', 'MATR', '2019-04-23 05:40:35'),
('941013115436', 'Bendahari UniSZA', 'bendahari@unisza.edu.my', '0109668468', '-', '2019-04-23 05:40:35');

INSERT INTO `akaun_pengguna` (`ic_pengguna`, `kod_pengguna`, `pwd`, `jenis_akaun`, `status_aktif`, `ipaddress`, `lastlogin`, `created_date`) VALUES
('123', '6', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'yes', NULL, NULL, '2019-08-21 17:38:54'),
('12345', '4', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'yes', NULL, NULL, '2019-05-11 02:31:50'),
('780714115257', '7', 'abea1bc5d49746eb8a97908f5826c204c3ceba6474c56ad2a4318be43628a8c1', NULL, 'yes', NULL, NULL, '2019-08-22 03:56:57'),
('9100', '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'P', 'yes', '::1', '2019-08-22 04:25:16', '2019-08-22 04:25:00'),
('941013112203', '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'yes', NULL, NULL, '2019-04-23 05:40:36'),
('941013115434', '3', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'no', NULL, NULL, '2019-04-23 05:40:36'),
('941013115435', '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'yes', '::1', '2019-08-24 09:31:42', '2019-04-23 05:40:36'),
('941013115436', '2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'yes', NULL, NULL, '2019-04-23 05:40:36');
--
-- Dumping data for table transaksi
--

-- INSERT INTO transaksi (jenis_transaksi, tarikh, jumlah, ic_pengguna, daripada, kepada) VALUES ('a2u', '2019-03-21 06:12:16', 17000.55, '941013115435', '941013115436', '941013115435');

INSERT INTO `kod_jenistransaksi` (`id_jenistransaksi`, `jenistransaksi`, `jabatan`, `created_date`) VALUES
('JT20190427043445', 'D', 'JPP', '2019-04-26 12:34:45'),
('JT20190511183008', 'D', 'PERPUSTAKAAN', '2019-05-11 02:30:08'),
('JT20190822013810', 'D', 'PWIU', '2019-08-21 17:38:10'),
('JT20190822115117', 'SYD', 'PENERBIT', '2019-08-22 03:51:17'),
('SB', 'SBT', 'JPP', '2019-04-23 05:40:36');


INSERT INTO `kod_transaksi` (`id_kodtransaksi`, `kod_pengguna`, `no_sb`, `description`, `tarikhbuka`, `tarikhtutup`, `jam`, `harga`, `id_jenistransaksi`, `kelas`, `keyin_by`, `tarikh_keyin`, `edit_by`, `tarikh_edit`, `dttaklimat`, `tempatlwtntapak`, `sulit`, `created_date`) VALUES
(1, '3', 'IDSB001', 'Contoh butiran sebut harga', '2019-06-05', '2019-08-08', '01:00:00', 17000.39, 'SB', 'CIDB Gred G2 Kategori ME Pengkhususan M04', 'IC Pegawai keyin', '2019-03-06 11:27:27', 'Bendahari UniSZA', '2019-04-25 07:53:11', NULL, 'Bangunan JPP Universiti Sultan Zainal Abidin, Kampus Gong Badak, Kuala Nerus', 'T', '2019-04-23 05:40:36'),
(2, '3', 'PEMB(E)SH/66/2018', 'CADANGAN KERJA-KERJA PEMASANGAN FEEDER PILLAR UTAMA TERMASUK KABEL 3 FASA KE KANDANG KAMBING SERTA KERJA-KERJA BERKAITAN DI LADANG PASIR AKAR UNISZA BESUT, TEENGGANU DARUL IMAN', '2019-03-01', '2019-10-04', '12:00:00', 30.00, 'SB', 'CIDB Gred G2 Kategori ME Pengkhususan M04', 'PENYELARAS', '2019-03-01 13:00:00', 'Bendahari UniSZA', '2019-08-14 05:23:49', NULL, 'Bangunan JPP Universiti Sultan Zainal Abidin, Kampus Gong Badak, Kuala Nerus', 'T', '2019-04-23 05:40:36'),
(3, '4', 'LIBDENDA', 'Denda pelbagai dari perpustakaan', '2019-05-03', '2020-05-04', '01:00:00', 0.00, 'JT20190511183008', '-', 'Admin Library', '2019-05-11 06:38:25', NULL, NULL, NULL, NULL, 'T', '2019-05-11 02:38:25'),
(4, '6', 'DERMAM24', 'Infaq Raya Haji', '2019-08-22', '2019-09-30', '01:00:00', 0.00, 'JT20190822013810', '-', 'Masjid UniSZA', '2019-08-22 01:41:27', NULL, NULL, NULL, NULL, 'T', '2019-08-21 17:41:27'),
(5, '7', 'PEN123', 'Jualan Buku', '2019-08-22', '2019-08-31', '01:00:00', 0.00, 'JT20190822115117', '-', 'MIE COMEY', '2019-08-22 12:13:03', NULL, NULL, NULL, NULL, 'T', '2019-08-22 04:13:03'),
(6, '7', 'PEN124', 'Jualan Buku', '2019-08-01', '2019-08-31', '01:00:00', 0.00, 'JT20190822115117', '-', 'MIE COMEY', '2019-08-24 05:34:34', 'MIE COMEY', '2019-08-24 05:35:09', NULL, NULL, 'T', '2019-08-24 09:34:34');


INSERT INTO `transaksi` (`id_transaksi`, `ic_pengguna`, `id_kodtransaksi`, `id_jenistransaksi`, `tarikh`, `jumlah`, `daripada`, `kepada`, `statustransaction`, `norujukan`, `merchantid`, `jeniskad`, `status_dokumen`, `doc_acceptby`, `doc_acceptby_nama`, `doc_giveby`, `created_date`) VALUES
(2, '941013115435', 2, 'SB', '2019-04-23 12:48:15', 30.00, '941013115435', '941013115436', 'Approved', '2090001301', '10701100006', 'MC', 'NO', NULL, NULL, NULL, '2019-04-22 20:48:15'),
(3, '941013112203', 2, 'SB', '2019-04-23 12:54:16', 30.00, '941234111234', '941013115436', 'Approved', '2090001302', '10701100006', 'MC', 'NO', NULL, NULL, NULL, '2019-04-22 20:54:16');
  
INSERT INTO `tracking` (`id`, `id_jenistransaksi`, `jabatan`, `description`, `tarikhbuka`, `tarikhtutup`, `harga`, `tindakan`, `edit_by`, `created_date`) VALUES
(1, 'SB', 'JPP', 'test01', '2020-01-01', '2019-04-25', 1.00, 'Tambah', 'Amir Fitri', '2019-04-24 20:58:11'),
(2, 'SB', 'JPP', 'test01', '2020-01-01', '2019-04-25', 1.00, 'Padam', 'Amir Fitri', '2019-04-24 20:58:51'),
(3, 'SB', 'JPP', 'Sebut harga penambahbaik banguna...', '2019-01-01', '2019-01-01', 60.00, 'Tambah', 'Amir Fitri', '2019-04-24 21:01:06'),
(4, 'SB', 'JPP', 'Sebut harga penambahbaik banguna...', '2019-01-01', '2019-05-05', 60.00, 'Kemaskini', 'Amir Fitri', '2019-04-24 21:01:26'),
(5, 'SB', 'JPP', 'Sebut harga penambahbaik banguna...', '2019-01-01', '2019-05-05', 20.00, 'Kemaskini', 'Amir Fitri', '2019-04-24 21:01:56'),
(6, 'SB', 'JPP', 'Sebut harga penambahbaik banguna...', '2019-01-01', '2019-05-05', 20.00, 'Padam', 'Amir Fitri', '2019-04-24 21:04:09'),
(7, 'JT20190427043445', 'JPP', 'Sebut harga pembangunan apli...', '2019-01-01', '2019-01-01', 9.00, 'Tambah', 'Amir Fitri', '2019-05-08 02:29:52'),
(8, 'JT20190427043445', 'JPP', 'Sebut harga pembangunan apli...', '2019-01-01', '2019-01-01', 9.00, 'Kemaskini', 'Amir Fitri', '2019-05-08 02:30:14'),
(9, 'JT20190427043445', 'JPP', 'Sebut harga pembangunan apli...', '2019-01-01', '2019-01-01', 9.00, 'Padam', 'Amir Fitri', '2019-05-08 02:30:28'),
(10, 'JT20190425170551', 'JPP', 'Pengemaskinian dewan dan ...', '2019-01-01', '2019-06-06', 89.00, 'Tambah', 'Amir Fitri', '2019-05-08 02:38:42'),
(11, 'JT20190425170551', 'JPP', 'Pengemaskinian dewan dan ...', '2019-01-01', '2019-06-06', 89.00, 'Kemaskini', 'Amir Fitri', '2019-05-08 02:39:06'),
(12, 'JT20190425170551', 'JPP', 'Pengemaskinian dewan dan ...', '2019-01-01', '2019-06-06', 89.00, 'Padam', 'Amir Fitri', '2019-05-08 03:03:44'),
(13, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelbagai', '2019-05-01', '2030-01-01', 0.00, 'Tambah', 'Admin Library', '2019-05-11 02:33:41'),
(14, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelbagai', '2019-05-01', '2030-01-01', 0.00, 'Padam', 'Admin Library', '2019-05-11 02:36:56'),
(15, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelajar', '2019-05-03', '2020-05-04', 0.00, 'Tambah', 'Admin Library', '2019-05-11 02:38:25'),
(16, 'JT20190822013810', 'PWIU', 'Infaq Raya Haji', '2019-08-22', '2019-09-30', 0.00, 'Tambah', 'Masjid UniSZA', '2019-08-21 17:41:27'),
(17, 'JT20190822115117', 'PENERBIT', 'Jualan Buku', '2019-08-22', '2019-08-31', 0.00, 'Tambah', 'MIE COMEY', '2019-08-22 04:13:03'),
(18, 'JT20190822115117', 'PENERBIT', 'Jualan Buku', '2019-08-01', '2019-08-03', 0.00, 'Tambah', 'MIE COMEY', '2019-08-24 09:34:34'),
(19, 'JT20190822115117', 'PENERBIT', 'Jualan Buku', '2019-08-01', '2019-08-31', 0.00, 'Kemaskini', 'MIE COMEY', '2019-08-24 09:35:09');


INSERT INTO `kod_jabatan` (`idptj`, `singkatan`, `namaptj`, `created_date`) VALUES
('BPA', 'BPA', 'Bahagian Pengurusan Akademik', '2019-08-14 09:21:38'),
('IA', 'IA', 'Institut Agrobioteknologi', '2019-08-14 09:21:38'),
('IPASPT', 'IPASPT', 'Institut Penyelidikan Alam Sekitar Pantai Timur', '2019-08-14 09:21:38'),
('IPKM', 'IPKM', 'Institut Pembangunan (Kesihatan) Masyarakat', '2019-08-14 09:21:38'),
('IPPKMI', 'IPPKMI', 'Institut Penyelidikan Produk & Ketamadunan Melayu Islam', '2019-08-14 09:21:38'),
('JK', 'JK', 'Jabatan Keselamatan', '2019-08-14 09:21:38'),
('JPP', 'JPP', 'Jabatan Pengurusan Pembangunan', '2019-08-14 09:21:38'),
('KKU', 'KKU', 'Kolej Kediaman UniSZA', '2019-08-14 09:21:38'),
('METRO', 'METRO', 'Metro UniSZA@KL', '2019-08-14 09:21:38'),
('P5', 'P5', 'Pusat Pengurusan Penjanaan Pendapatan & Pengkomersialan', '2019-08-14 09:21:38'),
('PA', 'PA', 'Pusat Antarabangsa', '2019-08-14 09:21:38'),
('PENERBIT', 'PENERBIT', 'Penerbit UniSZA', '2019-08-22 03:39:29'),
('PERPUSTAKAAN', 'PERPUSTAKAAN', 'Perpustakaan UniSZA', '2019-08-14 09:21:38'),
('PIU', 'PIU', 'Pusat Islam UniSZA', '2019-08-14 09:21:38'),
('PJIM', 'PJIM', 'Pusat Jaringan Industri & Masyarakat', '2019-08-14 09:21:38'),
('PKAE', 'PKAE', 'Pusat Kualiti Akademik & e-Pembelajaran', '2019-08-14 09:21:38'),
('PKK', 'PKK', 'Pusat Komunikasi Korporat', '2019-08-14 09:21:38'),
('PKKP', 'PKKP', 'Pusat Keusahawanan & Kebolehpasaran Pelajar', '2019-08-14 09:21:38'),
('PKP', 'PKP', 'Pusat Kesihatan Pelajar', '2019-08-14 09:21:38'),
('PPB', 'PPB', 'Pusat Pendidikan Berterusan', '2019-08-14 09:21:38'),
('PPHP', 'PPHP', 'Pusat Pembangunan Holistik Pelajar', '2019-08-14 09:21:38'),
('PPHU', 'PPHU', 'Pusat Pembangunan Hospital Universiti', '2019-08-14 09:21:38'),
('PPKB', 'PPKB', 'Pejabat Pengarah Kampus Besut', '2019-08-14 09:21:38'),
('PPL', 'PPL', 'Pusat Pengurusan Ladang', '2019-08-14 09:21:38'),
('PPP', 'PPP', 'Penjanaan Pendapatan & Pengkomersialan', '2019-08-14 09:21:38'),
('PPPIP', 'PPPIP', 'Pusat Pengurusan Penyelidikan, Inovasi & Pengkomersilan', '2019-08-14 09:21:38'),
('PPSPK', 'PPSPK', 'Pusat Perancangan Strategik & Pengurusan Kualiti', '2019-08-14 09:21:38'),
('PSPK', 'PSPK', 'Perancangan Strategik & Pengurusan Kualiti', '2019-08-14 09:21:38'),
('PSR', 'PSR', 'Pusat Sukan & Rekreasi', '2019-08-14 09:21:38'),
('PSW', 'PSW', 'Pusat Kesenian & Warisan', '2019-08-14 09:21:38'),
('PTM', 'PTM', 'Pusat Teknologi Maklumat', '2019-08-14 09:21:38'),
('PUSPA', 'PUSPA', 'Pusat Asasi Sains & Perubatan UniSZA', '2019-08-14 09:21:38'),
('PWIU', 'PWIU', 'Pejabat Wakaf dan Infaq UniSZA', '2019-08-14 09:21:38'),
('UAD', 'UAD', 'Unit Audit Dalam', '2019-08-14 09:21:38'),
('UDH', 'UDH', 'UniSZA Digital Hub', '2019-08-14 09:21:38');

