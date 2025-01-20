<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foto_id = $_POST['foto_id'];
    $isi_komentar = $_POST['isi_komentar'];
    $user_id = 1; // Ganti dengan ID user yang login saat ini

    if (!empty($isi_komentar)) {
        $query = "INSERT INTO komentarfoto (FotoID, UserID, IsiKomentar, TanggalKomentar) VALUES (?, ?, ?, NOW())";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iis", $foto_id, $user_id, $isi_komentar);

        if ($stmt->execute()) {
            // Fetch username untuk ditampilkan langsung
            $usernameQuery = "SELECT Username FROM user WHERE UserID = ?";
            $userStmt = $con->prepare($usernameQuery);
            $userStmt->bind_param("i", $user_id);
            $userStmt->execute();
            $userResult = $userStmt->get_result();
            $user = $userResult->fetch_assoc();

            echo json_encode([
                "success" => true,
                "username" => $user['Username'],
                "isi_komentar" => htmlspecialchars($isi_komentar)
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to insert comment."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Comment cannot be empty."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method."]);
}
?>
