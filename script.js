// Filter Berita Publik
function filterBerita(kategori) {
    const cards = document.querySelectorAll('#listBeritaPublik .card');
    cards.forEach(card => {
        if(kategori === 'semua' || card.getAttribute('data-kategori') === kategori) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Load Data LocalStorage saat Halaman Dimuat
window.addEventListener('DOMContentLoaded', () => {
    // Berita
    const savedBerita = JSON.parse(localStorage.getItem('pkm_berita')) || [];
    const containerBerita = document.getElementById('listBeritaPublik');
    if(containerBerita) {
        savedBerita.forEach(item => {
            const card = document.createElement('div');
            card.className = 'card';
            card.setAttribute('data-kategori', item.kategori);
            card.innerHTML = `
                <img src="${item.gambar || 'https://via.placeholder.com/300'}" alt="Berita">
                <div class="card-body">
                    <span class="meta">${item.tanggal} | ${item.kategori}</span>
                    <h3>${item.judul}</h3>
                    <p>${item.isi}</p>
                </div>
            `;
            containerBerita.prepend(card);
        });
    }

    // Galeri
    const savedGaleri = JSON.parse(localStorage.getItem('pkm_galeri')) || [];
    const containerGaleri = document.getElementById('listGaleriPublik');
    if(containerGaleri) {
        savedGaleri.forEach(item => {
            const div = document.createElement('div');
            div.className = 'gallery-item';
            div.innerHTML = `<img src="${item.url}" alt="${item.keterangan}">`;
            containerGaleri.prepend(div);
        });
    }

    cekLoginStatus();
});

// Form Kontak
const formKontak = document.getElementById('formKontak');
if(formKontak) {
    formKontak.addEventListener('submit', function(e) {
        e.preventDefault();
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const pesan = document.getElementById('pesan').value;
        const tanggal = new Date().toLocaleDateString('id-ID');

        let daftarPesan = JSON.parse(localStorage.getItem('pkm_pesan')) || [];
        daftarPesan.push({ nama, email, pesan, tanggal });
        localStorage.setItem('pkm_pesan', JSON.stringify(daftarPesan));

        const notif = document.getElementById('notifPesan');
        if(notif) {
            notif.style.display = 'block';
            setTimeout(() => { notif.style.display = 'none'; }, 4000);
        }
        this.reset();
    });
}

// Panel Admin - Login
const formLogin = document.getElementById('formLogin');
if(formLogin) {
    formLogin.addEventListener('submit', function(e) {
        e.preventDefault();
        const u = document.getElementById('userAdmin').value;
        const p = document.getElementById('passAdmin').value;

        if(u === 'admin' && p === 'admin123') {
            localStorage.setItem('pkm_logged', 'true');
            cekLoginStatus();
        } else {
            const err = document.getElementById('errorLogin');
            if(err) err.style.display = 'block';
        }
    });
}

function cekLoginStatus() {
    const loginBox = document.getElementById('loginBox');
    const dashboardAdmin = document.getElementById('dashboardAdmin');
    
    if(loginBox && dashboardAdmin) {
        if(localStorage.getItem('pkm_logged') === 'true') {
            loginBox.style.display = 'none';
            dashboardAdmin.style.display = 'block';
            loadAdminData();
        } else {
            loginBox.style.display = 'block';
            dashboardAdmin.style.display = 'none';
        }
    }
}

function logoutAdmin() {
    localStorage.removeItem('pkm_logged');
    cekLoginStatus();
}

function switchTab(tabName) {
    document.querySelectorAll('.admin-section').forEach(sec => sec.classList.remove('active'));
    document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
    
    const targetTab = document.getElementById('tab-' + tabName);
    if(targetTab) targetTab.classList.add('active');
    if(event && event.target) event.target.classList.add('active');
}

// Tambah Berita Admin
const formTambahBerita = document.getElementById('formTambahBerita');
if(formTambahBerita) {
    formTambahBerita.addEventListener('submit', function(e) {
        e.preventDefault();
        const judul = document.getElementById('judulBerita').value;
        const kategori = document.getElementById('kategoriBerita').value;
        const gambar = document.getElementById('gambarBerita').value;
        const isi = document.getElementById('isiBerita').value;
        const tanggal = new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});

        let berita = JSON.parse(localStorage.getItem('pkm_berita')) || [];
        berita.push({ judul, kategori, gambar, isi, tanggal });
        localStorage.setItem('pkm_berita', JSON.stringify(berita));

        this.reset();
        loadAdminData();
        alert('Berita berhasil diposting!');
    });
}

// Tambah Galeri Admin
const formTambahGaleri = document.getElementById('formTambahGaleri');
if(formTambahGaleri) {
    formTambahGaleri.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = document.getElementById('urlGaleri').value;
        const keterangan = document.getElementById('ketGaleri').value;

        let galeri = JSON.parse(localStorage.getItem('pkm_galeri')) || [];
        galeri.push({ url, keterangan });
        localStorage.setItem('pkm_galeri', JSON.stringify(galeri));

        this.reset();
        loadAdminData();
        alert('Foto galeri berhasil diupload!');
    });
}

function loadAdminData() {
    const listBerita = JSON.parse(localStorage.getItem('pkm_berita')) || [];
    const tbBerita = document.getElementById('tabelBeritaAdmin');
    if(tbBerita) {
        tbBerita.innerHTML = '';
        listBerita.forEach((item, index) => {
            tbBerita.innerHTML += `
                <tr>
                    <td>${item.judul}</td>
                    <td>${item.kategori}</td>
                    <td><button onclick="hapusBerita(${index})" style="background:#d90429; color:white; border:none; padding:5px 10px; border-radius:3px; cursor:pointer;">Hapus</button></td>
                </tr>
            `;
        });
    }

    const listGaleri = JSON.parse(localStorage.getItem('pkm_galeri')) || [];
    const tbGaleri = document.getElementById('tabelGaleriAdmin');
    if(tbGaleri) {
        tbGaleri.innerHTML = '';
        listGaleri.forEach((item, index) => {
            tbGaleri.innerHTML += `
                <tr>
                    <td><img src="${item.url}" width="60" style="border-radius:4px;"></td>
                    <td>${item.keterangan}</td>
                    <td><button onclick="hapusGaleri(${index})" style="background:#d90429; color:white; border:none; padding:5px 10px; border-radius:3px; cursor:pointer;">Hapus</button></td>
                </tr>
            `;
        });
    }

    const listPesan = JSON.parse(localStorage.getItem('pkm_pesan')) || [];
    const tbPesan = document.getElementById('tabelPesanAdmin');
    if(tbPesan) {
        tbPesan.innerHTML = '';
        listPesan.forEach(item => {
            tbPesan.innerHTML += `
                <tr>
                    <td>${item.tanggal}</td>
                    <td>${item.nama}</td>
                    <td>${item.email}</td>
                    <td>${item.pesan}</td>
                </tr>
            `;
        });
    }
}

function hapusBerita(index) {
    let listBerita = JSON.parse(localStorage.getItem('pkm_berita')) || [];
    listBerita.splice(index, 1);
    localStorage.setItem('pkm_berita', JSON.stringify(listBerita));
    loadAdminData();
}

function hapusGaleri(index) {
    let listGaleri = JSON.parse(localStorage.getItem('pkm_galeri')) || [];
    listGaleri.splice(index, 1);
    localStorage.setItem('pkm_galeri', JSON.stringify(listGaleri));
    loadAdminData();
}