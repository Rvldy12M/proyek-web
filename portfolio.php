<?php
include "koneksi.php";

// Query untuk mengambil album
$album_query = "SELECT AlbumID, NamaAlbum FROM album";
$album_result = mysqli_query($con, $album_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portfolio - CV. Revaldy</title>

  <!-- Favicons -->
  <link href="assets/img/Revolutionary_logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }

    .gallery {
      column-count: 4;
      column-gap: 20px;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .gallery-item {
      background: #fff;
      border-radius: 8px;
      display: inline-block;
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }

    .gallery-item img {
      width: 100%;
      height: auto;
      border-radius: 8px 8px 0 0;
    }

    .gallery-item h3 {
      font-size: 16px;
      margin: 10px;
      font-weight: 500;
      text-align: center;
    }

    @media (max-width: 992px) {
      .gallery {
        column-count: 2;
      }
    }

    @media (max-width: 576px) {
      .gallery {
        column-count: 1;
      }
    }
  </style>
</head>

<body>
  <header class="header d-flex align-items-center sticky-top shadow">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="home" class="logo d-flex align-items-center">
        <h1 class="sitename">Revolutionary</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul class="d-flex list-unstyled">
          <li><a href="home.php">Home</a></li>
          <li><a href="portfolio.php" class="active">Gallery</a></li>
          <li><a href="Dashboard.php">Uploads</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <?php while ($album = mysqli_fetch_assoc($album_result)) { ?>
              <li data-filter=".filter-<?php echo $album['AlbumID']; ?>"><?php echo $album['NamaAlbum']; ?></li>
            <?php } ?>
          </ul>

          <div class="gallery">
            <?php
            $query = "SELECT f.FotoID, f.LokasiFoto, f.JudulFoto, f.DeskripsiFoto, f.AlbumID 
                      FROM foto f 
                      ORDER BY f.TanggalUnggah DESC";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) { ?>
              <div class="gallery-item filter-<?php echo $row['AlbumID']; ?>" data-id="<?php echo $row['FotoID']; ?>">
                <img src="uploads/<?php echo $row['LokasiFoto']; ?>" alt="<?php echo $row['JudulFoto']; ?>">
                <h3><?php echo $row['JudulFoto']; ?></h3>
              </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="photoModalLabel">Photo Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img id="modal-image" src="" alt="Photo" class="img-fluid mb-3" style="max-height: 400px;">
          <h5 id="modal-title"></h5>
          <p id="modal-description"></p>
          <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-outline-primary like-btn" id="like-btn">
              <i class="bi bi-heart"></i> <span id="like-count">0</span> Like
            </button>
            <button class="btn btn-outline-secondary comment-btn">
              <i class="bi bi-chat"></i> Comment
            </button>
            <button class="btn btn-outline-success" id="share-btn"><i class="bi bi-share"></i> Share</button>
            <a id="download-btn" class="btn btn-outline-dark" href="#" download><i class="bi bi-download"></i> Download</a>
          </div>
          <div id="comment-section" class="mt-4" style="display: none;">
            <h6>Comments</h6>
            <ul id="comment-list" style="list-style: none; padding: 0;"></ul>
            <textarea id="new-comment" class="form-control mt-2" rows="2" placeholder="Write a comment..."></textarea>
            <button class="btn btn-primary mt-2" id="submit-comment">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer id="footer" class="footer accent-background">
    <div class="container">
      <div class="copyright text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Revolutionary</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Include jQuery and Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function () {
      // Load Modal Details
      $(".gallery-item").click(function () {
        const photoId = $(this).data("id");

        $.getJSON(`get_photo_data.php?id=${photoId}`, function (data) {
          $("#modal-image").attr("src", `uploads/${data.LokasiFoto}`).data("id", photoId);
          $("#modal-title").text(data.JudulFoto);
          $("#modal-description").text(data.DeskripsiFoto);
          $("#download-btn").attr("href", `uploads/${data.LokasiFoto}`);
          $("#like-count").text(data.LikeCount);
          $("#photoModal").modal("show");
        });
      });

      $("#like-btn").click(function () {
    const photoId = $("#modal-image").data("id");
    const userId = 1; // Ganti dengan ID user yang login saat ini

    $.post("toggle_like.php", { foto_id: photoId, user_id: userId }, function (response) {
        if (response.success) {
            $("#like-count").text(response.like_count);
            if (response.action === "liked") {
                $("#like-btn").removeClass("btn-outline-primary").addClass("btn-primary");
            } else {
                $("#like-btn").removeClass("btn-primary").addClass("btn-outline-primary");
            }
        } else {
            alert(response.error || "Failed to toggle like");
        }
    }, "json");
});


      // Show and Submit Comments
      $(".comment-btn").click(function () {
        const photoId = $("#modal-image").data("id");
        $("#comment-section").toggle();

        // Fetch comments
        $.getJSON(`get_comments.php?foto_id=${photoId}`, function (data) {
          const commentList = $("#comment-list");
          commentList.empty();
          data.forEach(comment => {
            commentList.append(`<li><strong>User</strong>: ${comment.IsiKomentar}</li>`);
          });
        }); 
      });

      $("#submit-comment").click(function () {
    const commentText = $("#new-comment").val();
    const photoId = $("#modal-image").data("id");

    if (commentText.trim() !== "") {
        $.post("add_comment.php", { foto_id: photoId, isi_komentar: commentText }, function (response) {
            if (response.success) {
                $("#new-comment").val(""); // Kosongkan textarea
                $("#comment-list").append(`<li><strong>User</strong>: ${response.isi_komentar}</li>`);
            } else {
                alert(response.error || "Failed to add comment");
            }
        }, "json");
    } else {
        alert("Comment cannot be empty.");
    }
});


      // Share Button
      $("#share-btn").click(function () {
        const photoUrl = $("#modal-image").attr("src");
        navigator.clipboard.writeText(photoUrl).then(() => {
          alert("Photo link copied to clipboard!");
        });
      });
    });

        document.addEventListener('DOMContentLoaded', function () {
        const filters = document.querySelectorAll('.portfolio-filters li');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function () {
                const filterValue = this.getAttribute('data-filter');

                filters.forEach(f => f.classList.remove('filter-active'));
                this.classList.add('filter-active');

                galleryItems.forEach(item => {
                    if (filterValue === '*' || item.classList.contains(filterValue.slice(1))) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
  </script>
</body>

</html>
