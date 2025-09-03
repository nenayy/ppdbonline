<?php include 'header.php'; ?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">PPDB Online SMP Negeri 1 Wanadadi</h1>
        <p class="col-md-8 fs-4">Selamat datang di sistem Penerimaan Peserta Didik Baru (PPDB) online SMP Negeri 1 Wanadadi. Silakan mendaftar atau cek status pendaftaran Anda.</p>
        <a href="daftar.php" class="btn btn-primary btn-lg">Daftar Sekarang</a>
        <a href="cek_pengumuman.php" class="btn btn-secondary btn-lg">Cek Pengumuman</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h2>Jadwal Pendaftaran</h2>
        <ul class="list-group">
            <li class="list-group-item">1 - 15 Juli 2025: Pendaftaran Online</li>
            <li class="list-group-item">16 - 17 Juli 2025: Verifikasi Dokumen</li>
            <li class="list-group-item">18 Juli 2025: Pengumuman Hasil Seleksi</li>
            <li class="list-group-item">20 - 21 Juli 2025: Daftar Ulang</li>
        </ul>
    </div>
    <div class="col-md-6">
        <h2>Persyaratan Jalur Penerimaan</h2>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Jalur Prestasi Akademik
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        Menggunakan nilai rata-rata rapot semester 1-5. Dokumen yang diunggah adalah scan rapot.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Jalur Prestasi Non-Akademik
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Menggunakan sertifikat lomba/kejuaraan. Dokumen yang diunggah adalah scan sertifikat.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Jalur Afirmasi
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Bagi siswa dari keluarga tidak mampu. Dokumen yang diunggah adalah scan Kartu Indonesia Pintar (KIP) atau Surat Keterangan Tidak Mampu (SKTM).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
