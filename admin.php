<?php
include 'koneksi.php';
session_start();

// Proses Login Admin
$errorLogin = false;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        header("Location: admin.php?tab=tab-jadwal");
        exit;
    } else {
        $errorLogin = true;
    }
}

// Proses Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// --- PROSES JADWAL UJIAN ---
if (isset($_POST['tambah_jadwal'])) {
    $jenis_ujian    = mysqli_real_escape_string($koneksi, $_POST['jenis_ujian']);
    $daftar_kelas   = $_POST['kelas'] ?? []; 
    $hari_tanggal   = mysqli_real_escape_string($koneksi, $_POST['hari_tanggal']);
    $jam            = mysqli_real_escape_string($koneksi, $_POST['jam']);
    $mata_pelajaran = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);

    if (!empty($daftar_kelas)) {
        foreach ($daftar_kelas as $kls) {
            $kelas_aman = mysqli_real_escape_string($koneksi, $kls);
            mysqli_query($koneksi, "INSERT INTO jadwal_ujian (jenis_ujian, kelas, hari_tanggal, jam, mata_pelajaran) VALUES ('$jenis_ujian', '$kelas_aman', '$hari_tanggal', '$jam', '$mata_pelajaran')");
        }
    }
    header("Location: admin.php?tab=tab-jadwal");
    exit;
}

if (isset($_GET['hapus_jadwal'])) {
    $id = intval($_GET['hapus_jadwal']);
    mysqli_query($koneksi, "DELETE FROM jadwal_ujian WHERE id = $id");
    header("Location: admin.php?tab=tab-jadwal");
    exit;
}

// Proses Hapus SEMUA Jadwal Ujian Sekaligus
if (isset($_GET['hapus_semua_jadwal'])) {
    mysqli_query($koneksi, "DELETE FROM jadwal_ujian");
    header("Location: admin.php?tab=tab-jadwal");
    exit;
}

// --- PROSES SISWA BERPRESTASI ---
if (isset($_POST['tambah_prestasi'])) {
    $nama_siswa       = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $tingkat_prestasi = mysqli_real_escape_string($koneksi, $_POST['tingkat_prestasi']);
    $tahun            = mysqli_real_escape_string($koneksi, $_POST['tahun']);

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    if ($error === 0) {
        $namaFileBaru = uniqid() . '_' . $namaFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        mysqli_query($koneksi, "INSERT INTO prestasi (nama_siswa, tingkat_prestasi, tahun, foto) VALUES ('$nama_siswa', '$tingkat_prestasi', '$tahun', '$namaFileBaru')");
    }
    header("Location: admin.php?tab=tab-prestasi");
    exit;
}

