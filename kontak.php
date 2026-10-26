<?php
include 'koneksi.php';

$notif = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pesan   = mysqli_real_escape_string($koneksi, $_POST['pesan']);
    $tanggal = date('d-m-Y');

    $query = "INSERT INTO pesan (nama, email, pesan, tanggal) VALUES ('$nama', '$email', '$pesan', '$tanggal')";
    if (mysqli_query($koneksi, $query)) {
        $notif = "Pesan berhasil dikirim ke database Admin!";
    } else {
        $notif = "Gagal mengirim pesan: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbfx-mne0-NFAeNE-uqxEMmyKJIf4fQGCqKpfh7fRCRQ&s" alt="Logo SMP PGRI 1 Karang Tengah">
                <div>
                    <h1>SMP PGRI 1 KARANG TENGAH</h1>
                    <span>Kontak & Lokasi Sekolah</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php" class="active">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Hubungi Kami</h2>
        
        <div class="grid-3" style="grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <div style="background: var(--white); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <h3 style="color: var(--primary-color); margin-bottom: 15px;">Informasi Kontak</h3>
                    <p><strong>Alamat:</strong> Jl. KH. Hasyim Ashari No. 12, Karang Tengah, Kota Tangerang</p>
                    <p style="margin-top: 10px;"><strong>No. Telepon:</strong> (021) 55789123</p>
                    <p style="margin-top: 10px;"><strong>Email:</strong> info@smppgri1karangtengah.sch.id</p>
                </div>
                <div style="background: var(--white); padding: 10px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.7011!3d-6.1944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTAnNDAuOCJTIDEwNsKwNDInMDQuMCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid" width="100%" height="250" style="border:0; border-radius: 6px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div style="background: var(--white); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">Kirim Pesan / Saran</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Pengunjung</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" name="pesan" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn" style="border:none; cursor:pointer; width:100%;">Kirim Pesan</button>
                </form>

                <!-- Menampilkan notif dari PHP secara dinamis -->
                <?php if($notif != "") { echo '<p style="margin-top: 15px; color: green; font-weight: bold;">'.$notif.'</p>'; } ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>