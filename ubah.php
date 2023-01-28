<!DOCTYPE html>
<html lang="en">

<head>
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

        include "conn.php";
        // Proses ubah
        if (isset($_POST['ubah'])) {
            $id = $_POST['id'];
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $kelas = $_POST['kelas'];
            $jurusan = $_POST['jurusan'];

            $namafile = $_FILES['foto']['name'];
            $tipe_file =  array('png', 'jpg', 'jpeg', 'gif');
            $tmp = $_FILES['foto']['tmp_name'];
            $date = date('dMY His');
            $new = $date . '-' . $namafile;

            $xp = explode('.', $namafile);
            $ekstensi = strtolower(end($xp));

            if ($namafile != "") {

                if (in_array($ekstensi, $tipe_file)) {

                    $get = "SELECT foto FROM mahasiswa WHERE id_mahasiswa = '$id'";
                    $data = mysqli_query($kon, $get);
                    $lama = mysqli_fetch_array($data);

                    unlink("foto/" . $lama['foto']);

                    move_uploaded_file($tmp, 'foto/' . $new);

                    $sql = "UPDATE mahasiswa SET nim='$nim',nama='$nama',kelas='$kelas',jurusan='$jurusan', foto = '$new' WHERE id_mahasiswa ='$id'";

                    $result = mysqli_query($kon, $sql);
        
                    if (!$result) {
                        die("Connection failed: " . mysqli_connect_error());
                    } else {
                        echo '<script>alert("Data Berhasil Diubah !!!"); window.location.href="index"</script>';
                    }
                } else {
                    echo "<script>
                alert('Pastikan menggunakan File Foto !');
                window.location.href = 'index.php';
                </script>";
                }
            }
        }

        // Ambil data dari database
        include "conn.php";
        $query = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id_mahasiswa ='" . $_GET['id'] . "'");
        $row = mysqli_fetch_array($query);
        ?>

    </div>

    <div id="form" class="container py-3">

        <!-- Content Wrapper. Contains page content -->
        <div class="card">
            <!-- Content Header (Page header) -->
            <section class="card-header">
                <h1>
                    UBAH MAHASISWA
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
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                <div class="box-body">
                                    <input type="hidden" name="id" value="<?php echo $row['id_mahasiswa']; ?>">
                                    <div class="mb-3">
                                        <label>Nim</label>
                                        <input type="text" name="nim" class="form-control" placeholder="Nim" value="<?php echo $row['nim']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $row['nama']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kelas</label>
                                        <select class="form-control" name="kelas">
                                            <option value="<?php echo $row['kelas']; ?>">- <?php echo $row['kelas']; ?> -</option>
                                            <option value="Pagi">Pagi</option>
                                            <option value="Siang">Siang</option>
                                            <option value="Malam">Malam</option>
                                            <option value="Karyawan">Karyawan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jurusan</label>
                                        <select class="form-control" name="jurusan">
                                            <option value="<?php echo $row['jurusan']; ?>">- <?php echo $row['jurusan']; ?> -</option>
                                            <option value="Manajemen Informatika">Manajemen Informatika</option>
                                            <option value="Sistem Informasi">Sistem Informasi</option>
                                            <option value="Teknik Informatika">Teknik Informatika</option>
                                            <option value="Sistem Komputer">Sistem Komputer</option>
                                            <option value="Akutansi">Akutansi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Foto</label><br>
                                        <img class="mb-3" src="foto/<?php echo $row['foto']; ?>" width="100px" height="100px">
                                        <input type="file" name="foto" class="form-control" placeholder="Foto" required>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" name="ubah" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
                                    <a href="index" class="btn btn-success">Kembali</a>
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