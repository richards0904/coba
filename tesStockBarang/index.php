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
    <title>Stock Barang</title>
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
                        <a class="nav-link" href="logout.php">
                            Log Out
                        </a>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Stock Barang</h1>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Barang
                        </button>
                        <a href="export.php" class="btn btn-success">Export Stock<a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Stock Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $ambilsemuastock = mysqli_query($conn,"select * from stock");
                                    while($data = mysqli_fetch_array($ambilsemuastock)){
                                        
                                        $namabarang = $data['namabarang'];
                                        $deskripsi = $data['deskripsi'];
                                        $stockbarang = $data['stockbarang'];
                                        $idb = $data['idbarang'];


                                ?>
                                <!-- Cara menampilkan data di database ke dalam website -->
                                <tr>
                                    <td> <?=$i++;?> </td>
                                    <td> <?=$namabarang;?> </td>
                                    <td> <?=$deskripsi;?> </td>
                                    <td> <?=$stockbarang;?> </td>
                                    <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>">
                                        Edit
                                    </button>
                                    <input type="hidden" name="idbaranghapus" value="<?=$idb;?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idb;?>">
                                        Hapus
                                    </button>                 
                                    </td>
                                </tr>
                                <!-- The Edit Modal -->
                                    <div class="modal fade" id="edit<?=$idb;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                        <!-- Edit Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Edit Modal body -->
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                            <br>
                                                            <input type="text" name="deskripsi" value = "<?=$deskripsi;?>" class="form-control" required>
                                                            <br>
                                                            <input type="hidden" name="idb" value = "<?=$idb;?>">
                                                            <button type="submit" class="btn btn-primary" name="editstockbarang">Submit</button>
                                                        </div>
                                                    </form>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- The Delete Modal -->
                                    <div class="modal fade" id="delete<?=$idb;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                        <!-- Delete Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang?</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Delete Modal body -->
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus <?=$namabarang;?> ?</p>
                                                            <input type="hidden" name="idb" value = "<?=$idb;?>">
                                                            <button a type="submit" class="btn btn-danger" name="hapusstockbarang">Hapus</button>
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
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                        <br>
                        <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                        <br>
                        <input type="number" name="stockbarang" class="form-control" placeholder="Stock" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                    </div>
                </form>      
            </div>
        </div>
    </div>
</div>
</html>