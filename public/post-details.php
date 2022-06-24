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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Post Details</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a97da01e51.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <?php include 'layout/header.php'; ?>

    <?php
    $id = intval($_GET['id']);
    $s = 1;
    $sql1 = "SELECT posts.* FROM posts WHERE posts.id=:id AND posts.status=:s";
    $query = $pdo->prepare($sql1);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':s', $s, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
    ?>
            <?php if (htmlentities($result->image1) == null) { ?>
                <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
                <?php
            } else { ?>
                    <header class="masthead" style="background-image:url('assets/img/postimages/<?php echo htmlentities($result->image1); ?>');">
                    <?php
                } ?>
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
                    <!-- Header -->

                    <article>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-lg-8 mx-auto">

                                    <div class="post-preview">
                                        <h2 class="post-title"><?php echo htmlentities($result->title); ?></h2>
                                        <p class="post-meta">Posted by&nbsp;<b><?php echo htmlentities($result->author); ?></b>
                                            on <?php echo htmlentities($result->published_date); ?>
                                        </p>
                                        <!-- <p style="font-weight: bold;"><?php echo htmlentities($result->content); ?></p>                                        -->
                                        <p style="text-align: justify;"><?php echo htmlentities($result->content); ?></p>
                                        <p class="post-meta">Posted by&nbsp;<?php echo htmlentities($result->author); ?>
                                            on <?php echo htmlentities($result->published_date); ?>
                                        </p>
                                    </div>
                            <?php }
                    } ?>
                                </div>

                            </div>
                    </article>

                    <!-- Footer -->
                    <?php include 'layout/footer.php'; ?>

                    <script src="assets/js/jquery.min.js"></script>
                    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                    <script src="assets/js/clean-blog.js"></script>
</body>

</html>