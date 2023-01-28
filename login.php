<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstraps -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/d0157de78d.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>

    <div id="kode">
        <?php
        // Session
        session_start();
        if (isset($_SESSION["id_user"])) {
            echo '<script>alert("Anda telah melakukan login !!!"); window.location.href="index"</script>';
            exit;
        }

        // Proses login
        include "conn.php";

        if (isset($_POST['login'])) {

            $username = (htmlentities($_POST['username']));
            $password = (md5($_POST['password']));
            $check    = mysqli_query($kon, "SELECT * FROM user WHERE username = '$username' AND password = '$password'") or die("Connection failed: " . mysqli_connect_error());
            if (mysqli_num_rows($check) >= 1) {
                while ($row = mysqli_fetch_array($check)) {
                    $_SESSION['id_user'] = $row['id_user'];
        ?>
                    <script>
                        alert("Selamat Datang <?= $row['username']; ?> Kamu Telah Login Ke Halaman Admin !!!");
                        window.location.href = "index";
                    </script>
        <?php
                }
            } else {
                echo '<script>alert("Masukan Username dan Password dengan Benar !!!"); window.location.href="login"</script>';
            }
        }
        ?>
    </div>

        <div id="form" class="container py-3">
            <!-- Content Wrapper. Contains page content -->
            <div class="card">
                <!-- Content Header (Page header) -->
                <section class="card-header">
                    <h1>
                        FORM LOGIN
                    </h1>
                </section>
                <!-- Main content -->
                <section class="card-body">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-primary" name="login" value="Login">
                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
    </div>
</body>

</html>