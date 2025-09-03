<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);
            // Ganti hash ini dengan hash yang benar untuk 'admin123'
            // Anda bisa generate hash baru jika perlu. Contoh hash untuk 'admin123' adalah:
            // $2y$10$3qG.F.s.T.u.v.w.x.y.z.A.B.C.D.E.F.G.H.I.J.K.L.M.N.O.P.Q (ini hanya contoh)
            // Mari kita gunakan password_verify
            if (password_verify($password, $admin['password'])) {
                // Password benar
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                // Password salah
                $_SESSION['login_error'] = "Username atau password salah.";
                header("Location: login.php");
                exit();
            }
        } else {
            // Username tidak ditemukan
            $_SESSION['login_error'] = "Username atau password salah.";
            header("Location: login.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['login_error'] = "Database error.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

mysqli_close($conn);
?>
