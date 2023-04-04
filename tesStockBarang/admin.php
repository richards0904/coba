<?php
require "function.php";
require "cek.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kelola Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Tes RPL</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kelola Admin
                        </a>
                        <a class="nav-link" href="logout.php">
                            Log Out
                        </a>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Kelola Admin</h1>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Admin
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID User</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $ambilsemuaadmin = mysqli_query($conn,"select * from login");
                                    while($data = mysqli_fetch_array($ambilsemuaadmin)){
                                        
                                        $email = $data['email'];
                                        $password = $data['password'];
                                        $idu = $data['iduser'];


                                ?>
                                <!-- Cara menampilkan data di database ke dalam website -->
                                <tr>
                                    <td> <?=$i++;?> </td>
                                    <td> <?=$email;?> </td>
                                    <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idu;?>">
                                        Edit
                                    </button>
                                    <input type="hidden" name="idbaranghapus" value="<?=$idu;?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idu;?>">
                                        Hapus
                                    </button>                 
                                    </td>
                                </tr>
                                <!-- The Edit Modal -->
                                    <div class="modal fade" id="edit<?=$idu;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                        <!-- Edit Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Admin</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Edit Modal body -->
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="email" name="emailbaru" value="<?=$email;?>" class="form-control" required>
                                                            <br>
                                                            <input type="password" name="passwordbaru" class="form-control" placeholder="password" required>
                                                            <br>
                                                            <input type="hidden" name="idu" value = "<?=$idu;?>">
                                                            <button type="submit" class="btn btn-primary" name="editadmin">Submit</button>
                                                        </div>
                                                    </form>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- The Delete Modal -->
                                    <div class="modal fade" id="delete<?=$idu;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                        <!-- Delete Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Admin?</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Delete Modal body -->
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus <?=$email;?> ?</p>
                                                            <input type="hidden" name="idu" value = "<?=$idu;?>">
                                                            <button a type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
                                                        </div>
                                                    </form>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        };
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
    <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post">
                    <div class="modal-body">
                        <input type="email" name="emailadmin" placeholder="email" class="form-control" required>
                        <br>
                        <input type="password" name="password" placeholder="password" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
                    </div>
                </form>      
            </div>
        </div>
    </div>
</div>
</html>