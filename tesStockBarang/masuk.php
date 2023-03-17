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
    <title>Barang Masuk</title>
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
                    <h1 class="mt-4">Barang Masuk</h1>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Barang
                        </button>                 
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Barang</th>
                                    <th>Penerima</th>
                                    <th>Quantity Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // tampilkan data dari tabel masuk dimisalkan m dan stock jadi s 
                                    $ambilsemuamasuk = mysqli_query($conn,"select * from masuk m, stock s where s.idbarang = m.idbarang");
                                    while($data = mysqli_fetch_array($ambilsemuamasuk)){
                                        $idb = $data['idbarang'];
                                        $idm = $data['idmasuk'];
                                        $tanggalmasuk = $data['tanggalmasuk'];
                                        $namabarang = $data['namabarang'];
                                        $keterangan = $data['keterangan'];
                                        $qtymasuk = $data['qtymasuk'];
                                ?>
                                <!-- Cara menampilkan data di database ke dalam website -->
                                <tr>
                                    <td> <?=$tanggalmasuk;?> </td>
                                    <td> <?=$namabarang;?> </td>
                                    <td> <?=$keterangan;?> </td>
                                    <td> <?=$qtymasuk;?> </td>
                                    <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idm;?>">
                                        Edit
                                    </button>
                                    <input type="hidden" name="idbaranghapus" value="<?=$idm;?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idm;?>">
                                        Hapus
                                    </button>                 
                                    </td>
                                </tr>
                                <!-- The Edit Modal -->
                                    <div class="modal fade" id="edit<?=$idm;?>">
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
                                                            <input type=text value='<?=$namabarang;?>' class='form-control' disabled>
                                                            <br>
                                                            <input type="text" name="keterangan" value = "<?=$keterangan;?>" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="qtymasuk" value = "<?=$qtymasuk;?>" class="form-control" required>
                                                            <br>
                                                            <input type="hidden" name="idb" value = "<?=$idb;?>">
                                                            <input type="hidden" name="idm" value = "<?=$idm;?>">
                                                            <button type="submit" class="btn btn-primary" name="editmasukbarang">Submit</button>
                                                        </div>
                                                    </form>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- The Delete Modal -->
                                    <div class="modal fade" id="delete<?=$idm;?>">
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
                                                            <input type="hidden" name="qtymasuk" value = "<?=$qtymasuk?>">
                                                            <input type="hidden" name="idm" value = "<?=$idm;?>">
                                                            <button type="submit" class="btn btn-danger" name="hapusmasukbarang">Hapus</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
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
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post">
                    <div class="modal-body">
                        <select name="barangin" class="form-control">
                            <?php
                                // mengambil data di tabel stock untuk dijadikan pilihan
                                // query select hnya menampilkan dan fetch array untuk mengubah data yg ditampilkan menjadi array
                                $ambilsemuadata = mysqli_query($conn,"select * from stock");
                                while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                    $pilihbarang = $fetcharray['namabarang'];
                                    $pilihid = $fetcharray['idbarang'];   
                            ?>
                            <!-- cara pengambilan variabel php didalam html -->
                            <option value="<?=$pilihid;?>"><?=$pilihbarang;?></option>
                            <!-- Penulisan kode html di dalam php -->
                            <?php
                                }
                            ?>
                        </select>
                        <br>
                        <input type="number" name="qtymasuk" class="form-control" placeholder="Quantity Masuk" min="1"required>
                        <br>
                        <input type="text" name="keterangan" class="form-control" placeholder="Penerima" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                    </div>
                </form>      
            </div>
        </div>
    </div>
</div>
</html>