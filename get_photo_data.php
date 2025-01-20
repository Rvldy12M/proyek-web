<?php
include "koneksi.php";

$photoId = $_GET['id'];
$query = "SELECT LokasiFoto, JudulFoto, DeskripsiFoto FROM foto WHERE FotoID = $photoId";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode($data);
?>
