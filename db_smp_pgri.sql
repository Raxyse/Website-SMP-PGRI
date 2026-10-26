-- ============================================================
--  Database : db_smp_pgri
--  Website  : SMP PGRI 1 Karang Tengah
--  Cocok untuk : MySQL 5.7 / 8.x dan MariaDB (XAMPP, Laragon, WAMP)
--
--  Aman dijalankan berulang kali: tabel yang sudah ada TIDAK
--  dihapus dan data lama TIDAK ditimpa.
--
--  Login admin bawaan : username = admin | password = admin123
-- ============================================================

CREATE DATABASE IF NOT EXISTS `db_smp_pgri`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `db_smp_pgri`;

-- ------------------------------------------------------------
-- 1. admin  (login panel admin.php)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `id`       INT           NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50)  NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_admin_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 2. berita  (index.php, berita.php)
--    tanggal disimpan sebagai teks, contoh: "28 September 2026"
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `berita` (
  `id`       INT           NOT NULL AUTO_INCREMENT,
  `judul`    VARCHAR(255) NOT NULL,
  `kategori` VARCHAR(50)  NOT NULL,          -- Akademik / Kegiatan / Pengumuman Umum
  `gambar`   VARCHAR(255) NOT NULL,          -- nama file di folder uploads/
  `isi`      TEXT         NOT NULL,
  `tanggal`  VARCHAR(30)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 3. galeri  (galeri.php)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `galeri` (
  `id`         INT           NOT NULL AUTO_INCREMENT,
  `url_foto`   VARCHAR(255) NOT NULL,        -- nama file di folder uploads/
  `keterangan` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 4. jadwal_ujian  (informasi.php)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jadwal_ujian` (
  `id`             INT           NOT NULL AUTO_INCREMENT,
  `jenis_ujian`    VARCHAR(100) NOT NULL,    -- contoh: UTS Ganjil 2026
  `kelas`          VARCHAR(20)  NOT NULL,    -- Kelas 7 / Kelas 8 / Kelas 9
  `hari_tanggal`   VARCHAR(100) NOT NULL,    -- contoh: Senin, 5 Oktober 2026
  `jam`            VARCHAR(50)  NOT NULL,
  `mata_pelajaran` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 5. prestasi  (informasi.php - Siswa Berprestasi)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `prestasi` (
  `id`               INT           NOT NULL AUTO_INCREMENT,
  `nama_siswa`       VARCHAR(100) NOT NULL,
  `tingkat_prestasi` VARCHAR(150) NOT NULL,
  `tahun`            VARCHAR(20)  NOT NULL,
  `foto`             VARCHAR(255) NOT NULL,  -- nama file di folder uploads/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 6. guru  (profil.php - Dewan Guru)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `guru` (
  `id`    INT           NOT NULL AUTO_INCREMENT,
  `nama`  VARCHAR(100) NOT NULL,
  `mapel` VARCHAR(100) NOT NULL,
  `foto`  VARCHAR(255) NOT NULL,             -- nama file di folder uploads/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 7. ekstrakurikuler  (profil.php)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ekstrakurikuler` (
  `id`          INT           NOT NULL AUTO_INCREMENT,
  `nama_ekskul` VARCHAR(100) NOT NULL,
  `pembina`     VARCHAR(100) NOT NULL,
  `jadwal`      VARCHAR(100) NOT NULL,
  `deskripsi`   TEXT         NOT NULL,
  `foto`        VARCHAR(255) NOT NULL,       -- nama file di folder uploads/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 8. ppdb  (ppdb.php -> dilihat di admin.php)
--    tanggal_daftar disimpan sebagai teks, contoh: "28-09-2026"
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ppdb` (
  `id`             INT           NOT NULL AUTO_INCREMENT,
  `nama_lengkap`   VARCHAR(100) NOT NULL,
  `jenis_kelamin`  VARCHAR(20)  NOT NULL,    -- Laki-laki / Perempuan
  `asal_sekolah`   VARCHAR(100) NOT NULL,
  `no_telp`        VARCHAR(25)  NOT NULL,
  `alamat`         TEXT         NOT NULL,
  `tanggal_daftar` VARCHAR(20)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- 9. pesan  (kontak.php -> dilihat di admin.php)
--    tanggal disimpan sebagai teks, contoh: "28-09-2026"
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pesan` (
  `id`      INT           NOT NULL AUTO_INCREMENT,
  `nama`    VARCHAR(100) NOT NULL,
  `email`   VARCHAR(100) NOT NULL,
  `pesan`   TEXT         NOT NULL,
  `tanggal` VARCHAR(20)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Akun admin awal (hanya dibuat jika belum ada).
-- Password disimpan apa adanya karena admin.php membandingkan
-- password secara langsung. Ganti setelah login pertama.
-- ------------------------------------------------------------
INSERT INTO `admin` (`username`, `password`)
SELECT 'admin', 'admin123' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `admin` WHERE `username` = 'admin');
