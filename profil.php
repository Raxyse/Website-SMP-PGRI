<?php
include 'koneksi.php'; // <--- Ini yang kurang di bagian atas file profil.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Gambar ditampilkan utuh (tidak dipotong) dan kartu tidak melebar penuh saat datanya sedikit */
        .grid-3 { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
        .card > img:not([style]) { height: auto; max-height: 480px; object-fit: contain; display: block; background: #e6f3ff; }
        .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); align-items: start; }
        .gallery-item { height: auto; background: #ffffff; }
        .gallery-item img { height: auto; max-height: 480px; object-fit: contain; display: block; }

        /* Dewan Guru: foto persegi panjang (portrait 4:5), lebih besar, tidak bulat */
        .grid-guru { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
        .grid-guru .guru-card { text-align: center; }
        .grid-guru .guru-card img.guru-foto {
            display: block; width: 100%; height: auto; max-height: none;
            aspect-ratio: 4 / 5; object-fit: cover; object-position: center 20%;
            border-radius: 0; margin: 0; background: #e6f3ff;
        }
        .grid-guru .guru-card .card-body { padding: 16px 12px 20px; }
        .grid-guru .guru-card h4 { color: var(--primary-color); font-size: 1.05rem; margin-bottom: 4px; }
        .grid-guru .guru-card p { font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbfx-mne0-NFAeNE-uqxEMmyKJIf4fQGCqKpfh7fRCRQ&s" alt="Logo SMP PGRI 1 Karang Tengah">
                <div>
                    <h1>SMP PGRI 1 KARANG TENGAH</h1>
                    <span>Profil & Informasi Lembaga</span>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php" class="active">Profil</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Profil Sekolah</h2>

        <section style="background: var(--white); padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Sejarah Singkat</h3>
            <p>SMP PGRI 1 Karang Tengah didirikan pada tahun 1985 di bawah naungan Yayasan Pembina Lembaga Pendidikan (YPLP) PGRI. Sekolah ini berkomitmen memberikan pendidikan berkualitas dan mencetak generasi berprestasi.</p>
        </section>

        <section style="background: var(--white); padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Visi & Misi</h3>
            <p><strong>Visi:</strong><br>Terwujudnya peserta didik yang cerdas, terampil, berlandaskan iman dan taqwa, serta berwawasan lingkungan.</p>
            <br>
            <p><strong>Misi:</strong></p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>Melaksanakan pembelajaran aktif, kreatif, efektif, dan menyenangkan.</li>
                <li>Menanamkan keimanan dan akhlak mulia dalam keseharian.</li>
                <li>Mengembangkan potensi bakat melalui kegiatan ekstrakurikuler.</li>
            </ul>
        </section>

        <section style="background: var(--white); padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Struktur Organisasi</h3>
            <table>
                <thead>
                    <tr><th>Jabatan</th><th>Nama Lengkap</th></tr>
                </thead>
                <tbody>
                    <tr><td>Kepala Sekolah</td><td>Drs. H. Ahmad Fauzi, M.Pd.</td></tr>
                    <tr><td>Wakil Kepala Kurikulum</td><td>Siti Rahmawati, S.Pd.</td></tr>
                    <tr><td>Wakil Kepala Kesiswaan</td><td>Budi Santoso, S.Pd.</td></tr>
                    <tr><td>Kepala Tata Usaha</td><td>Dewi Lestari, S.E.</td></tr>
                </tbody>
            </table>
        </section>

        <section>
            <h3 class="section-title" style="font-size: 1.5rem; text-align: left;">Fasilitas Sekolah</h3>
            <div class="grid-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=500&q=80" alt="Kelas">
                    <div class="card-body"><h3>Ruang Kelas</h3><p>Dilengkapi proyektor dan ventilasi nyaman.</p></div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=500&q=80" alt="Lab">
                    <div class="card-body"><h3>Lab Komputer</h3><p>PC terkoneksi internet untuk praktikum TIK & ANBK.</p></div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1576267423445-b2e0074d68a4?auto=format&fit=crop&w=500&q=80" alt="Perpus">
                    <div class="card-body"><h3>Perpustakaan</h3><p>Koleksi buku lengkap dan ruang baca kondusif.</p></div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bagian Tampilan Guru di Profil -->
    <section style="background: var(--white); padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h3 style="color: var(--primary-color); margin-bottom: 20px; text-align: center;">Dewan Guru & Staff Pengajar</h3>
        <div class="grid-guru">
            <?php
            $q_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY id DESC");
            while($g = mysqli_fetch_assoc($q_guru)) {
                echo '<div class="card guru-card">
                    <img src="uploads/'.$g['foto'].'" alt="'.$g['nama'].'" class="guru-foto">
                    <div class="card-body">
                        <h4>'.$g['nama'].'</h4>
                        <p>'.$g['mapel'].'</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>

    <!-- Bagian Tampilan Ekstrakurikuler di Profil -->
    <section style="background: var(--white); padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h3 style="color: var(--primary-color); margin-bottom: 20px; text-align: center;">Ekstrakurikuler Sekolah</h3>
        <div class="grid-3">
            <?php
            $q_ekskul = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
            while($e = mysqli_fetch_assoc($q_ekskul)) {
                echo '<div class="card">
                    <img src="uploads/'.$e['foto'].'" alt="'.$e['nama_ekskul'].'">
                    <div class="card-body">
                        <h3>'.$e['nama_ekskul'].'</h3>
                        <p><strong>Pembina:</strong> '.$e['pembina'].'</p>
                        <p><strong>Jadwal:</strong> '.$e['jadwal'].'</p>
                        <p style="margin-top:10px; font-size:0.9rem;">'.$e['deskripsi'].'</p>
                    </div>
                </div>';
            }
        ?>
    </div>
</section>

    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>