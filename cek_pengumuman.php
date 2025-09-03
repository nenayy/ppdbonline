<?php
session_start();
include 'config/db.php';

$hasil_seleksi = null;
$error_message = '';

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomor_pendaftaran']) && !empty($_POST['nomor_pendaftaran'])) {
        $nomor_pendaftaran = mysqli_real_escape_string($conn, $_POST['nomor_pendaftaran']);

        $sql = "SELECT nama_lengkap, status_verifikasi FROM calon_siswa WHERE nomor_pendaftaran = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $nomor_pendaftaran);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $hasil_seleksi = mysqli_fetch_assoc($result);
            } else {
                $error_message = "Nomor pendaftaran tidak ditemukan.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Terjadi kesalahan pada database.";
        }
    } else {
        $error_message = "Silakan masukkan nomor pendaftaran Anda.";
    }
}

include 'header.php';
?>

<h2>Cek Pengumuman Hasil Seleksi</h2>
<p>Masukkan nomor pendaftaran Anda untuk melihat status seleksi.</p>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="cek_pengumuman.php" method="POST">
                    <div class="mb-3">
                        <label for="nomor_pendaftaran" class="form-label">Nomor Pendaftaran</label>
                        <input type="text" class="form-control" id="nomor_pendaftaran" name="nomor_pendaftaran" placeholder="Contoh: PPDB-2025-1234" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cek Status</button>
                </form>
            </div>
        </div>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="mt-4">
                <?php if ($hasil_seleksi): ?>
                    <div class="alert alert-info">
                        <h4 class="alert-heading">Hasil untuk: <?php echo htmlspecialchars($hasil_seleksi['nama_lengkap']); ?></h4>
                        <hr>
                        <p class="fs-5">Status Pendaftaran Anda: 
                            <strong>
                                <?php 
                                    // Logika sementara sebelum ada tabel pengumuman final
                                    if ($hasil_seleksi['status_verifikasi'] == 'Diterima' || $hasil_seleksi['status_verifikasi'] == 'Ditolak') {
                                        echo htmlspecialchars($hasil_seleksi['status_verifikasi']);
                                    } else {
                                        echo "Dalam Proses Seleksi";
                                    }
                                ?>
                            </strong>
                        </p>
                    </div>
                <?php elseif ($error_message): ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include 'footer.php'; ?>
