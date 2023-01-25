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

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <!-- Css -->
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>

    <div id="kode">
        <?php
        session_start();

        // Proses Logout
        if (isset($_POST['logout'])) {
            if (isset($_SESSION['id_user'])) {
                session_destroy();

                echo "<script>alert('Anda berhasil Keluar !');window.location.href='index';</script>";
            }
        }
        ?>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div id="form" class="container-fluid py-3">
        <div class="card">
            <!-- Content Header (Page header) -->
            <section class="card-header">
                <div class="row">
                    <div class="col">
                        <h1>DATA MAHASISWA</h1>
                    </div>
                    <div class="col pt-2">
                        <div class="d-flex justify-content-end">
                            <?php
                            // Tombol login dan logout
                            if (!isset($_SESSION['id_user'])) {
                            ?>
                                <a class="btn btn-primary" href="login"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                            <?php
                            } else {
                            ?>
                                <form action="" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="box box-primary">
                            <div class="box-header pb-2">
                                <?php
                                // Tombol tambah data untuk admin
                                if (isset($_SESSION['id_user'])) {
                                ?>
                                    <a href="tambah" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="box-body table-responsive">
                                <table id="myTable" class="table table-bordered table-hover pt-2">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NIM</th>
                                            <th>NAMA</th>
                                            <th>KELAS</th>
                                            <th>JURUSAN</th>
                                            <?php
                                            // Tampilan aksi untuk admin
                                            if (isset($_SESSION['id_user'])) {
                                            ?>
                                                <th>AKSI</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        include "conn.php";
                                        // Ambil data untuk index
                                        $no = 1;
                                        $query = mysqli_query($kon, "SELECT * FROM mahasiswa");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>

                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nim']; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['kelas']; ?></td>
                                                <td><?php echo $row['jurusan']; ?></td>
                                                <?php
                                                // Tombol aksi untuk admin
                                                if (isset($_SESSION['id_user'])) {
                                                ?>
                                                    <td>
                                                        <a href="ubah?id=<?= $row['id_mahasiswa']; ?>" class="btn btn-success" role="button" title="Ubah Data">Ubah Data<i class="glyphicon glyphicon-edit"></i></a>
                                                        <a href="hapus?id=<?= $row['id_mahasiswa']; ?>" class="btn btn-danger" role="button" title="Hapus Data">Hapus Data<i class="glyphicon glyphicon-trash"></i></a>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Javascript Datatable -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            // scrollX: true;
        });
    </script>

</body>

</html>