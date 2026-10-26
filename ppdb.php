<?php
include 'koneksi.php';
$sukses = false;

if (isset($_POST['daftar'])) {
    $tanggal_daftar  = date('d-m-Y');
    $nama_lengkap    = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nisn            = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $jenis_kelamin   = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $ttl             = mysqli_real_escape_string($koneksi, $_POST['ttl']);
    $agama           = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $asal_sekolah    = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $nama_ayah       = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $nama_ibu        = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $no_telp         = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $query = "INSERT INTO ppdb (tanggal_daftar, nama_lengkap, nisn, jenis_kelamin, ttl, agama, asal_sekolah, nama_ayah, nama_ibu, no_telp, alamat) 
              VALUES ('$tanggal_daftar', '$nama_lengkap', '$nisn', '$jenis_kelamin', '$ttl', '$agama', '$asal_sekolah', '$nama_ayah', '$nama_ibu', '$no_telp', '$alamat')";
    
    if (mysqli_query($koneksi, $query)) {
        $sukses = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Online - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header & Navigasi Utama -->
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbfx-mne0-NFAeNE-uqxEMmyKJIf4fQGCqKpfh7fRCRQ&s" alt="Logo SMP PGRI 1 Karang Tengah">
                <div>
                    <h1>SMP PGRI 1 KARANG TENGAH</h1>
                    <span>Pusat Informasi & Publikasi Digital</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php" class="active">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container" style="padding: 40px 20px; max-width: 800px;">
        <div style="background: #fff; padding: 35px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h2 style="color: var(--primary-color); margin-bottom: 10px; text-align: center;">Formulir Pendaftaran Siswa Baru (PPDB)</h2>
            <p style="text-align: center; color: #666; margin-bottom: 30px;">Silakan isi data diri calon peserta didik dengan lengkap dan benar.</p>

            <?php if($sukses): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; border: 1px solid #c3e6cb;">
                    <b>Pendaftaran Berhasil!</b> Terima kasih telah mendaftar di SMP PGRI 1 Karang Tengah. Data Anda telah tersimpan di sistem kami.
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <h3 style="color: var(--primary-color); font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom: 5px;">A. Data Calon Siswa</h3>
                
                <div class="form-group">
                    <label>Nama Lengkap (Sesuai Ijazah/Akta)</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" placeholder="Nomor Induk Siswa Nasional" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Tempat, Tanggal Lahir</label>
                        <input type="text" name="ttl" class="form-control" placeholder="Contoh: Tangerang, 12 Januari 2013" required>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" class="form-control" required>
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Asal Sekolah (SD / MI)</label>
                    <input type="text" name="asal_sekolah" class="form-control" placeholder="Contoh: SD Negeri Karang Tengah 1" required>
                </div>

                <h3 style="color: var(--primary-color); font-size: 18px; margin: 25px 0 15px 0; border-bottom: 2px solid #eee; padding-bottom: 5px;">B. Data Orang Tua / Wali & Kontak</h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Nama Ayah / Wali</label>
                        <input type="text" name="nama_ayah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon / WhatsApp Aktif</label>
                    <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap Tempat Tinggal</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" required></textarea>
                </div>

                <button type="submit" name="daftar" class="btn" style="width: 100%; border: none; cursor: pointer; padding: 12px; font-size: 16px; margin-top: 10px;">Kirim Pendaftaran Sekarang</button>
            </form>
        </div>
    </div>

    <!-- Footer Website -->
    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>
</body>
</html>