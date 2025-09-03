<?php 
include 'header.php'; 

// Cek jika tidak ada ID, redirect
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: kelola_pendaftar.php");
    exit;
}

$id_siswa = intval($_GET['id']);

// Proses update status jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $status_baru = mysqli_real_escape_string($conn, $_POST['status_verifikasi']);
    $update_query = "UPDATE calon_siswa SET status_verifikasi = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $status_baru, $id_siswa);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        // Redirect untuk refresh halaman dan menghindari resubmit form
        header("Location: detail_siswa.php?id=" . $id_siswa . "&status=updated");
        exit;
    }
}

// Ambil data siswa
$query = "SELECT * FROM calon_siswa WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id_siswa);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
        $siswa = mysqli_fetch_assoc($result);
    } else {
        // Jika siswa tidak ditemukan, redirect
        header("Location: kelola_pendaftar.php");
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    die("Database query failed.");
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pendaftar</h1>
    <a href="kelola_pendaftar.php" class="btn btn-secondary">Kembali</a>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
<div class="alert alert-success">Status berhasil diperbarui.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <h3>Data Siswa</h3>
        <table class="table table-bordered">
            <tr>
                <th>Nomor Pendaftaran</th>
                <td><?php echo htmlspecialchars($siswa['nomor_pendaftaran']); ?></td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td><?php echo htmlspecialchars($siswa['nama_lengkap']); ?></td>
            </tr>
            <tr>
                <th>NISN</th>
                <td><?php echo htmlspecialchars($siswa['nisn']); ?></td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td><?php echo htmlspecialchars($siswa['tempat_lahir']) . ", " . date("d F Y", strtotime($siswa['tanggal_lahir'])); ?></td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td><?php echo htmlspecialchars($siswa['asal_sekolah']); ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo htmlspecialchars($siswa['alamat']); ?></td>
            </tr>
            <tr>
                <th>Kontak</th>
                <td>HP: <?php echo htmlspecialchars($siswa['no_hp']); ?> | Email: <?php echo htmlspecialchars($siswa['email']); ?></td>
            </tr>
            <tr>
                <th>Jalur Pendaftaran</th>
                <td><?php echo htmlspecialchars($siswa['jalur_pendaftaran']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Daftar</th>
                <td><?php echo date("d F Y, H:i", strtotime($siswa['tanggal_daftar'])); ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <h3>Verifikasi Dokumen</h3>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Status Saat Ini</h5>
                <p class="card-text fs-4">
                    <span class="badge <?php 
                        switch ($siswa['status_verifikasi']) {
                            case 'Diterima': echo 'bg-success'; break;
                            case 'Ditolak': echo 'bg-danger'; break;
                            case 'Valid': echo 'bg-info'; break;
                            default: echo 'bg-warning';
                        }?>">
                        <?php echo htmlspecialchars($siswa['status_verifikasi']); ?>
                    </span>
                </p>
                <hr>
                <a href="../<?php echo htmlspecialchars($siswa['dokumen_path']); ?>" class="btn btn-primary w-100 mb-3" target="_blank">Lihat Dokumen</a>
                
                <form action="detail_siswa.php?id=<?php echo $id_siswa; ?>" method="POST">
                    <div class="mb-3">
                        <label for="status_verifikasi" class="form-label">Ubah Status</label>
                        <select class="form-select" name="status_verifikasi" id="status_verifikasi">
                            <option value="Belum Diverifikasi" <?php if($siswa['status_verifikasi'] == 'Belum Diverifikasi') echo 'selected'; ?>>Belum Diverifikasi</option>
                            <option value="Valid" <?php if($siswa['status_verifikasi'] == 'Valid') echo 'selected'; ?>>Dokumen Valid</option>
                            <option value="Tidak Valid" <?php if($siswa['status_verifikasi'] == 'Tidak Valid') echo 'selected'; ?>>Dokumen Tidak Valid</option>
                            <option value="Diterima" <?php if($siswa['status_verifikasi'] == 'Diterima') echo 'selected'; ?>>Diterima</option>
                            <option value="Ditolak" <?php if($siswa['status_verifikasi'] == 'Ditolak') echo 'selected'; ?>>Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" name="update_status" class="btn btn-success w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
