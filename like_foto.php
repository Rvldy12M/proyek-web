<?php
session_start();
include "koneksi.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    echo json_encode(['success' => false, 'message' => 'User belum login']);
    exit();
}

// Mendapatkan ID foto yang dilike
$fotoID = $_POST['FotoID'];

// Mendapatkan ID pengguna dari session
$userID = $_SESSION['UserID']; // Pastikan UserID ada dalam session

// Query untuk menyimpan like
$query = "INSERT INTO likefoto (FotoID, UserID, TanggalLike) VALUES ('$fotoID', '$userID', NOW())";

if (mysqli_query($con, $query)) {
    // Jika berhasil menambah like, kirim respons sukses
    echo json_encode(['success' => true]);
} else {
    // Jika gagal, kirim respons gagal
    echo json_encode(['success' => false, 'message' => 'Gagal menambah like']);
}
?>
