<?php 
include 'koneksi.php';
$result = mysqli_query($conn, "DELETE from customer where `id` = '$_GET[id]'");

header("Location:index.php");

?>