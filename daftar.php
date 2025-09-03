<?php include 'header.php'; ?>

<h2>Formulir Pendaftaran Siswa Baru</h2>
<p>Silakan isi data berikut dengan benar. Pola isian ditandai dengan (*).</p>

<form action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
        <label for="nama_lengkap" class="form-label">Nama Lengkap *</label>
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
    </div>
    <div class="mb-3">
        <label for="nisn" class="form-label">NISN *</label>
        <input type="text" class="form-control" id="nisn" name="nisn" required>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="asal_sekolah" class="form-label">Asal Sekolah *</label>
        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat Lengkap *</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="no_hp" class="form-label">Nomor HP *</label>
            <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Jalur Pendaftaran *</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jalur_pendaftaran" id="prestasi_akademik" value="Prestasi Akademik" required>
            <label class="form-check-label" for="prestasi_akademik">Prestasi Akademik (Nilai Rapot)</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jalur_pendaftaran" id="prestasi_non_akademik" value="Prestasi Non-Akademik">
            <label class="form-check-label" for="prestasi_non_akademik">Prestasi Non-Akademik (Sertifikat Lomba)</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jalur_pendaftaran" id="afirmasi" value="Afirmasi">
            <label class="form-check-label" for="afirmasi">Afirmasi (KIP/SKTM)</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="dokumen" class="form-label">Upload Dokumen Pendukung *</label>
        <p class="form-text">Upload scan Ijazah/Rapot/Sertifikat/KIP dalam format PDF, max 2MB.</p>
        <input class="form-control" type="file" id="dokumen" name="dokumen" accept=".pdf" required>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
    <button type="reset" class="btn btn-secondary">Reset Form</button>
</form>

<?php include 'footer.php'; ?>
