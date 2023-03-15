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
    <title>Barang Keluar</title>
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
                    <h1 class="mt-4">Barang Keluar</h1>
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
                                    <th>Tanggal Keluar</th>
                                    <th>Nama Barang</th>
                                    <th>Penerima</th>
                                    <th>Quantity Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // tampilkan data dari tabel masuk dimisalkan m dan stock jadi s 
                                    $ambilsemuakeluar = mysqli_query($conn,"select * from keluar k, stock s where s.idbarang = k.idbarang");
                                    while($data = mysqli_fetch_array($ambilsemuakeluar)){
                                        $tanggalkeluar = $data['tanggal'];
                                        $namabarang = $data['namabarang'];
                                        $penerima = $data['penerima'];
                                        $qtykeluar = $data['qtykeluar'];
                                ?>
                                <!-- Cara menampilkan data di database ke dalam website -->
                                <tr>
                                    <td> <?=$tanggalkeluar;?> </td>
                                    <td> <?=$namabarang;?> </td>
                                    <td> <?=$penerima;?> </td>
                                    <td> <?=$qtykeluar;?> </td>
                                </tr>
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
                <h4 class="modal-title">Tambah Barang Keluar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post">
                    <div class="modal-body">
                        <select name="barangout" class="form-control">
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
                        <input type="number" name="qtykeluar" class="form-control" placeholder="Quantity Keluar" min="1" required>
                        <br>
                        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
                    </div>
                </form>      
            </div>
        </div>
    </div>
</div>


</html>