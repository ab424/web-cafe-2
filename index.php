<?php 
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <title>Halaman Login</title>
  </head>
  <!-- Form Login -->
  <body style="min-height: 100vh;">
    <div class="container">
      <div class="wrapper">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h2 class="text-center text-dark mt-5">Login</h2>
          <div class="card my-5">
            <form class="card-body cardbody-color p-lg-5" method="POST" action="" >
              <div class="text-center">
                <img src="images/logo-cafe-legend.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                  width="200px" alt="profile">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="text-center"><button type="submit" name="submit" class="btn btn-outline-dark px-5 mb-5">Login</button></div>
              <div class="form-text text-center mb-2 text-dark">Belum Punya Akun? <a href="register.php" class="text-dark fw-bold"> Buat Akun Anda</a></div>
            </fosrm>
          </div>
        </div>
      </div>
      </div>
    </div>
  <!-- Akhir Form Login -->

  <!-- Awal Footer -->
  <footer class="text-center text-white bg-dark mt-5">
  <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.9);">© 2022 Copyright: Designed by 192102135 - Abrari Liwalidina</div>
  <!-- Copyright -->
  </footer>
  <!-- Akhir Footer -->

  <!-- Eksekusi Form Login -->
      <?php 
        if(isset($_POST['submit'])) {
          $user = mysqli_real_escape_string($koneksi,$_POST['username']);
          $password = mysqli_real_escape_string($koneksi, $_POST['password']) ;

          // Query untuk memilih tabel
          $cek_data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' AND password = '$password'");
          $hasil = mysqli_fetch_array($cek_data);
          $status = $hasil['status'];
          $login_user = $hasil['username'];
          $row = mysqli_num_rows($cek_data);

          // Pengecekan Kondisi Login Berhasil/Tidak
            if ($row > 0) {
                session_start();   
                $_SESSION['login_user'] = $login_user;

                if ($status == 'admin') {
                  header('location: admin.php');
                }elseif ($status == 'user') {
                  header('location: user.php'); 
                }
            }else{
                header("location: index.php");
            }
        }
       ?>
    </div>
  <!-- Akhir Eksekusi Form Login -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>