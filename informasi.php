<?php
include 'koneksi.php';

// Ambil pilihan kelas dari form filter (jika ada yang dipilih)
$kelas_pilih = isset($_GET['kelas']) ? $_GET['kelas'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi & Jadwal Ujian - SMP PGRI 1 Karang Tengah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header & Navigasi Utama Website -->
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
                    <li><a href="informasi.php" class="active">Informasi</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="ppdb.php">PPDB Online</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container" style="padding: 40px 20px;">
        <h2 style="color: var(--primary-color); margin-bottom: 20px; text-align: center;">Jadwal Ujian (UTS / UAS)</h2>
        
        <!-- Form Filter Pilih Kelas -->
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px; text-align: center;">
            <form action="" method="GET" style="display: flex; gap: 10px; justify-content: center; align-items: center; flex-wrap: wrap;">
                <label for="kelas" style="font-weight: bold;">Pilih Kelas Anda:</label>
                <select name="kelas" id="kelas" class="form-control" style="max-width: 200px; display: inline-block;" required>
                    <option value="">-- Pilih Kelas --</option>
                    <optgroup label="Kelas 7">
                        <option value="7A" <?php if($kelas_pilih == '7A') echo 'selected'; ?>>7A</option>
                        <option value="7B" <?php if($kelas_pilih == '7B') echo 'selected'; ?>>7B</option>
                        <option value="7C" <?php if($kelas_pilih == '7C') echo 'selected'; ?>>7C</option>
                        <option value="7D" <?php if($kelas_pilih == '7D') echo 'selected'; ?>>7D</option>
                    </optgroup>
                    <optgroup label="Kelas 8">
                        <option value="8A" <?php if($kelas_pilih == '8A') echo 'selected'; ?>>8A</option>
                        <option value="8B" <?php if($kelas_pilih == '8B') echo 'selected'; ?>>8B</option>
                        <option value="8C" <?php if($kelas_pilih == '8C') echo 'selected'; ?>>8C</option>
                        <option value="8D" <?php if($kelas_pilih == '8D') echo 'selected'; ?>>8D</option>
                    </optgroup>
                    <optgroup label="Kelas 9">
                        <option value="9A" <?php if($kelas_pilih == '9A') echo 'selected'; ?>>9A</option>
                        <option value="9B" <?php if($kelas_pilih == '9B') echo 'selected'; ?>>9B</option>
                        <option value="9C" <?php if($kelas_pilih == '9C') echo 'selected'; ?>>9C</option>
                        <option value="9D" <?php if($kelas_pilih == '9D') echo 'selected'; ?>>9D</option>
                    </optgroup>
                </select>
                <button type="submit" class="btn" style="border: none; cursor: pointer; padding: 10px 20px;">Tampilkan Jadwal</button>
            </form>
        </div>

        <!-- Area Tabel Hasil Menampilkan Jadwal Berdasarkan Kelas -->
        <div style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <?php if($kelas_pilih != '') : ?>
                <h3 style="color: var(--primary-color); margin-bottom: 20px; border-bottom: 2px solid var(--primary-color); padding-bottom: 10px;">
                    Jadwal Ujian untuk Kelas: <?php echo htmlspecialchars($kelas_pilih); ?>
                </h3>
                
                <table>
                    <thead>
                        <tr>
                            <th>Jenis Ujian</th>
                            <th>Hari / Tanggal</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM jadwal_ujian WHERE kelas = '$kelas_pilih' ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$row['jenis_ujian']}</td>
                                    <td>{$row['hari_tanggal']}</td>
                                    <td>{$row['jam']}</td>
                                    <td><b>{$row['mata_pelajaran']}</b></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align: center; color: #777;'>Belum ada jadwal ujian yang diinputkan untuk kelas ini.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p style="text-align: center; color: #666; padding: 20px;">Silakan pilih kelas terlebih dahulu pada menu di atas untuk melihat jadwal ujian.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer Website -->
    <footer>
        <p>&copy; 2026 SMP PGRI 1 Karang Tengah | PKM Teknik Informatika Universitas Pamulang</p>
    </footer>
</body>
</html>