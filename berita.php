<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - SMP PGRI 1 Karang Tengah</title>
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
                    <span>Pusat Berita & Pengumuman</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php" class="active">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Berita & Pengumuman Sekolah</h2>
        
        <div style="margin-bottom: 30px; display: flex; gap: 10px; justify-content: center;">
            <button onclick="filterBerita('semua')" class="btn" style="cursor:pointer; border:none;">Semua</button>
            <button onclick="filterBerita('Akademik')" class="btn" style="cursor:pointer; border:none; background:#ddd;">Akademik</button>
            <button onclick="filterBerita('Kegiatan')" class="btn" style="cursor:pointer; border:none; background:#ddd;">Kegiatan</button>
            <button onclick="filterBerita('Pengumuman Umum')" class="btn" style="cursor:pointer; border:none; background:#ddd;">Pengumuman Umum</button>
        </div>

        <?php
        include 'koneksi.php';
        ?>

        <!-- Bagian dalam container grid berita (Dinamis dari Database) -->
        <div class="grid-3" id="listBeritaPublik">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
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
    </div>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>