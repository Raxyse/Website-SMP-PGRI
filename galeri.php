<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMP PGRI 1 Karang Tengah</title>
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
                    <span>Galeri Kegiatan Sekolah</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php" class="active">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Galeri Foto Kegiatan</h2>
        
        <?php
        include 'koneksi.php';
        ?>

        <!-- Grid Galeri Dinamis dari Database -->
        <div class="gallery-grid" id="listGaleriPublik">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($query)) {
                echo '
                <div class="gallery-item">
                    <img src="uploads/'.$row['url_foto'].'" alt="'.$row['keterangan'].'">
                </div>';
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>