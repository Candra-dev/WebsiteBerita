<?php
session_start();
include "koneksi.php";
$sukses   = "";
$error    = "";
$judul    = "";
$isi      = "";
$file     = "";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id       = $_GET['id'];
    $sql1     = "select * from artikel_berita where id = '$id'";
    $q2       = mysqli_query($conn, $sql1);
    $sr1      = mysqli_fetch_array($q2);
    $judul    = $sr1['judul_artikel'];
    $isi      = $sr1['isi_artikel'];
    $kategori = $sr1['kategori'];
    $file     = $sr1['gambar_artikel'];

    if ($judul == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST["simpanEdit"])) {
    $judul        = $_POST['judul'];
    $isi          = $_POST['isi'];
    $kategori     = $_POST['kategori'];
    $file         = $_FILES['gambar']['name'];
    $source       = $_FILES['gambar']['tmp_name'];
    $folder       = './gambar/';

    move_uploaded_file($source, $folder . $file);
    if ($op == 'edit') {
        $sql = "update artikel_berita set judul_artikel ='$judul' ,isi_artikel='$isi' ,kategori='$kategori' ,gambar_artikel='$file' where id = '$id'";
        $qinsert = mysqli_query($conn, $sql);
        if ($qinsert) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
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
                        <a class="nav-link" href="../index.php
                        ">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Website
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin Website
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
                                    <textarea type="text" class="form-control" id="isi" name="isi" rows="3"><?php echo $isi ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="DataList" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" aria-label="Default select example">
                                        <option>-- pilih kategori --</option>
                                        <?php 
                                        $kategori = mysqli_query($conn, "SELECT * FROM kategori_artikel");
                                        while($row = mysqli_fetch_array($kategori)) {
                                            if($row['id'] == $kategori){?>
                                                <option value="<?=$row['nama_kategori']?>" selected="selected"><?=$row['nama_kategori']?></option>
                                        <?php } else{?>
                                            <option value="<?=$row['nama_kategori']?>"><?=$row['nama_kategori']?></option>
                                        <?php }
                                        }
                                        ?> 
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Gambar</label>
                                    <img src="gambar/<?php echo $file ?>" style="width: 120px; float: left; margin-bottom; 5px;">" 7
                                    <input class="form-control" type="file" id="formFile" name="gambar">
                                    <i style="float: left; font-size: 11px; color: red">Abaikan bila tidak merubah gambar</i>
                                </div>
                                </br>
                                <div class="col-12">
                                    <a href="posting.php" button type="submit" class="btn btn-secondary" name="kembali">Kembali</button></a>
                                    <button class="btn btn-primary plus float:right" type="submit" name="simpanEdit">Simpan</button>
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