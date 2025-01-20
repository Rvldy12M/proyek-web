<?php
// Mulai sesi
session_start();

// Menyertakan koneksi ke database
include "koneksi.php";

// Proses saat tombol "register" ditekan
if (isset($_POST['register'])) {
    // Mengambil data dari form
    $NamaLengkap = mysqli_real_escape_string($con, $_POST['NamaLengkap']);
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Password = !empty($_POST["Password"]) ? md5($_POST["Password"]) : null;
    $Alamat = mysqli_real_escape_string($con, $_POST['Alamat']);

    // Validasi password
    if ($Password === null) {
        die("Password tidak boleh kosong!");
    }

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO user (NamaLengkap, Username, Email, Password, Alamat) 
            VALUES ('$NamaLengkap', '$Username', '$Email', '$Password', '$Alamat')";

    // Menjalankan query
    if (mysqli_query($con, $sql)) {
        $_SESSION['message'] = "Akun berhasil dibuat!";
        header("Location: index.php"); // Redirect ke halaman lain setelah sukses
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background: #1e1e1e ; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background: rgba(54, 54, 54, 0.8); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; color: #ffff; margin-bottom: 1.5rem;">Register</h2>
        <form action="" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            <div class="form-group">
                <label for="fullname" style="color: #ffff;">Nama Lengkap</label>
                <input type="text" name="NamaLengkap" id="NamaLengkap" placeholder="Nama Lengkap" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div class="form-group">
                <label for="Username" style="color: #ffff;">Username</label>
                <input type="text" name="Username" id="Username" placeholder="Username" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div class="form-group">
                <label for="Email" style="color: #ffff;">Email</label>
                <input type="email" name="Email" id="Email" placeholder="Alamat Email" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div class="form-group">
                <label for="Password" style="color: #ffff;">Password</label>
                <input type="password" name="Password" id="Password" placeholder="Password" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div class="form-group">
                <label for="address" style="color: #ffff;">Alamat</label>
                <textarea name="Alamat" id="Alamat" placeholder="Alamat Lengkap" rows="3" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;"></textarea>
            </div>

            <button type="submit" name="register" style="padding: 0.8rem; background: #ff0800; border: none; border-radius: 4px; color: #fff; font-size: 1rem; cursor: pointer; transition: background 0.3s;">Daftar</button>
        </form>
        <p style="text-align: center; color: #ffff; margin-top: 1rem;">Sudah punya akun? <a href="login.php" style="color: #0080fe; text-decoration: none; font-weight: bold;">Login di sini</a></p>
    </div>
</body>
</html>
