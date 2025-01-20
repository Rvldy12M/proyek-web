<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Revolutionary</title>

    <!-- Favicons -->
  <link href="assets/img/Revolutionary_logo.png" rel="icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #1e1e1e;
            padding: 10px 0;
            border-bottom: 1px solid #333;
            z-index: 1000;
        }

        .container-fluid {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo h1 {
            margin: 0;
            font-size: 20px;
            color: #ffffff;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #bbbbbb;
            font-size: 14px;
            padding: 5px;
        }

        nav ul li a.active, nav ul li a:hover {
            color: #ffffff;
            background-color: #444;
            border-radius: 4px;
        }

        .form-control1 {
            padding: 8px;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: #333;
            color: #ffffff;
        }

        .btn-primary {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            background-color: #757375;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #ff4b3a;
        }

        .profile-container {
            width: 100%;
            max-width: 720px;
            background-color: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 100px auto 50px; /* Tambahkan margin atas untuk memberi jarak dari navbar */
        }

        .profile-header {
            display: flex;
            padding: 20px;
            background-color: #1e1e1e;
            border-bottom: 1px solid #333;
            position: relative;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 20px;
        }

        .profile-info h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
        }

        .stats {
            display: flex;
            gap: 20px;
        }

        .bio {
            font-size: 14px;
            color: #bbbbbb;
        }

        .gallery {
            column-count: 2;
      column-gap: 20px;
      padding: 10px;
      max-width: 1200px;
      margin: 0 auto;
        }

        .gallery img {
            width: 100%;
      height: auto;
      border-radius: 8px 8px 0 0;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            right: 50px;
            background-color: #ff6f61;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #ff4b3a;
        }
    </style>
</head>
<body>
    <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "gallerydb_plusdummy");

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        session_start();
        $userID = $_SESSION['UserID'];

        $userQuery = "SELECT * FROM user WHERE UserID = $userID";
        $userResult = $conn->query($userQuery);
        $userData = $userResult->fetch_assoc();

        $postsQuery = "SELECT COUNT(*) AS total_posts FROM foto WHERE UserID = $userID";
        $postsResult = $conn->query($postsQuery);
        $postsData = $postsResult->fetch_assoc();

        $followers = 99999999;
        $following = 0;

        $albumsQuery = "SELECT AlbumID, NamaAlbum, Deskripsi FROM album WHERE UserID = $userID";
        $albumsResult = $conn->query($albumsQuery);

        $photosQuery = "SELECT FotoID, JudulFoto, LokasiFoto FROM foto WHERE UserID = $userID";
        $photosResult = $conn->query($photosQuery);


    ?>

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
          <li><a href="dashboard.php">Uploads</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="profile.php" class="active">Profile</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>


    <div class="profile-container">
        <header class="profile-header">
            <div class="profile-pic"></div>
            <div class="profile-info">
                <h2><?php echo $userData['Username']; ?></h2>
                <div class="stats">
                    <div><strong><?php echo $postsData['total_posts']; ?></strong> posts</div>
                    <div><strong><?php echo $followers; ?></strong> followers</div>
                    <div><strong><?php echo $following; ?></strong> following</div>
                </div>
                <div class="bio">
                    <p><?php echo $userData['NamaLengkap']; ?><br><?php echo $userData['Alamat']; ?></p>
                </div>
            </div>
            <a href="logout.php" class="logout-button">Logout</a>
        </header>

        <div class="gallery">
            <h3>Foto</h3>
            <div class="grid">
                <?php
                if ($photosResult->num_rows > 0) {
                    while ($photo = $photosResult->fetch_assoc()) {
                        echo "
                        <div class='grid-item'>
                            <img src='uploads/{$photo['LokasiFoto']}' alt='{$photo['JudulFoto']}'>
                            <div class='info'>{$photo['JudulFoto']}</div>
                        </div>";
                    }
                } else {
                    echo "<p>Tidak ada foto.</p>";
                }
                ?>
            </div>
        </div>
    <?php $conn->close(); ?>
    
</body>
</html>
