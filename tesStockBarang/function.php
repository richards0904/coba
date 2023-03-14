<?php
session_start();
// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "tesStockBarang"); // format ("host","username sql","password","database")
// Menambah Barang Baru
if (isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stockbarang = $_POST["stockbarang"];
    $addtotable = mysqli_query($conn,"insert into stock(namabarang,deskripsi,stockbarang) values('$namabarang','$deskripsi','$stockbarang')");
    if($addtotable){
        header("location:index.php");
    }else{
        echo "Gagal";
        header("location:index.php");
    }
};
// Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    // mengambil data dri inputan
    $barangin = $_POST['barangin'];
    $keterangan = $_POST['keterangan'];
    $qtymasuk = $_POST['qtymasuk'];
    // mengambil data dari tabel stock
    $cekstocknow = mysqli_query($conn,"select * from stock where idbarang ='$barangin'");
    $ambilstock = mysqli_fetch_array($cekstocknow);
    // mengambil data stockbarang dri tabel stock
    $stocknow = $ambilstock['stockbarang'];
    $stockqty = $stocknow+$qtymasuk;
    //memasukan data yg diinput kedalam table masuk
    // jangan memakai mysql_command pkai mysqli_command suka error gaboleh di mix juga
    $addtablemasuk = mysqli_query($conn,"insert into masuk(idbarang,keterangan,qtymasuk) values('$barangin','$keterangan','$qtymasuk')");
    //mengupdate data barang masuk ke dalam data stockbarang di tabel masuk
    $updatestockmasuk = mysqli_query($conn,"update stock set stockbarang='$stockqty' where idbarang='$barangin'");
    if($addtablemasuk&&$updatestockmasuk){
        header("location:masuk.php");
    }else{
        echo "Gagal Memasukan Data";
        header("location:masuk.php");
    }
}
// menambah barang keluar
if(isset($_POST['barangkeluar'])){
    // mengambil data dri inputan
    $barangout = $_POST['barangout'];
    $penerima = $_POST['penerima'];
    $qtykeluar = $_POST['qtykeluar'];
    // mengambil data dari tabel stock
    $cekstocknow = mysqli_query($conn,"select * from stock where idbarang ='$barangout'");
    $ambilstock = mysqli_fetch_array($cekstocknow);
    // mengambil data stockbarang dri tabel stock
    $stocknow = $ambilstock['stockbarang'];
    $stockqty = $stocknow-$qtykeluar;
    //memasukan data yg diinput kedalam table masuk
    // jangan memakai mysql_command pkai mysqli_command suka error gaboleh di mix juga
    $addtablekeluar = mysqli_query($conn,"insert into keluar(idbarang,penerima,qtykeluar) values('$barangout','$penerima','$qtykeluar')");
    //mengupdate data barang masuk ke dalam data stockbarang di tabel masuk
    $updatestockkeluar = mysqli_query($conn,"update stock set stockbarang='$stockqty' where idbarang='$barangout'");
    if($addtablekeluar&&$updatestockkeluar){
        header("location:keluar.php");
    }else{
        echo "Gagal Memasukan Data";
        header("location:keluar.php");
    }
}
?>