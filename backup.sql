-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: kearsipan
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `letter_id` bigint unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_letter_id_foreign` (`letter_id`),
  CONSTRAINT `attachments_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classifications`
--

DROP TABLE IF EXISTS `classifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classifications` (
  `code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `classifications_parent_code_foreign` (`parent_code`),
  CONSTRAINT `classifications_parent_code_foreign` FOREIGN KEY (`parent_code`) REFERENCES `classifications` (`code`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classifications`
--

LOCK TABLES `classifications` WRITE;
/*!40000 ALTER TABLE `classifications` DISABLE KEYS */;
INSERT INTO `classifications` VALUES ('000',NULL,'UMUM','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1','000','KETATAUSAHAAN DAN KERUMAHTANGGAAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.10','000.1','Ketertiban dan Keamanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.10.1','000.1.10','Pengamanan, Pengawalan Penjagaan, terhadap dan Pejabat, Kantor dan Rumah Dinas','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.10.2','000.1.10','Laporan Ketertiban dan Keamanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.11','000.1','Administrasi Pengelolaan Parkir','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.12','000.1','Administrasi Pakaian Dinas Pegawai, Satpam, Petugas Kebersihan dan Pegawai lainnya','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.2','000.1','Perjalanan Dinas Dalam Negeri','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.2.1','000.1.2','Perjalanan Dinas Kepala Daerah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.2.2','000.1.2','Perjalanan Dinas DPRD','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.2.3','000.1.2','Perjalanan Dinas Pegawai','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.4','000.1','Penggunaan Fasilitas Kantor (antara lain: Permintaan dan penggunaan ruang, gedung, kendaraan, wisma, rumah dinas dan fasilitas kantor lainnya)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.5','000.1','Rapat pimpinan antara lain: Notula/Risalah Rapat','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8','000.1','Pemeliharaan Gedung, Taman dan Peralatan Kantor','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.1','000.1.8','Pertamanan/Landscape','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.2','000.1.8','Penghijauan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.3','000.1.8','Perbaikan Gedung','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.4','000.1.8','Perbaikan Peralatan Kantor','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.5','000.1.8','Perbaikan Rumah Dinas/Wisma','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.8.6','000.1.8','Kebersihan Gedung dan Taman','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.9','000.1','Pengelolaan Jaringan Listrik, Air, Telepon dan Komputer','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.9.1','000.1.9','Perbaikan/Pemeliharaan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.1.9.2','000.1.9','Pemasangan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2','000','PERLENGKAPAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.1','000.2','Inventarisasi dan Penyimpanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.1.1','000.2.1','Data hasil inventarisasi dan penyimpanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.1.2','000.2.1','Laporan dan evaluasi inventarisasi dan penyimpanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.2','000.2','Pemeliharaan peralatan kantor','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.2.1','000.2.2','Data hasil pemeliharaan kantor','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.2.2','000.2.2','Laporan dan evaluasi  Pemeliharaan kantor','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.3','000.2','Distribusi','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.3.1','000.2.3','Barang habis pakai','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.3.2','000.2.3','Barang milik daerah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.4','000.2','Penghapusan Barang Milik Daerah antara lain: Keputusan Pembentukan Tim, Berita Acara  Penghapusan Barang Milik Daerah, Daftar Barang  yang dihapuskan, Laporan Hasil Pelaksanaan Penghapusan BMD termasuk didalamnya proses lelang penghapusan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.2.5','000.2','Pengelolaan Database Barang Milik Daerah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.3','000','PENGADAAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.4','000','PERPUSTAKAAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5','000','KEARSIPAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3','000.5','Pengelolaan Arsip Dinamis','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3.1','000.5.3','Penciptaan (antara lain: Buku Registrasi Naskah Masuk dan Keluar, Buku Agenda, Kartu Kendali, Lembar Pengantar/Buku Ekspedisi)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3.2','000.5.3','Pemberkasan Arsip Aktif (antara lain: daftar berkas dan daftar isi berkas)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3.3','000.5.3','Penataan Arsip Inaktif (antara lain: daftar arsip arsip inaktif tematik)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3.4','000.5.3','Penggunaan (antara lain: daftar arsip dinamis berdasarkan sistem klasifikasi keamanan dan akses arsip dinamis, bukti peminjaman arsip)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.3.5','000.5.3','Autentikasi Arsip Dinamis (antara lain: pembuktian autentisitas, pendapat tenaga ahli, pengujian, penetapan autentisitas dinamis)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.6','000.5','Penyusutan Arsip','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.6.1','000.5.6','Pemindahan Arsip (antara lain: Berita Acara Pemindahan, Daftar Arsip yang dipindahkan)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.6.2','000.5.6','Pemusnahan Arsip (antara lain: SK Penetapan Panitia Penilai Arsip, Pertimbangan Panitia Permintaan Persetujuan Penilai, Kepala ANRI Untuk pemusnahan arsip dengan Retensi sekurang-kurangnya 10 (sepuluh) tahun atau    Persetujuan Kepala Daerah selaku   Pimpinan  Pencipta Arsip untuk pemusnahan   retensi di bawah   tahun,    arsip   10    dengan  (sepuluh) Penetapan Arsip Yang     Dimusnahkan,     Berita     Acara Pemusnahan   Arsip,  Daftar Arsip Yang Dimusnahkan.','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.5.6.3','000.5.6','Penyerahan   Arsip   Statis   (antara lain: Pembentukan  panitia  penilai,  Notulen rapat panitia, Surat   Pertimbangan panitia penilai,   Surat  persetujuan dari Kepala Lembaga    Kearsipan, Surat Pernyataan  autentik, terpercaya, utuh, dan   digunakan   dari   pencipta    arsip, Keputusan Penetapan  Penyerahan, Berita Acara  Penyerahan  Arsip,  Daftar Arsip yang diserahkan)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8','000','ORGANISASI DAN TATA LAKSANA','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.1','000.8','Struktur    Organisasi    di    lingkungan      Pemerintahan Daerah Kab/Kota','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.2','000.8','Uraian Jabatan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.2.1','000.8.2','Analisa Jabatan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.2.2','000.8.2','Analisa Beban Kerja','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.3','000.8','Ketatalaksanaan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.3.1','000.8.3','Proses Bisnis','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.3.2','000.8.3','Standar Pelayanan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.3.3','000.8.3','Standar Operasional Prosedur','2026-04-18 06:02:11','2026-04-18 06:02:11'),('000.8.3.4','000.8.3','Pelayanan Publik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14',NULL,'HUBUNGAN MASYARAKAT','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.10','400.14','Pameran/ sayembara/ lomba/ festival, pembuatan spanduk dan iklan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.11','400.14','Penghargaan/tanda kenang-kenangan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.12','400.14','Ucapan Terima kasih, Ucapan Selamat, Bela Sungkawa, Permohonan Maaf','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5','400.14','Hubungan antar lembaga dan Pemerintahan Daerah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.1','400.14.5','Hubungan pemerintah antar lembaga','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.2','400.14.5','Hubungan dengan organisasi sosial / LSM','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.3','400.14.5','Hubungan dengan perusahaan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.4','400.14.5','Hubungan dengan Perguruan Tinggi/ sekolah, termasuk magang, Pendidikan Sistem Ganda (PSG)/ Praktik Kerja Lapang (PKL)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.5','400.14.5','Forum Kehumasan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.5.6','400.14.5','Hubungan dengan Media Massa','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.8','400.14','Penerbitan Majalah, buletin, koran dan jurnal','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.14.9','400.14','Publikasi melalui media cetak maupun  elektronik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3',NULL,'PENDIDIKAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.1','400.3','Kebijakan di bidang Pendidikan yang dilakukan oleh Pemerintah Daerah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10','400.3','Pendidik dan Tenaga Pendidik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.1','400.3.10','Pendataan dan Pemetaan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.2','400.3.10','Uji Kompetensi Guru','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.3','400.3.10','Sertifikasi Guru','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.4','400.3.10','Penilaian  prestasi    kerja    guru    dan pengawas sekolah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.5','400.3.10','Penghargaan      guru      dan     tenaga kependidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.10.6','400.3.10','Peningkatan  kesejahteraan  guru  dan tenaga pendidik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.11','400.3','Penilaian Akademik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.12','400.3','Data dan Statistik Pendidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.12.1','400.3.12','Data    peserta    didik,    pendidik   dan tenaga kependidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.12.2','400.3.12','Data   Satuan  Pendidikan  dan Proses Pembelajaran','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.13','400.3','Prasarana dan Sarana Pendidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.13.1','400.3.13','Prasarana Pendidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.13.2','400.3.13','Sarana Pendidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.13.3','400.3.13','Monitoring dan Evaluasi','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.4','400.3','Kursus/Pelatihan Pendidik dan Tenaga Pendidik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.7','400.3','Pembinaan Pendidik dan Tenaga Pendidik','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.7.4','400.3.7','Penghargaan     guru      dan tenaga kependidikan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.7.5','400.3.7','Peningkatan kesejahteraan guru','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.7.6','400.3.7','Sosialisasi, bimtek','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.7.7','400.3.7','Block Grant','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8','400.3','Sekolah Menengah Atas','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.1','400.3.8','Kurikulum','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.2','400.3.8','Bahan Ajar','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.3','400.3.8','Pelatihan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.5','400.3.8','Bimbingan teknis/sosialisasi','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.6','400.3.8','Lomba, Sayembara, festival','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.7','400.3.8','Bantuan operasional Sekolah (BOS)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('400.3.8.8','400.3.8','Bantuan siswa miskin','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800',NULL,'KEPEGAWAIAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11','800','Administrasi Pegawai','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.1','800.1.11','Surat Perintah Dinas/Surat Tugas','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.10','800.1.11','Laporan Pajak Penghasilan Pribadi (LP2P)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.11','800.1.11','Keterangan Penerimaan Pembayaran 2)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.12','800.1.11','Daftar Urut Kepangkatan (DUK)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.13','800.1.11','Pengurusan   Kenaikan   Gaji Berkala, Mutasi Gaji/tunjangan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.2','800.1.11','Cuti Sakit','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.3','800.1.11','Cuti Bersalin','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.4','800.1.11','Cuti Tahunan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.5','800.1.11','Cuti Alasan Penting','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.6','800.1.11','Cuti Besar','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.7','800.1.11','Cuti Di luar Tanggungan Negara','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.8','800.1.11','Karpeg/KPE/Karis/Karsu','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.11.9','800.1.11','Keanggotaan Organisasi Profesi/ Kedinasan','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4','800','Pengembangan Karir','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4.1','800.1.4','Usulan Tugas Belajar/ Izin Belajar/ Diklat/ Kursus/ Magang/ Ujian  Dinas/ Praktik Kerja di Instansi lain/ Pertukaran antar ASN dengan pegawai swasta','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4.2','800.1.4','Penyesuaian ijazah','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4.3','800.1.4','Penyusunan Sistem Karier','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4.4','800.1.4','Standar Kinerja Pegawai (SKP) dan Penilaian Prestasi Kerja','2026-04-18 06:02:11','2026-04-18 06:02:11'),('800.1.4.5','800.1.4','Angka Kredit antara lain: Pengajuan Daftar Usul Kredit, Pengajuan Angka Penilaian Daftar Pengajuan Angka Kredit','2026-04-18 06:02:11','2026-04-18 06:02:11'),('900',NULL,'KEUANGAN','2026-04-18 06:02:11','2026-04-18 06:02:11'),('900.1','900','KEUANGAN DAERAH','2026-04-18 06:02:11','2026-04-18 06:02:11'),('900.1.1','900.1','Rencana Anggaran Pendapatan dan Belanja Daerah (RAPBD) dan Anggaran Pendapatan dan Belanja Daerah Perubahan (APBD-P)','2026-04-18 06:02:11','2026-04-18 06:02:11'),('900.1.2','900.1','Penyusunan Anggaran','2026-04-18 06:02:11','2026-04-18 06:02:11'),('900.1.3','900.1','Pelaksanaan Anggaran','2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `classifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispositions`
--

DROP TABLE IF EXISTS `dispositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dispositions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `letter_id` bigint unsigned NOT NULL,
  `receiver_role` enum('Admin','Ka TU','Staf TU','Waka','Kepala Sekolah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','In Progress','Completed','Returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dispositions_letter_id_foreign` (`letter_id`),
  CONSTRAINT `dispositions_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispositions`
--

LOCK TABLES `dispositions` WRITE;
/*!40000 ALTER TABLE `dispositions` DISABLE KEYS */;
INSERT INTO `dispositions` VALUES (1,4,'Waka',4,'Tolong ditindak lanjuti','Pending','2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `dispositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letter_request_attachments`
--

DROP TABLE IF EXISTS `letter_request_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `letter_request_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `letter_request_id` bigint unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letter_request_attachments_letter_request_id_foreign` (`letter_request_id`),
  CONSTRAINT `letter_request_attachments_letter_request_id_foreign` FOREIGN KEY (`letter_request_id`) REFERENCES `letter_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letter_request_attachments`
--

LOCK TABLES `letter_request_attachments` WRITE;
/*!40000 ALTER TABLE `letter_request_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `letter_request_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letter_requests`
--

DROP TABLE IF EXISTS `letter_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `letter_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `letter_id` bigint unsigned DEFAULT NULL,
  `waka_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letter_requests_letter_id_foreign` (`letter_id`),
  KEY `letter_requests_waka_id_foreign` (`waka_id`),
  CONSTRAINT `letter_requests_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters` (`id`),
  CONSTRAINT `letter_requests_waka_id_foreign` FOREIGN KEY (`waka_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letter_requests`
--

LOCK TABLES `letter_requests` WRITE;
/*!40000 ALTER TABLE `letter_requests` DISABLE KEYS */;
INSERT INTO `letter_requests` VALUES (1,'Permohonan Surat Keterangan Lulus','Saya memohon surat keterangan lulus untuk keperluan pendaftaran perguruan tinggi.','letter_requests/permohonan_skl.pdf',NULL,4,'2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `letter_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letter_templates`
--

DROP TABLE IF EXISTS `letter_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `letter_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `letter_templates_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letter_templates`
--

LOCK TABLES `letter_templates` WRITE;
/*!40000 ALTER TABLE `letter_templates` DISABLE KEYS */;
INSERT INTO `letter_templates` VALUES (1,'SPPD','sppd','SPPD.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(2,'Surat Balasan Cuti','surat-balasan-cuti','SURAT BALASAN CUTI.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(3,'Surat Keterangan Siswa','surat-keterangan-siswa','SURAT KETERANGAN SISWA.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(4,'Surat Pemberitahuan Pengambilan Ijazah','surat-pemberitahuan-pengambilan-ijazah','SURAT PEMBERITAHUAN PENGAMBILAN IJAZAH.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(5,'Surat Pengantar','surat-pengantar','SURAT PENGANTAR.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(6,'Surat Perintah Tugas 2025 - Edited','surat-perintah-tugas-2025-edited','SURAT PERINTAH TUGAS 2025 - EDITED.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(7,'Surat Perintah Tugas 2025','surat-perintah-tugas-2025','SURAT PERINTAH TUGAS 2025.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(8,'Surat Perintah Tugas Audit Internal','surat-perintah-tugas-audit-internal','SURAT PERINTAH TUGAS AUDIT INTERNAL.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(9,'Surat Perintah Tugas Piket 2025','surat-perintah-tugas-piket-2025','SURAT PERINTAH TUGAS PIKET 2025.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(10,'Surat Permohonan Kerjasama','surat-permohonan-kerjasama','SURAT PERMOHONAN KERJASAMA.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(11,'Surat Permohonan','surat-permohonan','SURAT PERMOHONAN.docx','2026-04-18 06:02:11','2026-04-18 06:02:11'),(12,'Surat Undangan','surat-undangan','SURAT UNDANGAN.docx','2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `letter_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letter_validates`
--

DROP TABLE IF EXISTS `letter_validates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `letter_validates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `letter_id` bigint unsigned NOT NULL,
  `waka_id` bigint unsigned DEFAULT NULL,
  `acc_katu` tinyint(1) NOT NULL DEFAULT '0',
  `acc_waka` tinyint(1) NOT NULL DEFAULT '0',
  `note_katu` text COLLATE utf8mb4_unicode_ci,
  `note_waka` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letter_validates_letter_id_foreign` (`letter_id`),
  KEY `letter_validates_waka_id_foreign` (`waka_id`),
  CONSTRAINT `letter_validates_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `letter_validates_waka_id_foreign` FOREIGN KEY (`waka_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letter_validates`
--

LOCK TABLES `letter_validates` WRITE;
/*!40000 ALTER TABLE `letter_validates` DISABLE KEYS */;
INSERT INTO `letter_validates` VALUES (1,6,3,0,0,NULL,NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11'),(2,6,4,0,0,NULL,NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `letter_validates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letters`
--

DROP TABLE IF EXISTS `letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `letters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_number` text COLLATE utf8mb4_unicode_ci,
  `origin_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence_number` int DEFAULT NULL,
  `year` year NOT NULL,
  `type` enum('Outgoing','Incoming') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Outgoing',
  `classification_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Received','Dispatched','Draft','Reviewing','Validated','Sent','Completed','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letters_classification_code_foreign` (`classification_code`),
  KEY `letters_year_index` (`year`),
  CONSTRAINT `letters_classification_code_foreign` FOREIGN KEY (`classification_code`) REFERENCES `classifications` (`code`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letters`
--

LOCK TABLES `letters` WRITE;
/*!40000 ALTER TABLE `letters` DISABLE KEYS */;
INSERT INTO `letters` VALUES (1,'002/SK/III/2026',NULL,2,2026,'Outgoing','000','Orang Tua/Wali Murid Kelas XII','Permohonan Surat Keterangan Lulus','letters/seed/surat_keluar_draft.pdf','Draft','2026-04-18 06:02:11','2026-04-18 06:02:11'),(2,'002/SK/III/2026',NULL,3,2026,'Incoming','000','Orang Tua/Wali Murid Kelas XII','Permohonan Surat Keterangan Lulus','letters/seed/surat_masuk_draft.pdf','Draft','2026-04-18 06:02:11','2026-04-18 06:02:11'),(3,NULL,'001/SM/III/2026',1,2026,'Incoming','000','Dinas Pendidikan Provinsi Jawa Timur','Undangan Rapat Koordinasi Kurikulum Merdeka','letters/seed/surat_masuk_1.pdf','Received','2026-04-18 06:02:11','2026-04-18 06:02:11'),(4,NULL,'001/SM/III/2026',1,2026,'Incoming','000','Dinas Pendidikan Provinsi Jawa Timur','Undangan Rapat Koordinasi Kurikulum Merdeka','letters/seed/surat_masuk_1.pdf','Dispatched','2026-04-18 06:02:11','2026-04-18 06:02:11'),(5,'002/SK/III/2026',NULL,2,2026,'Outgoing','000','Orang Tua/Wali Murid Kelas XII','Pemberitahuan Pelaksanaan Ujian Satuan Pendidikan','letters/seed/surat_keluar_draft.pdf','Draft','2026-04-18 06:02:11','2026-04-18 06:02:11'),(6,'003/SK/III/2026',NULL,3,2026,'Outgoing','000','PT. Industri Kreatif Sejahtera','Permohonan Kerjasama Magang (Prakerin)','letters/seed/surat_review.pdf','Reviewing','2026-04-18 06:02:11','2026-04-18 06:02:11'),(7,'004/SK/III/2026',NULL,4,2026,'Outgoing','000','Kepala Desa Sukomulyo','Izin Kegiatan Bakti Sosial Siswa','letters/seed/surat_siap_ttd.pdf','Validated','2026-04-18 06:02:11','2026-04-18 06:02:11'),(8,'004/SK/III/2026',NULL,4,2026,'Outgoing','000','Kepala Desa Sukomulyo','Izin Kegiatan Bakti Sosial Siswa','letters/seed/surat_siap_ttd.pdf','Completed','2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `letters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_25_005736_create_classifications_table',1),(5,'2026_02_25_005849_create_letters_table',1),(6,'2026_02_25_010222_create_dispositions_table',1),(7,'2026_02_25_084643_create_attachments_table',1),(8,'2026_03_05_003525_create_letter_validate_table',1),(9,'2026_03_08_135748_create_letter_requests_table',1),(10,'2026_03_09_052159_letter_request_attachments_table',1),(11,'2026_04_06_062103_create_letter_templates_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Ka TU','Staf TU','Waka','Kepala Sekolah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fuad','kepsek','Kepala Sekolah','$2y$12$5FCxHfriOv17cxEHeEjrleO3.PrDRoz5fV2iVy7gHAaPOUVfN4zQq',NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11'),(2,'Rahma','waka_kurikulum','Waka','$2y$12$TYmScUXjppGVSc9Lk4V2UedCRMMM.0P23yaadrhWi9F2mI2.ClvJO',NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11'),(3,'Hambali','waka_kesiswaan','Waka','$2y$12$cp53kq5VlKJLofIeT3nAI.nxSYiYD3Nx6LHlR510UMrjXlVkB2m.a',NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11'),(4,'Ratna','katu','Ka TU','$2y$12$1XSApkrYAol2EkEkp0.Nf.Tlyl9dpC3tYptXujnJpTSNoocV7Ak3K',NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11'),(5,'TU1','tu1','Staf TU','$2y$12$KuEHagSiQIJ8aVYYNMCty.LSuYJPf8YaQ4mbNh/AJyHMp9QakuWgu',NULL,'2026-04-18 06:02:11','2026-04-18 06:02:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-19  8:41:57
