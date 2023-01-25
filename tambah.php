<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
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
        if (!isset($_SESSION["id_user"])) {
            echo '<script>alert("Hanya Admin yang dapat mengakses halaman ini !!!"); window.location.href="index"</script>';
            exit;
        }

        // Proses tambah
        include "conn.php";
        if (isset($_POST['tambah'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $kelas = $_POST['kelas'];
            $jurusan = $_POST['jurusan'];

            $sql = "INSERT INTO mahasiswa VALUES (NULL, '$nim', '$nama', '$kelas', '$jurusan')";

            $result = mysqli_query($kon, $sql);

            if (!$result) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                echo '<script>alert("Data Berhasil Ditambahkan !!!"); window.location.href="index"</script>';
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
                    TAMBAH DATA
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
                            <form role="form" method="post" action="">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Nim</label>
                                        <input type="text" name="nim" class="form-control" placeholder="Nim" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" name="kelas">
                                            <option value="">- Pilih Kelas -</option>
                                            <option value="Pagi">Pagi</option>
                                            <option value="Siang">Siang</option>
                                            <option value="Malam">Malam</option>
                                            <option value="Karyawan">Karyawan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <select class="form-control" name="jurusan">
                                            <option value="">- Pilih Jurusan -</option>
                                            <option value="Manajemen Informatika">Manajemen Informatika</option>
                                            <option value="Sistem Informasi">Sistem Informasi</option>
                                            <option value="Teknik Informatika">Teknik Informatika</option>
                                            <option value="Sistem Komputer">Sistem Komputer</option>
                                            <option value="Akutansi">Akutansi</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer pt-3">
                                    <button type="submit" class="btn btn-primary" name="tambah" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
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