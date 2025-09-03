<?php 
include 'header.php'; 

// Ambil statistik dasar
$query_total = "SELECT COUNT(id) as total_pendaftar FROM calon_siswa";
$result_total = mysqli_query($conn, $query_total);
$total_pendaftar = mysqli_fetch_assoc($result_total)['total_pendaftar'];

$query_verif = "SELECT COUNT(id) as total_verif FROM calon_siswa WHERE status_verifikasi != 'Belum Diverifikasi'";
$result_verif = mysqli_query($conn, $query_verif);
$total_verif = mysqli_fetch_assoc($result_verif)['total_verif'];

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Pendaftar</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $total_pendaftar; ?> Siswa</h5>
                <p class="card-text">Jumlah total siswa yang telah mendaftar.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Pendaftar Terverifikasi</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $total_verif; ?> Siswa</h5>
                <p class="card-text">Jumlah siswa yang datanya telah diverifikasi oleh admin.</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>
    <p>Anda dapat mengelola data pendaftar melalui menu "Kelola Pendaftar".</p>
</div>

<?php include 'footer.php'; ?>
