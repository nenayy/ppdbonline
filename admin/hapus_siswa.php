<?php 
include 'header.php'; 

// Cek jika tidak ada ID, redirect
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: kelola_pendaftar.php");
    exit;
}

$id_siswa = intval($_GET['id']);

// 1. Ambil path dokumen sebelum dihapus dari DB
$query_select = "SELECT dokumen_path FROM calon_siswa WHERE id = ?";
$stmt_select = mysqli_prepare($conn, $query_select);
if ($stmt_select) {
    mysqli_stmt_bind_param($stmt_select, "i", $id_siswa);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    if ($row = mysqli_fetch_assoc($result)) {
        $dokumen_path = $row['dokumen_path'];

        // 2. Hapus file dokumen dari server jika ada
        if (!empty($dokumen_path) && file_exists('../' . $dokumen_path)) {
            unlink('../' . $dokumen_path);
        }
    }
    mysqli_stmt_close($stmt_select);
} else {
    // Handle error jika perlu, tapi untuk delete kita bisa lanjut
}

// 3. Hapus record dari database
$query_delete = "DELETE FROM calon_siswa WHERE id = ?";
$stmt_delete = mysqli_prepare($conn, $query_delete);
if ($stmt_delete) {
    mysqli_stmt_bind_param($stmt_delete, "i", $id_siswa);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);
}

// 4. Redirect kembali ke halaman kelola pendaftar
// Bisa ditambahkan session message jika perlu
$_SESSION['delete_success'] = "Data pendaftar berhasil dihapus.";
header("Location: kelola_pendaftar.php");
exit;

?>
