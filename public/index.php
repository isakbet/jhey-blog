<?php
session_set_cookie_params(0);
session_start();
include '../src/config.php';
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
  <!-- Styling for publika sidan -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/a97da01e51.js" crossorigin="anonymous"></script>
  <title>Jhey's-blog | Home</title>
</head>

<body>
  <!-- Header -->
  <?php include 'layout/header.php'; ?>
  <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
          <div class="site-heading">
            <h1>Jhey's Blog</h1><span class="subheading">Personal Blog</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="row">
      </div>
      <div class="row">
        <?php
        $s = 1;
        $sql = "SELECT posts.* FROM posts WHERE posts.status=:s ORDER BY posts.id DESC LIMIT 3";
        $query = $pdo->prepare($sql);
        $query->bindParam(':s', $s, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $result) {
        ?>
            <div class="col-md-10 col-lg-12">
              <div class="post-preview">
                <a href="post-details.php?id=<?php echo htmlentities($result->id); ?>">
                  <h2 class="post-title"><?php echo htmlentities($result->title); ?></h2>
                </a>
                <p class="post-meta">Posted by&nbsp;<?php echo htmlentities($result->author); ?>
                  on <?php echo htmlentities($result->published_date); ?>
                </p>
              </div>
              <hr>
            </div>
        <?php
          }
        } ?>
        <div class="col-md-10 col-lg-12">
          <div class="clearfix">
            <a href="#">
              <button class="btn btn-primary float-right" type="button">Read more&nbsp;???</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer>
  </footer>
  <!-- Footer -->
  <?php include 'layout/footer.php'; ?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/clean-blog.js"></script>

</body>

</html>