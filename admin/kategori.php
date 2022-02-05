<?php
include "koneksi.php";
$id    = "";
$kt    = "";
$alias = "";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id       = $_GET['id'];
    $sql1     = "DELETE from kategori_artikel where id = '$id'";
    $q1       = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "Data berhasil di hapus";
    } else {
        $error  = "Gagal menghapus data";
    }
}

if (isset($_POST["simpan"])) {
    $kt      = $_POST['nama_kategori'];
    $alias   = $_POST['alias'];

    if ($kt && $alias) {
        // Tambah data
        $sql = "INSERT INTO kategori_artikel (nama_kategori, alias) VALUES ('$kt','$alias');";
        if ($conn->query($sql) === false) {
            trigger_error("periksa SQL manual anda :" . $sql . "Error: " . $conn->error, E_USER_ERROR);
        } else {
            echo "<meta http-equiv=='refresh' content=0.1; url=?page=kategori>";
        }
    } else {
        echo "Data Tidak boleh ada yang kosong";
    }
}

if ($op == 'edit') {
    $id       = $_GET['id'];
    $sql1     = "select * from kategori_artikel where id = '$id'";
    $q2       = mysqli_query($conn, $sql1);
    $sr1      = mysqli_fetch_array($q2);
    $kategori = $sr1['nama_kategori'];
    $alias    = $sr1['alias'];
 
    if ($kategori == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST["simpanEdit"])) {
    $kategori     = $_POST['nama_kategori'];
    $alias        = $_POST['alias'];

    if ($op == 'edit') {
        $sql = "UPDATE kategori_artikel SET nama_kategori ='$kategori' ,alias='$alias' WHERE id = '$id'";
        $qinsert = mysqli_query($conn, $sql);
        if ($qinsert) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }

} else {
    $error  = "Data Tidak boleh ada yang kosong";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Artikel</title>
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
                        <a class="nav-link" href="../index.php">
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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Manajemen Kategori
                    </div>

                    <!-- modal tambah data --->
                    <form method="POST" action"">
                        <div class="modal fade" id="addkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                                <input type="text" class="form-control" name="nama_kategori">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Alias</label>
                                                <input type="text" class="form-control" name="alias">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="card-body">
                        <div class="col-12">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addkategori">Tambah</button>
                            <button class="btn btn-outline-secondary" type="submit" name="tambah">Reload</button>
                        </div>
                        <br />
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                include "koneksi.php";
                                $sql2  = "select * from kategori_artikel order by id desc";
                                $q1    = mysqli_query($conn, $sql2);
                                $urut  = 1;
                                while ($sr2 = mysqli_fetch_array($q1)) {
                                    $id       =  $sr2['id'];
                                    $kt       =  $sr2['nama_kategori'];
                                    $alias    =  $sr2['alias'];

                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $kt ?></td>
                                        <td scope="row"><?php echo $alias ?></td>
                                        <td scope="row">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editkategori<?php echo $id ?>">Edit</button>
                                            <a href="kategori.php?op=delete&id=<?php echo  $id ?>" onclick="return confirm('Apa Anda yakin ingin menghapus data ini')"><button type="button" class="btn btn-danger">Delete</button></a>
                                            <!-- modal edit --->
                                            <form method="POST" action="kategori.php?op=edit&id=<?=$id?>">
                                                <div class="modal fade" id="editkategori<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                                                        <input type="text" class="form-control" name="nama_kategori" value="<?php echo $kt ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Alias</label>
                                                                        <input type="text" class="form-control" name="alias" value="<?php echo $alias ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id_siswa" value="<?php echo $id ?>">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="simpanEdit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    </tr>


                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>

    <script>

    </script>
</body>

</html>