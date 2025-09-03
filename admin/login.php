<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - PPDB Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f5f5f5;
      }
      .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
      }
    </style>
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="proses_login.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

    <?php 
      session_start();
      if(isset($_SESSION['login_error'])){
        echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
        unset($_SESSION['login_error']);
      }
    ?>

    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating mt-2">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2025</p>
    <a href="../index.php">Kembali ke Halaman Utama</a>
  </form>
</main>

  </body>
</html>
