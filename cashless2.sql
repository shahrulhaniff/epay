--
-- Database: cashless
--
/* */ 
-- DROP DATABASE cashless;
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
('1', 'user', NULL, '2019-04-23 13:40:35'),
('2', 'admin', 'Bendahari', '2019-04-23 13:40:35'),
('3', 'sub-admin', 'JPP', '2019-04-23 13:40:35'),
('4', 'sub-admin', 'PERPUSTAKAAN', '2019-05-11 10:28:46');


INSERT INTO `maklumat_pengguna` (`ic_pengguna`, `nama`, `email`, `no_telefon`, `matr`, `created_date`) VALUES
('12345', 'Admin Library', 'lib@unisza.edu.my', '12345','-', '2019-05-11 10:31:50'),
('941013112203', 'Ahmad', 'ahmad@gmail.com', '0179372203','MATR', '2019-04-23 13:40:35'),
('941013115434', 'Amir Fitri', 'amir@unisza.edu.my', '0109668468','MATR', '2019-04-23 13:40:35'),
('941013115435', 'Shahrul Haniff', 'shahrul@unisza.edu.my', '0109668468','MATR', '2019-04-23 13:40:35'),
('941013115436', 'Bendahari UniSZA', 'bendahari@unisza.edu.my', '0109668468','-', '2019-04-23 13:40:35');

