<?php
//Apabila belum pernah login saat masuk halaman index
if (isset($_SESSION['log'])) {

} else {
    header('location:login.php');
}
?>