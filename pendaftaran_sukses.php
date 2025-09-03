<?php
session_start();

// Cek jika tidak ada pesan sukses, redirect ke home
if (!isset($_SESSION['success_message']) || !isset($_SESSION['nomor_pendaftaran'])) {
    header("Location: index.php");
    exit();
}

$nomor_pendaftaran = $_SESSION['nomor_pendaftaran'];

// Hapus session setelah ditampilkan
unset($_SESSION['success_message']);
unset($_SESSION['nomor_pendaftaran']);

include 'header.php'; 
?>

<div class="container text-center">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Pendaftaran Berhasil!</h4>
        <p>Terima kasih telah melakukan pendaftaran di PPDB Online SMP Negeri 1 Wanadadi.</p>
        <hr>
        <p class="mb-0">Mohon simpan nomor pendaftaran Anda di bawah ini untuk melakukan pengecekan status kelulusan.</p>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Nomor Pendaftaran Anda
        </div>
        <div class="card-body">
            <h2 class="card-title text-primary"><?php echo htmlspecialchars($nomor_pendaftaran); ?></h2>
        </div>
    </div>

    <a href="index.php" class="btn btn-primary mt-4">Kembali ke Halaman Utama</a>
</div>

<?php include 'footer.php'; ?>
