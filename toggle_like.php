<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['foto_id']) && isset($_POST['user_id'])) {
    $foto_id = intval($_POST['foto_id']);
    $user_id = intval($_POST['user_id']);

    // Check if the user already liked the photo
    $checkQuery = "SELECT * FROM likefoto WHERE FotoID = $foto_id AND UserID = $user_id";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // User already liked, remove the like
        $deleteQuery = "DELETE FROM likefoto WHERE FotoID = $foto_id AND UserID = $user_id";
        if (mysqli_query($con, $deleteQuery)) {
            // Get the updated like count
            $countQuery = "SELECT COUNT(*) AS LikeCount FROM likefoto WHERE FotoID = $foto_id";
            $countResult = mysqli_query($con, $countQuery);
            $likeCount = mysqli_fetch_assoc($countResult)['LikeCount'];

            echo json_encode([
                "success" => true,
                "action" => "unliked",
                "like_count" => $likeCount
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to remove like"]);
        }
    } else {
        // User has not liked yet, add the like
        $insertQuery = "INSERT INTO likefoto (FotoID, UserID, TanggalLike) VALUES ($foto_id, $user_id, NOW())";
        if (mysqli_query($con, $insertQuery)) {
            // Get the updated like count
            $countQuery = "SELECT COUNT(*) AS LikeCount FROM likefoto WHERE FotoID = $foto_id";
            $countResult = mysqli_query($con, $countQuery);
            $likeCount = mysqli_fetch_assoc($countResult)['LikeCount'];

            echo json_encode([
                "success" => true,
                "action" => "liked",
                "like_count" => $likeCount
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to add like"]);
        }
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