INSERT INTO `akaun_pengguna` (`ic_pengguna`, `kod_pengguna`, `pwd`, `status_aktif`, `created_date`) VALUES
('12345', '4', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'yes', '2019-05-11 10:31:50'),
('941013112203', '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'yes', '2019-04-23 13:40:36'),
('941013115434', '3', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'no', '2019-04-23 13:40:36'),
('941013115435', '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'yes', '2019-04-23 13:40:36'),
('941013115436', '2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'yes', '2019-04-23 13:40:36');
--
-- Dumping data for table transaksi
--

-- INSERT INTO transaksi (jenis_transaksi, tarikh, jumlah, ic_pengguna, daripada, kepada) VALUES ('a2u', '2019-03-21 06:12:16', 17000.55, '941013115435', '941013115436', '941013115435');

INSERT INTO `kod_jenistransaksi` (`id_jenistransaksi`, `jenistransaksi`, `jabatan`, `created_date`) VALUES
('JT20190425170551', 'Derma', 'JPP', '2019-04-25 09:05:51'),
('JT20190425171135', 'Tender', 'PWIU', '2019-04-25 09:11:35'),
('JT20190427043445', 'Tender', 'JPP', '2019-04-26 20:34:45'),
('JT20190511183008', 'Denda', 'PERPUSTAKAAN', '2019-05-11 10:30:08'),
('SB', 'Sebut Harga', 'JPP', '2019-04-23 13:40:36');


INSERT INTO `kod_transaksi` (`id_kodtransaksi`, `kod_pengguna`, `no_sb`, `description`, `tarikhbuka`, `tarikhtutup`, `jam`, `harga`, `id_jenistransaksi`, `kelas`, `keyin_by`, `tarikh_keyin`, `edit_by`, `tarikh_edit`, `dttaklimat`, `tempatlwtntapak`, `sulit`, `created_date`) VALUES
(1, '3', 'IDSB001', 'Contoh butiran sebut harga', '2019-06-05', '2019-08-08', '01:00:00', 17000.39, 'SB', 'CIDB Gred G2 Kategori ME Pengkhususan M04', 'IC Pegawai keyin', '2019-03-06 11:27:27', 'Bendahari UniSZA', '2019-04-25 07:53:11', NULL, 'Bangunan JPP Universiti Sultan Zainal Abidin, Kampus Gong Badak, Kuala Nerus', 'T', '2019-04-23 13:40:36'),
(2, '3', 'PEMB(E)SH/66/2018', 'CADANGAN KERJA-KERJA PEMASANGAN FEEDER PILLAR UTAMA TERMASUK KABEL 3 FASA KE KANDANG KAMBING SERTA KERJA-KERJA BERKAITAN DI LADANG PASIR AKAR UNISZA BESUT, TEENGGANU DARUL IMAN', '2019-03-01', '2019-03-31', '12:00:00', 30.00, 'SB', 'CIDB Gred G2 Kategori ME Pengkhususan M04', 'PENYELARAS', '2019-03-01 13:00:00', NULL, NULL, NULL, 'Bangunan JPP Universiti Sultan Zainal Abidin, Kampus Gong Badak, Kuala Nerus', 'T', '2019-04-23 13:40:36'),
(3, '4', 'LIBDENDA', 'Denda pelbagai dari perpustakaan', '2019-05-03', '2020-05-04', '01:00:00', 0.00, 'JT20190511183008', '-', 'Admin Library', '2019-05-11 06:38:25', NULL, NULL, NULL, NULL, 'T', '2019-05-11 10:38:25');


INSERT INTO `transaksi` (`id_transaksi`, `ic_pengguna`, `id_kodtransaksi`, `id_jenistransaksi`, `tarikh`, `jumlah`, `daripada`, `kepada`, `statustransaction`, `norujukan`, `merchantid`, `jeniskad`, `status_dokumen`, `doc_acceptby`, `doc_acceptby_nama`, `doc_giveby`, `created_date`) VALUES
(2, '941013115435', 2, 'SB', '2019-04-23 12:48:15', 30.00, '941013115435', '941013115436', 'Approved', '2090001301', '10701100006', 'MC', 'NO', NULL, NULL, NULL, '2019-04-23 04:48:15'),
(3, '941013112203', 2, 'SB', '2019-04-23 12:54:16', 30.00, '941234111234', '941013115436', 'Approved', '2090001302', '10701100006', 'MC', 'NO', NULL, NULL, NULL, '2019-04-23 04:54:16');

  
  
INSERT INTO `tracking` (`id`, `id_jenistransaksi`, `jabatan`, `description`, `tarikhbuka`, `tarikhtutup`, `harga`, `tindakan`, `edit_by`, `created_date`) VALUES
(1, 'SB', 'JPP', 'test01', '2020-01-01', '2019-04-25', 1.00, 'Tambah', 'Amir Fitri', '2019-04-25 04:58:11'),
(2, 'SB', 'JPP', 'test01', '2020-01-01', '2019-04-25', 1.00, 'Padam', 'Amir Fitri', '2019-04-25 04:58:51'),
(3, 'SB', 'JPP', 'dermatest12', '2019-01-01', '2019-01-01', 60.00, 'Tambah', 'Amir Fitri', '2019-04-25 05:01:06'),
(4, 'SB', 'JPP', 'dermatest12', '2019-01-01', '2019-05-05', 60.00, 'Kemaskini', 'Amir Fitri', '2019-04-25 05:01:26'),
(5, 'SB', 'JPP', 'dermatest12', '2019-01-01', '2019-05-05', 20.00, 'Kemaskini', 'Amir Fitri', '2019-04-25 05:01:56'),
(6, 'SB', 'JPP', 'dermatest12', '2019-01-01', '2019-05-05', 20.00, 'Padam', 'Amir Fitri', '2019-04-25 05:04:09'),
(7, 'JT20190427043445', 'JPP', 'padam4test', '2019-01-01', '2019-01-01', 9.00, 'Tambah', 'Amir Fitri', '2019-05-08 10:29:52'),
(8, 'JT20190427043445', 'JPP', 'padam4testpadam4testpadam4testpadam4test', '2019-01-01', '2019-01-01', 9.00, 'Kemaskini', 'Amir Fitri', '2019-05-08 10:30:14'),
(9, 'JT20190427043445', 'JPP', 'padam4testpadam4testpadam4testpadam4test', '2019-01-01', '2019-01-01', 9.00, 'Padam', 'Amir Fitri', '2019-05-08 10:30:28'),
(10, 'JT20190425170551', 'JPP', 'sebut_harga_kemaskini_exec.php', '2019-01-01', '2019-06-06', 89.00, 'Tambah', 'Amir Fitri', '2019-05-08 10:38:42'),
(11, 'JT20190425170551', 'JPP', 'sebut_harga_kemaskini_exec.php', '2019-01-01', '2019-06-06', 89.00, 'Kemaskini', 'Amir Fitri', '2019-05-08 10:39:06'),
(12, 'JT20190425170551', 'JPP', 'sebut_harga_kemaskini_exec.php', '2019-01-01', '2019-06-06', 89.00, 'Padam', 'Amir Fitri', '2019-05-08 11:03:44'),
(13, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelbagai', '2019-05-01', '2030-01-01', 0.00, 'Tambah', 'Admin Library', '2019-05-11 10:33:41'),
(14, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelbagai', '2019-05-01', '2030-01-01', 0.00, 'Padam', 'Admin Library', '2019-05-11 10:36:56'),
(15, 'JT20190511183008', 'PERPUSTAKAAN', 'Denda pelbagai dari perpustakaan', '2019-05-03', '2020-05-04', 0.00, 'Tambah', 'Admin Library', '2019-05-11 10:38:25');



INSERT INTO kod_jabatan (idptj ,singkatan ,namaptj ) VALUES
('PSPK','PSPK','Perancangan Strategik & Pengurusan Kualiti'),
('PPP','PPP','Penjanaan Pendapatan & Pengkomersialan'),
('PTM','PTM','Pusat Teknologi Maklumat'),
('JPP','JPP','Jabatan Pengurusan Pembangunan'),
('PERPUSTAKAAN','PERPUSTAKAAN','Perpustakaan UniSZA'),
('PPPIP','PPPIP','Pusat Pengurusan Penyelidikan, Inovasi & Pengkomersilan'),
('PKK','PKK','Pusat Komunikasi Korporat'),
('PA','PA','Pusat Antarabangsa'),
('PKAE','PKAE','Pusat Kualiti Akademik & e-Pembelajaran'),
('PPSPK','PPSPK','Pusat Perancangan Strategik & Pengurusan Kualiti'),
('PPKB','PPKB','Pejabat Pengarah Kampus Besut'),
('IPPKMI','IPPKMI','Institut Penyelidikan Produk & Ketamadunan Melayu Islam'),
('IPASPT','IPASPT','Institut Penyelidikan Alam Sekitar Pantai Timur'),
('IA','IA','Institut Agrobioteknologi'),
('IPKM','IPKM','Institut Pembangunan (Kesihatan) Masyarakat'),
('P5','P5','Pusat Pengurusan Penjanaan Pendapatan & Pengkomersialan'),
('JK','JK','Jabatan Keselamatan'),
('BPA','BPA','Bahagian Pengurusan Akademik'),
('PJIM','PJIM','Pusat Jaringan Industri & Masyarakat'),
('KKU','KKU','Kolej Kediaman UniSZA'),
('PIU','PIU','Pusat Islam UniSZA'),
('PKKP','PKKP','Pusat Keusahawanan & Kebolehpasaran Pelajar'),
('PPHP','PPHP','Pusat Pembangunan Holistik Pelajar'),
('PSR','PSR','Pusat Sukan & Rekreasi'),
('PSW','PSW','Pusat Kesenian & Warisan'),
('PUSPA','PUSPA','Pusat Asasi Sains & Perubatan UniSZA'),
('UAD','UAD','Unit Audit Dalam'),
('PKP','PKP','Pusat Kesihatan Pelajar'),
('PPB','PPB','Pusat Pendidikan Berterusan'),
('METRO','METRO','Metro UniSZA@KL'),
('PPHU','PPHU','Pusat Pembangunan Hospital Universiti'),
('PWIU','PWIU','Pejabat Wakaf dan Infaq UniSZA'),
('PPL','PPL','Pusat Pengurusan Ladang'),
('UDH','UDH','UniSZA Digital Hub');

