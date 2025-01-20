<?php
include 'koneksi.php';

if (isset($_GET['foto_id'])) {
    $foto_id = $_GET['foto_id'];
    $query = "SELECT k.IsiKomentar, u.Username 
              FROM komentarfoto k
              JOIN user u ON k.UserID = u.UserID
              WHERE k.FotoID = '$foto_id'
              ORDER BY k.TanggalKomentar ASC";
    $result = mysqli_query($con, $query);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    echo json_encode($comments);
}
?>
