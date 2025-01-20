<?php
include "koneksi.php";
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Ambil UserID dari sesi login
$userID = $_SESSION['UserID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - CV. Revaldy</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <!-- Favicons -->
  <link href="assets/img/Revolutionary_logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Revolutionary</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="home.php">Home<br></a></li>
          <li><a href="portfolio.php">Gallery</a></li>
          <li><a href="Dashboard.php"class="active">Uploads</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="profile.php">Profile</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>



    </div>
  </header>

</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background: #1e1e1e;">
    <div style="max-width: 900px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <p style="text-align: right; margin: 0;">
            Selamat Datang <strong><?php echo htmlspecialchars($_SESSION['Username']); ?></strong> | 
        </p>
        <hr style="border: none; height: 1px; background: #ddd; margin: 20px 0;">
        
        <h3 style="margin: 0 0 20px; color: #333;">Unggah Foto Baru</h3>
        <form action="upload.php" method="POST" enctype="multipart/form-data" 
              style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">

            <div style="flex: 1 1 45%; display: flex; flex-direction: column;">
                <label for="judul" style="color: #555; margin-bottom: 5px;">Judul Foto:</label>
                <input type="text" id="judul" name="judul" placeholder="Masukkan judul foto" required 
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
            </div>

            <div style="flex: 1 1 48%; display: flex; flex-direction: column;">
                <label for="tanggal" style="color: #555; margin-bottom: 5px;">Tanggal Unggah:</label>
                <input type="date" id="tanggal" name="tanggal" required 
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
            </div>

            <div style="flex: 1 1 100%; display: flex; flex-direction: column;">
                <label for="deskripsi" style="color: #555; margin-bottom: 5px;">Deskripsi Foto:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi foto" required 
                          style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;"></textarea>
            </div>

            <div style="flex: 1 1 45%; display: flex; flex-direction: column;">
                <label for="foto" style="color: #555; margin-bottom: 5px;">Upload Foto:</label>
                <input type="file" id="foto" name="foto" required 
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
            </div>

            <div style="flex: 1 1 48%; display: flex; flex-direction: column;">
                <label for="album" style="color: #555; margin-bottom: 5px;">Album:</label>
                <select name="album" id="album" required 
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
                    <?php
                    $query = "SELECT * FROM album";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['AlbumID']}'>{$row['NamaAlbum']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div style="flex: 1 1 100%; text-align: right;">
                <button type="submit" 
                        style="padding: 10px 20px; background: #4caf50; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
            </div>
        </form>
        
        <hr style="border: none; height: 1px; background: #ddd; margin: 20px 0;">

        <h3 style="margin: 0 0 20px; color: #333;">Foto yang Telah Diupload</h3>
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Ambil UserID dari sesi
$userID = $_SESSION['UserID'];

// Sertakan file koneksi database
include "koneksi.php";

// Periksa apakah koneksi berhasil
if (!$con) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil foto hanya milik pengguna yang sedang login
$query = "
    SELECT 
        foto.FotoID, 
        foto.JudulFoto, 
        foto.DeskripsiFoto, 
        foto.TanggalUnggah, 
        foto.LokasiFoto, 
        album.NamaAlbum, 
        user.Username, 
        (SELECT COUNT(*) FROM likefoto WHERE likefoto.FotoID = foto.FotoID) AS JumlahLike, 
        (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.FotoID = foto.FotoID) AS JumlahKomentar
    FROM foto
    INNER JOIN album ON foto.AlbumID = album.AlbumID
    INNER JOIN user ON foto.UserID = user.UserID
    WHERE foto.UserID = $userID
";

$result = mysqli_query($con, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <div style='flex: 1 1 calc(20% - 20px); max-width: 500px; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);'>
            <img src='uploads/{$row['LokasiFoto']}' alt='{$row['JudulFoto']}' style='width: 100%; border-radius: 10px;'>
            <h4 style='margin: 15px 0 10px; color: #333;'>{$row['JudulFoto']}</h4>
            <p style='margin: 0 0 10px; color: #555;'>{$row['DeskripsiFoto']}</p>
            <p style='margin: 0; font-size: 14px; color: #777;'>Tanggal: {$row['TanggalUnggah']}</p>
            <p style='margin: 0; font-size: 14px; color: #777;'>Album: {$row['NamaAlbum']}</p>
            <p style='margin: 0; font-size: 14px; color: #777;'>Diupload oleh: {$row['Username']}</p>
            <p style='margin: 10px 0 0; font-size: 14px; color: #777;'>Likes: {$row['JumlahLike']} | Komentar: {$row['JumlahKomentar']}</p>
            <div style='margin-top: 10px; text-align: right;'>
                <a href='edit.php?id={$row['FotoID']}' style='color: #007bff; text-decoration: none; margin-right: 10px;'>Edit</a>
                <a href='delete.php?id={$row['FotoID']}' style='color: #ff6f61; text-decoration: none;' onclick='return confirmDelete()'>Delete</a>
            </div>
        </div>";
    }
    ?>
</div>
            </tbody>
        </table>
        <?php
            if (isset($_SESSION['message'])) {
                echo "<p style='color: #4caf50; margin-top: 20px;'>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus foto ini?");
        }
    </script>
</body>
</html>
