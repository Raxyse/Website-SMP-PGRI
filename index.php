<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Gambar ditampilkan utuh (tidak dipotong) dan kartu tidak melebar penuh saat datanya sedikit */
        .grid-3 { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
        .card > img:not([style]) { height: auto; max-height: 480px; object-fit: contain; display: block; background: #e6f3ff; }
        .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); align-items: start; }
        .gallery-item { height: auto; background: #ffffff; }
        .gallery-item img { height: auto; max-height: 480px; object-fit: contain; display: block; }
    </style>
</head>
<body>
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
                    <li><a href="index.php" class="active">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <h2>Selamat Datang di SMP PGRI 1 Karang Tengah</h2>
        <p>Mewujudkan Generasi Unggul, Berkarakter, Cerdas, dan Berwawasan Global.</p>
        <a href="profil.php" class="btn">Kenali Kami Lebih Dekat</a>
    </section>

    <div class="container">
        <section class="headmaster-section">
            <img src="" alt="Kepala Sekolah" class="headmaster-img">
            <div>
                <h2 style="color: var(--primary-color); margin-bottom: 15px;">Sambutan Kepala Sekolah</h2>
                <p>Assalamu'alaikum Wr. Wb.<br>Puji syukur ke hadirat Tuhan YME atas diluncurkannya website resmi SMP PGRI 1 Karang Tengah. Semoga media publikasi digital ini dapat meningkatkan transparansi informasi dan komunikasi yang baik antara sekolah, orang tua, dan masyarakat luas.<br><br>Wassalamu'alaikum Wr. Wb.<br><strong>Drs. H. Ahmad Fauzi, M.Pd.</strong></p>
            </div>
        </section>

        <section>
            <h2 class="section-title">Berita & Kegiatan Terbaru</h2>
            <div class="grid-3" id="listBeritaPublik">
                <?php
                include 'koneksi.php';
                // Menampilkan 3 berita terbaru dari database
                $query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC LIMIT 3");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '
                    <div class="card" data-kategori="'.$row['kategori'].'">
                        <img src="uploads/'.$row['gambar'].'" alt="Gambar Berita">
                        <div class="card-body">
                            <span class="meta">'.$row['tanggal'].' | '.$row['kategori'].'</span>
                            <h3>'.$row['judul'].'</h3>
                            <p>'.$row['isi'].'</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>