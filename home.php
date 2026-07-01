<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayat Firman Harian</title>
    <!-- Tambahan ?v=3 ini trik agar HP kamu dipaksa membaca CSS yang baru -->
    <link rel="stylesheet" href="style2.css?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- TOMBOL LONCENG DI HALAMAN KEDUA -->
    <a href="pemberitahuan.php" class="btn-top-right" title="Jadwal Komunitas">
        <i class="fa-solid fa-bell"></i>
    </a>

    <div class="container">

        <div class="header-section">
            <i class="fas fa-cross top-icon"></i>
            <h1>RHEMA FIRMAN HARIAN</h1>
            <p class="subtitle">Pilih warna yang menarik hatimu, dan temukan<br>ayat Firman untuk hari ini.</p>
            <div class="heart-divider">
                <span class="line"></span>
                <i class="fas fa-heart"></i>
                <span class="line"></span>
            </div>
        </div>

        <div class="main-card">

            <div class="warna-wrapper">
                <div class="warna-item" onclick="ambilAyat('merah')">
                    <div class="lingkaran bg-merah"><i class="fas fa-heart"></i></div>
                    <div class="teks-judul text-merah">MERAH</div>
                    <div class="teks-sub">Kasih</div>
                </div>
                <div class="warna-item" onclick="ambilAyat('biru')">
                    <div class="lingkaran bg-biru"><i class="fas fa-dove"></i></div>
                    <div class="teks-judul text-biru">BIRU</div>
                    <div class="teks-sub">Damai</div>
                </div>
                <div class="warna-item" onclick="ambilAyat('hijau')">
                    <div class="lingkaran bg-hijau"><i class="fas fa-seedling"></i></div>
                    <div class="teks-judul text-hijau">HIJAU</div>
                    <div class="teks-sub">Pertumbuhan</div>
                </div>
                <div class="warna-item" onclick="ambilAyat('kuning')">
                    <div class="lingkaran bg-kuning"><i class="fas fa-smile"></i></div>
                    <div class="teks-judul text-kuning">KUNING</div>
                    <div class="teks-sub">Sukacita</div>
                </div>
                <div class="warna-item" onclick="ambilAyat('ungu')">
                    <div class="lingkaran bg-ungu"><i class="fas fa-crown"></i></div>
                    <div class="teks-judul text-ungu">UNGU</div>
                    <div class="teks-sub">Kemuliaan</div>
                </div>
                <div class="warna-item" onclick="ambilAyat('putih')">
                    <div class="lingkaran bg-putih"><i class="fas fa-cross" style="color: #888;"></i></div>
                    <div class="teks-judul text-putih">PUTIH</div>
                    <div class="teks-sub">Pengampunan</div>
                </div>
            </div>

            <div class="box-ayat" id="boxAyat">

                <div id="tampilanKosong">
                    <i class="fas fa-book-open ornament-book"></i>
                    <p class="teks-kosong">Silakan sentuh warna di atas untuk menemukan firman harimu...</p>
                </div>

                <div id="tampilanIsi" style="display: none;">
                    <div class="ornament-top">
                        <span class="leaf-left">🌿</span>
                        <i class="fas fa-book-open"></i>
                        <span class="leaf-right">🌿</span>
                    </div>

                    <h2 id="judulAyat">YOHANES 3:16</h2>
                    <div class="quote-mark">❝</div>
                    <p id="teksAyat">Karena begitu besar kasih Allah akan dunia ini...</p>

                    <div class="action-buttons">
                        <button onclick="ambilAyatLagi()" class="btn-ayat-lain"><i class="fas fa-sync-alt"></i> AYAT LAIN</button>
                        <button onclick="hapusAyat()" class="btn-hapus"><i class="fas fa-trash"></i> HAPUS</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-text">
            <i class="far fa-heart"></i> Firman-Mu itu pelita bagi kakiku dan terang bagi jalanku. - Mazmur 119:105
        </div>

    </div>

    <script>
        let warnaAktif = "";

        function ambilAyat(warna) {
            warnaAktif = warna;
            prosesAmbilAyat();
        }

        function ambilAyatLagi() {
            if (warnaAktif !== "") {
                prosesAmbilAyat();
            }
        }

        function prosesAmbilAyat() {
            const box = document.getElementById("boxAyat");
            const tampilanKosong = document.getElementById("tampilanKosong");
            const tampilanIsi = document.getElementById("tampilanIsi");
            const judulAyat = document.getElementById("judulAyat");
            const teksAyat = document.getElementById("teksAyat");

            box.style.opacity = 0;

            setTimeout(() => {
                fetch("ambil_ayat.php?warna=" + warnaAktif)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "ok") {
                            let parts = data.ayat.split(' - ');
                            if (parts.length > 1) {
                                judulAyat.innerText = parts[0].toUpperCase();
                                teksAyat.innerText = parts.slice(1).join(' - ');
                            } else {
                                judulAyat.innerText = "FIRMAN TUHAN";
                                teksAyat.innerText = data.ayat;
                            }

                            tampilanKosong.style.display = "none";
                            tampilanIsi.style.display = "block";
                        } else {
                            judulAyat.innerText = "BELUM ADA AYAT";
                            teksAyat.innerText = data.ayat;
                            tampilanKosong.style.display = "none";
                            tampilanIsi.style.display = "block";
                        }
                        box.style.opacity = 1;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        box.style.opacity = 1;
                    });
            }, 300);
        }

        function hapusAyat() {
            const box = document.getElementById("boxAyat");
            box.style.opacity = 0;

            setTimeout(() => {
                document.getElementById("tampilanIsi").style.display = "none";
                document.getElementById("tampilanKosong").style.display = "block";
                warnaAktif = "";
                box.style.opacity = 1;
            }, 300);
        }
    </script>

</body>

</html>