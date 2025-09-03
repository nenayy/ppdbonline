<?php
session_start();
include 'config/db.php';

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $asal_sekolah = mysqli_real_escape_string($conn, $_POST['asal_sekolah']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $jalur_pendaftaran = mysqli_real_escape_string($conn, $_POST['jalur_pendaftaran']);

    // Proses upload dokumen
    $dokumen_path = '';
    if (isset($_FILES['dokumen']) && $_FILES['dokumen']['error'] == 0) {
        $allowed_ext = ['pdf'];
        $file_name = $_FILES['dokumen']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_size = $_FILES['dokumen']['size'];
        $file_tmp = $_FILES['dokumen']['tmp_name'];

        // Validasi ekstensi dan ukuran
        if (in_array($file_ext, $allowed_ext) && $file_size <= 2097152) { // 2MB
            $upload_dir = 'assets/uploads/';
            // Buat nama file unik
            $new_file_name = uniqid('doc_', true) . '.' . $file_ext;
            $dokumen_path = $upload_dir . $new_file_name;

            if (!move_uploaded_file($file_tmp, $dokumen_path)) {
                $_SESSION['error_message'] = "Gagal mengupload dokumen.";
                header("Location: daftar.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "File harus PDF dan ukuran maksimal 2MB.";
            header("Location: daftar.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Dokumen pendukung wajib diupload.";
        header("Location: daftar.php");
        exit();
    }

    // Generate Nomor Pendaftaran unik (contoh: PPDB-2025-xxxx)
    $nomor_pendaftaran = "PPDB-" . date("Y") . "-" . rand(1000, 9999);

    // Query untuk insert data
    $sql = "INSERT INTO calon_siswa (nomor_pendaftaran, nama_lengkap, nisn, tempat_lahir, tanggal_lahir, asal_sekolah, alamat, no_hp, email, jalur_pendaftaran, dokumen_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssssss", 
            $nomor_pendaftaran, 
            $nama_lengkap, 
            $nisn, 
            $tempat_lahir, 
            $tanggal_lahir, 
            $asal_sekolah, 
            $alamat, 
            $no_hp, 
            $email, 
            $jalur_pendaftaran, 
            $dokumen_path
        );

        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil, simpan nomor pendaftaran di session dan redirect
            $_SESSION['success_message'] = "Pendaftaran berhasil!";
            $_SESSION['nomor_pendaftaran'] = $nomor_pendaftaran;
            header("Location: pendaftaran_sukses.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat menyimpan data: " . mysqli_stmt_error($stmt);
            header("Location: daftar.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan pada database.";
        header("Location: daftar.php");
        exit();
    }

} else {
    // Jika halaman diakses langsung, redirect ke halaman daftar
    header("Location: daftar.php");
    exit();
}

mysqli_close($conn);
?>