if (isset($_GET['hapus_prestasi'])) {
    $id = intval($_GET['hapus_prestasi']);
    $data = mysqli_query($koneksi, "SELECT * FROM prestasi WHERE id = $id");
    $row = mysqli_fetch_assoc($data);
    if(file_exists('uploads/' . $row['foto'])) {
        unlink('uploads/' . $row['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM prestasi WHERE id = $id");
    header("Location: admin.php?tab=tab-prestasi");
    exit;
}

// Proses Hapus Pendaftar PPDB
if (isset($_GET['hapus_ppdb'])) {
    $id = intval($_GET['hapus_ppdb']);
    mysqli_query($koneksi, "DELETE FROM ppdb WHERE id = $id");
    header("Location: admin.php?tab=tab-ppdb");
    exit();
}

// --- PROSES GURU ---
if (isset($_POST['tambah_guru'])) {
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    if ($error === 0) {
        $namaFileBaru = uniqid() . '_' . $namaFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        mysqli_query($koneksi, "INSERT INTO guru (nama, mapel, foto) VALUES ('$nama', '$mapel', '$namaFileBaru')");
    }
    header("Location: admin.php?tab=tab-guru");
    exit;
}

if (isset($_GET['hapus_guru'])) {
    $id = intval($_GET['hapus_guru']);
    $data = mysqli_query($koneksi, "SELECT * FROM guru WHERE id = $id");
    $row = mysqli_fetch_assoc($data);
    if(file_exists('uploads/' . $row['foto'])) {
        unlink('uploads/' . $row['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM guru WHERE id = $id");
    header("Location: admin.php?tab=tab-guru");
    exit;
}

// --- PROSES EKSTRAKURIKULER ---
if (isset($_POST['tambah_ekskul'])) {
    $nama_ekskul = mysqli_real_escape_string($koneksi, $_POST['nama_ekskul']);
    $pembina     = mysqli_real_escape_string($koneksi, $_POST['pembina']);
    $jadwal      = mysqli_real_escape_string($koneksi, $_POST['jadwal']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    if ($error === 0) {
        $namaFileBaru = uniqid() . '_' . $namaFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        mysqli_query($koneksi, "INSERT INTO ekstrakurikuler (nama_ekskul, pembina, jadwal, deskripsi, foto) VALUES ('$nama_ekskul', '$pembina', '$jadwal', '$deskripsi', '$namaFileBaru')");
    }
    header("Location: admin.php?tab=tab-ekskul");
    exit;
}

if (isset($_GET['hapus_ekskul'])) {
    $id = intval($_GET['hapus_ekskul']);
    $data = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler WHERE id = $id");
    $row = mysqli_fetch_assoc($data);
    if(file_exists('uploads/' . $row['foto'])) {
        unlink('uploads/' . $row['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM ekstrakurikuler WHERE id = $id");
    header("Location: admin.php?tab=tab-ekskul");
    exit;
}

// Proses Tambah Berita
if (isset($_POST['tambah_berita'])) {
    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tanggal  = date('d F Y');

    $namaFile = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 0) {
        $namaFileBaru = uniqid() . '_' . $namaFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        mysqli_query($koneksi, "INSERT INTO berita (judul, kategori, gambar, isi, tanggal) VALUES ('$judul', '$kategori', '$namaFileBaru', '$isi', '$tanggal')");
    }
    header("Location: admin.php?tab=tab-berita");
    exit;
}

// Proses Hapus Berita
if (isset($_GET['hapus_berita'])) {
    $id = $_GET['hapus_berita'];
    $data = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");
    $row = mysqli_fetch_assoc($data);
    if(file_exists('uploads/' . $row['gambar'])) {
        unlink('uploads/' . $row['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM berita WHERE id = $id");
    header("Location: admin.php?tab=tab-berita");
    exit;
}

// Proses Tambah Galeri
if (isset($_POST['tambah_galeri'])) {
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $namaFile = $_FILES['url_foto']['name'];
    $tmpName = $_FILES['url_foto']['tmp_name'];
    $error = $_FILES['url_foto']['error'];

    if ($error === 0) {
        $namaFileBaru = uniqid() . '_' . $namaFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        mysqli_query($koneksi, "INSERT INTO galeri (url_foto, keterangan) VALUES ('$namaFileBaru', '$keterangan')");
    }
    header("Location: admin.php?tab=tab-galeri");
    exit;
}

// Proses Hapus Galeri
if (isset($_GET['hapus_galeri'])) {
    $id = $_GET['hapus_galeri'];
    $data = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id = $id");
    $row = mysqli_fetch_assoc($data);
    if(file_exists('uploads/' . $row['url_foto'])) {
        unlink('uploads/' . $row['url_foto']);
    }

    mysqli_query($koneksi, "DELETE FROM galeri WHERE id = $id");
    header("Location: admin.php?tab=tab-galeri");
    exit;
}

// Proses Hapus Pesan Masuk
if (isset($_GET['hapus_pesan'])) {
    $id = intval($_GET['hapus_pesan']);
    mysqli_query($koneksi, "DELETE FROM pesan WHERE id = $id");
    header("Location: admin.php?tab=tab-pesan");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-section { display: none; }
        .admin-section.active { display: block; }
        .sidebar { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .sidebar ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .sidebar a { display: block; padding: 10px; background: var(--bg-light); color: var(--primary-color); border-radius: 5px; text-decoration: none; font-weight: bold; cursor: pointer; }
        .sidebar a:hover, .sidebar a.active { background: var(--primary-color); color: var(--white); }
        .checkbox-group { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; background: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-top: 5px; }
        .checkbox-group label { font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 5px; }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbfx-mne0-NFAeNE-uqxEMmyKJIf4fQGCqKpfh7fRCRQ&s" alt="Logo SMP PGRI 1 Karang Tengah">
                <div>
                    <h1>SMP PGRI 1 KARANG TENGAH</h1>
                    <span>Panel Administrator Utama</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Kembali ke Web</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <!-- Kotak Login Admin -->
        <div id="loginBox" style="max-width: 400px; margin: 50px auto; background: var(--white); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); <?php if(isset($_SESSION['login'])) echo 'display:none;'; ?>">
            <h2 style="color: var(--primary-color); margin-bottom: 20px; text-align: center;">Login Admin</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn" style="width:100%; border:none; cursor:pointer;">Masuk Dashboard</button>
                <?php if($errorLogin) : ?>
                    <p style="color: red; margin-top: 10px; text-align: center;">Username atau Password salah!</p>
                <?php endif; ?>
            </form>
        </div>

        <!-- Dashboard Admin -->
        <div id="dashboardAdmin" style="<?php if(!isset($_SESSION['login'])) echo 'display: none;'; ?>">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>Selamat Datang, Administrator</h2>
                <a href="admin.php?logout=true" class="btn" style="background: #d90429; color: white; text-decoration: none;">Logout</a>
            </div>

            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 30px;">
                <div class="sidebar">
                    <ul>
                        <li><a onclick="bukaTab(event, 'tab-ppdb')" id="link-tab-ppdb" class="tab-link">Data Pendaftar PPDB</a></li>
                        <li><a onclick="bukaTab(event, 'tab-jadwal')" id="link-tab-jadwal" class="tab-link">Jadwal UTS/UAS</a></li>
                        <li><a onclick="bukaTab(event, 'tab-prestasi')" id="link-tab-prestasi" class="tab-link">Siswa Berprestasi</a></li>
                        <li><a onclick="bukaTab(event, 'tab-berita')" id="link-tab-berita" class="tab-link">Kelola Berita</a></li>
                        <li><a onclick="bukaTab(event, 'tab-galeri')" id="link-tab-galeri" class="tab-link">Kelola Galeri</a></li>
                        <li><a onclick="bukaTab(event, 'tab-guru')" id="link-tab-guru" class="tab-link">Kelola Guru</a></li>
                        <li><a onclick="bukaTab(event, 'tab-ekskul')" id="link-tab-ekskul" class="tab-link">Kelola Ekstrakurikuler</a></li>
                        <li><a onclick="bukaTab(event, 'tab-pesan')" id="link-tab-pesan" class="tab-link">Pesan Masuk</a></li>
                    </ul>
                </div>

                <!-- TAB PPDB -->
                <div id="tab-ppdb" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Data Siswa Pendaftar PPDB Online</h3>
                    <div style="overflow-x: auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tgl Daftar</th>
                                    <th>Nama Lengkap</th>
                                    <th>NISN</th>
                                    <th>L/P</th>
                                    <th>TTL</th>
                                    <th>Agama</th>
                                    <th>Asal Sekolah</th>
                                    <th>Ayah / Ibu</th>
                                    <th>No. Telp / WA</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ppdb = mysqli_query($koneksi, "SELECT * FROM ppdb ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($ppdb)) {
                                    echo "<tr>
                                        <td>{$row['tanggal_daftar']}</td>
                                        <td><b>{$row['nama_lengkap']}</b></td>
                                        <td>{$row['nisn']}</td>
                                        <td>{$row['jenis_kelamin']}</td>
                                        <td>{$row['ttl']}</td>
                                        <td>{$row['agama']}</td>
                                        <td>{$row['asal_sekolah']}</td>
                                        <td>{$row['nama_ayah']} / {$row['nama_ibu']}</td>
                                        <td>{$row['no_telp']}</td>
                                        <td>{$row['alamat']}</td>
                                        <td><a href='admin.php?hapus_ppdb={$row['id']}&tab=tab-ppdb' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus data pendaftar ini?\")'>Hapus</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB JADWAL UJIAN -->
                <div id="tab-jadwal" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Tambah Jadwal Ujian (UTS / UAS)</h3>
                    <form action="" method="POST" style="margin-bottom: 30px;">
                        <div class="form-group">
                            <label>Jenis Ujian</label>
                            <input type="text" name="jenis_ujian" class="form-control" placeholder="Contoh: UTS Ganjil 2026/2027" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Pilih Kelas (Bisa centang lebih dari satu sekaligus)</label>
                            <div class="checkbox-group">
                                <label><input type="checkbox" name="kelas[]" value="7A"> 7A</label>
                                <label><input type="checkbox" name="kelas[]" value="7B"> 7B</label>
                                <label><input type="checkbox" name="kelas[]" value="7C"> 7C</label>
                                <label><input type="checkbox" name="kelas[]" value="7D"> 7D</label>
                                <label><input type="checkbox" name="kelas[]" value="8A"> 8A</label>
                                <label><input type="checkbox" name="kelas[]" value="8B"> 8B</label>
                                <label><input type="checkbox" name="kelas[]" value="8C"> 8C</label>
                                <label><input type="checkbox" name="kelas[]" value="8D"> 8D</label>
                                <label><input type="checkbox" name="kelas[]" value="9A"> 9A</label>
                                <label><input type="checkbox" name="kelas[]" value="9B"> 9B</label>
                                <label><input type="checkbox" name="kelas[]" value="9C"> 9C</label>
                                <label><input type="checkbox" name="kelas[]" value="9D"> 9D</label>
                            </div>
                        </div>

                        <!-- Dropdown Hari / Tanggal -->
                        <div class="form-group">
                            <label>Hari / Tanggal Ujian</label>
                            <select name="hari_tanggal" class="form-control" required>
                                <option value="">-- Pilih Hari & Tanggal --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        <!-- Dropdown Jam Ujian -->
                        <div class="form-group">
                            <label>Jam Ujian</label>
                            <select name="jam" class="form-control" required>
                                <option value="">-- Pilih Jam Ujian --</option>
                                <option value="07:30 - 09:00 WIB">07:30 - 09:00 WIB (Sesi 1)</option>
                                <option value="09:30 - 11:00 WIB">09:30 - 11:00 WIB (Sesi 2)</option>
                                <option value="07:30 - 09:30 WIB">07:30 - 09:30 WIB</option>
                            </select>
                        </div>

                        <!-- Dropdown Mata Pelajaran -->
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-control" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                <option value="Pendidikan Agama dan Budi Pekerti">Pendidikan Agama dan Budi Pekerti</option>
                                <option value="Pendidikan Pancasila dan Kewarganegaraan">Pendidikan Pancasila dan Kewarganegaraan</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Matematika">Matematika</option>
                                <option value="Ilmu Pengetahuan Alam (IPA)">Ilmu Pengetahuan Alam (IPA)</option>
                                <option value="Ilmu Pengetahuan Sosial (IPS)">Ilmu Pengetahuan Sosial (IPS)</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                                <option value="Seni Budaya">Seni Budaya</option>
                                <option value="Pendidikan Jasmani, Olahraga, dan Kesehatan">Pendidikan Jasmani, Olahraga, dan Kesehatan</option>
                                <option value="Prakarya">Prakarya</option>
                                <option value="Mulok / Bahasa Sunda">Mulok / Bahasa Sunda</option>
                            </select>
                        </div>

                        <button type="submit" name="tambah_jadwal" class="btn" style="border:none; cursor:pointer;">Simpan Jadwal</button>
                    </form>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <h3 style="color: var(--primary-color); margin: 0;">Daftar Jadwal Ujian Aktif</h3>
                        <a href="admin.php?hapus_semua_jadwal=true" class="btn" style="background: #d90429; color: white; padding: 6px 12px; font-size: 13px; text-decoration: none; border-radius: 4px;" onclick="return confirm('PERINGATAN: Apakah Anda yakin ingin MENGHAPUS SELURUH jadwal UTS/UAS? Tindakan ini tidak dapat dibatalkan!')">Hapus Semua Jadwal</a>
                    </div>

                    <table>
                        <thead><tr><th>Jenis</th><th>Kelas</th><th>Hari/Tanggal</th><th>Jam</th><th>Mapel</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php
                            $jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal_ujian ORDER BY id DESC");
                            while($row = mysqli_fetch_assoc($jadwal)) {
                                echo "<tr>
                                    <td>{$row['jenis_ujian']}</td>
                                    <td><b>{$row['kelas']}</b></td>
                                    <td>{$row['hari_tanggal']}</td>
                                    <td>{$row['jam']}</td>
                                    <td>{$row['mata_pelajaran']}</td>
                                    <td><a href='admin.php?hapus_jadwal={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus jadwal ini?\")'>Hapus</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- TAB SISWA BERPRESTASI -->
                <div id="tab-prestasi" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Tambah Data Siswa Berprestasi</h3>
                    <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tingkat / Bentuk Prestasi</label>
                            <input type="text" name="tingkat_prestasi" class="form-control" placeholder="Contoh: Juara 1 Olimpiade Matematika Tingkat Kota" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control" placeholder="2026" required>
                        </div>
                        <div class="form-group">
                            <label>Foto Siswa / Dokumentasi Lomba</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" name="tambah_prestasi" class="btn" style="border:none; cursor:pointer;">Simpan Prestasi</button>
                    </form>

                    <h3 style="color: var(--primary-color); margin-bottom: 10px;">Daftar Siswa Berprestasi</h3>
                    <table>
                        <thead><tr><th>Foto</th><th>Nama Siswa</th><th>Prestasi</th><th>Tahun</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php
                            $prestasi = mysqli_query($koneksi, "SELECT * FROM prestasi ORDER BY id DESC");
                            while($row = mysqli_fetch_assoc($prestasi)) {
                                echo "<tr>
                                    <td><img src='uploads/{$row['foto']}' width='60' style='border-radius:4px;'></td>
                                    <td><b>{$row['nama_siswa']}</b></td>
                                    <td>{$row['tingkat_prestasi']}</td>
                                    <td>{$row['tahun']}</td>
                                    <td><a href='admin.php?hapus_prestasi={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- TAB GURU -->
                <div id="tab-guru" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Tambah Data Guru</h3>
                    <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                        <div class="form-group">
                            <label>Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran / Jabatan</label>
                            <input type="text" name="mapel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Foto Guru</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" name="tambah_guru" class="btn" style="border:none; cursor:pointer;">Simpan Data Guru</button>
                    </form>

                    <h3 style="color: var(--primary-color); margin-bottom: 10px;">Daftar Dewan Guru</h3>
                    <table>
                        <thead><tr><th>Foto</th><th>Nama</th><th>Mata Pelajaran</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php
                            $guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY id DESC");
                            while($row = mysqli_fetch_assoc($guru)) {
                                echo "<tr>
                                    <td><img src='uploads/{$row['foto']}' width='50' style='border-radius:50%;'></td>
                                    <td><b>{$row['nama']}</b></td>
                                    <td>{$row['mapel']}</td>
                                    <td><a href='admin.php?hapus_guru={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus data guru ini?\")'>Hapus</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- TAB EKSTRAKURIKULER -->
                <div id="tab-ekskul" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Tambah Ekstrakurikuler</h3>
                    <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                        <div class="form-group">
                            <label>Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_ekskul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Pembina / Pelatih</label>
                            <input type="text" name="pembina" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jadwal Kegiatan</label>
                            <input type="text" name="jadwal" class="form-control" placeholder="Contoh: Setiap Jumat, 15:00 WIB" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Kegiatan Ekskul</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" name="tambah_ekskul" class="btn" style="border:none; cursor:pointer;">Simpan Ekstrakurikuler</button>
                    </form>

                    <h3 style="color: var(--primary-color); margin-bottom: 10px;">Daftar Ekstrakurikuler Aktif</h3>
                    <table>
                        <thead><tr><th>Foto</th><th>Nama Ekskul</th><th>Pembina</th><th>Jadwal</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php
                            $ekskul = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
                            while($row = mysqli_fetch_assoc($ekskul)) {
                                echo "<tr>
                                    <td><img src='uploads/{$row['foto']}' width='60' style='border-radius:4px;'></td>
                                    <td><b>{$row['nama_ekskul']}</b></td>
                                    <td>{$row['pembina']}</td>
                                    <td>{$row['jadwal']}</td>
                                    <td><a href='admin.php?hapus_ekskul={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus data ekskul ini?\")'>Hapus</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div>
                    <!-- TAB BERITA -->
                    <div id="tab-berita" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color); margin-bottom: 15px;">Tambah Berita / Pengumuman</h3>
                        <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="Akademik">Akademik</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Pengumuman Umum">Pengumuman Umum</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload Gambar Berita</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label>Isi Berita</label>
                                <textarea name="isi" class="form-control" required></textarea>
                            </div>
                            <button type="submit" name="tambah_berita" class="btn" style="border:none; cursor:pointer;">Posting Berita</button>
                        </form>

                        <h3 style="color: var(--primary-color); margin-bottom: 10px;">Daftar Berita Aktif</h3>
                        <table>
                            <thead><tr><th>Judul</th><th>Kategori</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php
                                $berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($berita)) {
                                    echo "<tr>
                                        <td>{$row['judul']}</td>
                                        <td>{$row['kategori']}</td>
                                        <td><a href='admin.php?hapus_berita={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus berita ini?\")'>Hapus</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- TAB GALERI -->
                    <div id="tab-galeri" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color); margin-bottom: 15px;">Upload Foto Galeri</h3>
                        <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                            <div class="form-group">
                                <label>Pilih File Foto</label>
                                <input type="file" name="url_foto" class="form-control" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan Foto</label>
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>
                            <button type="submit" name="tambah_galeri" class="btn" style="border:none; cursor:pointer;">Upload Foto</button>
                        </form>

                        <h3 style="color: var(--primary-color); margin-bottom: 10px;">Daftar Foto Galeri</h3>
                        <table>
                            <thead><tr><th>Preview</th><th>Keterangan</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php
                                $galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($galeri)) {
                                    echo "<tr>
                                        <td><img src='uploads/{$row['url_foto']}' width='60' style='border-radius:4px;'></td>
                                        <td>{$row['keterangan']}</td>
                                        <td><a href='admin.php?hapus_galeri={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus foto ini?\")'>Hapus</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- TAB PESAN MASUK -->
                    <div id="tab-pesan" class="admin-section" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                        <h3 style="color: var(--primary-color); margin-bottom: 15px;">Kotak Masuk Pesan Pengunjung</h3>
                        <table>
                            <thead><tr><th>Tanggal</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php
                                $pesan = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($pesan)) {
                                    echo "<tr>
                                        <td>{$row['tanggal']}</td>
                                        <td>{$row['nama']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['pesan']}</td>
                                        <td><a href='admin.php?hapus_pesan={$row['id']}' style='background:#d90429; color:white; padding:5px 10px; border-radius:3px; text-decoration:none;' onclick='return confirm(\"Yakin ingin menghapus pesan ini?\")'>Hapus</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script>
    function bukaTab(evt, namaTab) {
        const sections = document.querySelectorAll('.admin-section');
        sections.forEach(sec => sec.classList.remove('active'));

        const links = document.querySelectorAll('.tab-link');
        links.forEach(link => link.classList.remove('active'));

        document.getElementById(namaTab).classList.add('active');
        if(evt) {
            evt.currentTarget.classList.add('active');
        } else {
            const activeLink = document.getElementById('link-' + namaTab);
            if(activeLink) activeLink.classList.add('active');
        }
    }

    // Otomatis membuka tab yang sesuai berdasarkan parameter URL saat halaman direfresh/disubmit
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');
        if (tabParam) {
            bukaTab(null, tabParam);
        } else {
            // Default tab pertama kali dibuka (misal tab berita atau ppdb)
            bukaTab(null, 'tab-berita');
        }
    };
    </script>
</body>
</html>