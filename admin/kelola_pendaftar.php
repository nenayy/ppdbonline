<?php 
include 'header.php'; 

// Ambil semua data calon siswa
$query = "SELECT id, nomor_pendaftaran, nama_lengkap, nisn, asal_sekolah, jalur_pendaftaran, status_verifikasi FROM calon_siswa ORDER BY tanggal_daftar DESC";
$result = mysqli_query($conn, $query);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Data Pendaftar</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No. Pendaftaran</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">NISN</th>
                <th scope="col">Asal Sekolah</th>
                <th scope="col">Jalur</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0):
                $i = 1;
                while($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($row['nomor_pendaftaran']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                <td><?php echo htmlspecialchars($row['nisn']); ?></td>
                <td><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
                <td><?php echo htmlspecialchars($row['jalur_pendaftaran']); ?></td>
                <td>
                    <span class="badge <?php 
                        switch ($row['status_verifikasi']) {
                            case 'Diterima': echo 'bg-success'; break;
                            case 'Ditolak': echo 'bg-danger'; break;
                            case 'Valid': echo 'bg-info'; break;
                            default: echo 'bg-warning';
                        }?>">
                        <?php echo htmlspecialchars($row['status_verifikasi']); ?>
                    </span>
                </td>
                <td>
                    <a href="detail_siswa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Detail</a>
                    <a href="hapus_siswa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php 
                endwhile;
            else:
            ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada data pendaftar.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
