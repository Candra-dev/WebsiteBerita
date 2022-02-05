<?php
session_start();
include "koneksi.php";
$sukses   = "";
$error    = "";
$judul    = "";
$isi      = "";
$file     = "";

$kategori = mysqli_query($conn, "SELECT * FROM kategori_artikel");
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if (isset($_POST["tambah"])) {
    $judul        = $_POST['judul'];
    $isi          = $_POST['isi'];
    $kategori     = $_POST['kategori'];
    $file         = $_FILES['gambar']['name'];
    $source       = $_FILES['gambar']['tmp_name'];
    $folder       = './gambar/';

    if ($judul && $isi && $kategori && $file) {
        // Tambah data
        move_uploaded_file($source, $folder . $file);
        $sql = "insert into artikel_berita (judul_artikel, isi_artikel, kategori, gambar_artikel) value ('$judul','$isi','$kategori', '$file');";
        $qinsert = mysqli_query($conn, $sql);
        if ($qinsert) {
            $sukses  = "Berhasil menambahkan artikel";
        } else {
            $error   = "Artikel gagal ditambahkan";
        }
    } else {
        $error  = "Data Tidak boleh ada yang kosong";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="konfigurasi.php">Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        </br>
                        <a class="nav-link" href="konfigurasi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Berita</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Artikel
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="kategori.php">Kategori</a>
                                <a class="nav-link" href="posting.php">Posting</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Web</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Website
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['username']?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="max-auto">
                    <!-- UNtuk memasukan data -->
                    <div class="card">
                        <div class="card-header">
                            Tambah Berita
                        </div>
                        <div class="card-body">
                            <?php
                            if ($error) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error ?>
                                </div>
                            <?php

                            }
                            ?>
                            <?php
                            if ($sukses) {
                            ?>
                                <div class="alert alert-info" role="alert">
                                    <?php echo $sukses ?>
                                </div>
                            <?php

                            }
                            ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Berita</label>
                                    <textarea class="form-control" id="isi" name="isi" rows="3" value="<?php echo $isi ?>"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="DataList" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" aria-label="Default select example">
                                        <option selected>-- pilih kategori --</option>
                                        <?php 
                                        while($row = mysqli_fetch_array($kategori)) {?>
                                        <option value="<?=$row['nama_kategori']?>"><?=$row['nama_kategori']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="formFile" name="gambar" value="<?php echo $file ?>">
                                </div>
                                </br>
                                <div class="col-12">
                                    <a href="posting.php" button type="submit" class="btn btn-secondary" name="kembali">Kembali</button></a>
                                    <button class="btn btn-primary plus float:right" type="submit" name="tambah">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
            </main>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>