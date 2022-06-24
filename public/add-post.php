<?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
include '../src/config.php';
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} //strlen( $_SESSION[ 'login' ] ) == 0
else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        $email3 = $_SESSION['login'];


        $sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
        $query3 = $pdo->prepare($sql3);
        $query3->bindParam(':email3', $email3, PDO::PARAM_STR);
        $query3->execute();
        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
        if ($query3->rowCount() > 0) {
            foreach ($results3 as $result3) {
                $uid = $result3->id;
            }
        }


        $status = 0;

        $sql = "INSERT INTO posts(title,content,author,userid,status) VALUES(:title,:content,:author,:userid,:status)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':userid', $uid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog submitted successfully, wait for approval');document.location = 'index.php';</script>";
        } //$lastInsertId
        else {
            echo "<script>alert('Something went wrong')</script>";
        }
    } //isset( $_POST[ 'submit' ] )
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Add Post</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/a97da01e51.js" crossorigin="anonymous"></script>
        <script src="assets/js/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            });
        </script>
    </head>

    <body>
        <!-- Header -->
        <?php
        include 'layout/header.php';
        ?>

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
        <!-- Header -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <h2 class="post-title">Add a post</h2>
                    <form id="contactForm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title" required placeholder="Title" name="title">
                                <small class="form-text text-danger help-block">Title</small>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" required placeholder="Content" name="content"></textarea>
                                <small class="form-text text-danger help-block">Content</small>
                            </div>
                        </div>
                        <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT fname,lname,id FROM users WHERE email=:email ";
                        $query = $pdo->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result2) {
                                $name = $result2->fname . " " . $result2->lname; ?>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls">
                                        <label for="name">Username</label>
                                        <input class="form-control" type="text" id="name" required name="name" value="<?php echo htmlentities($name); ?>">
                                        <small class="form-text text-danger help-block">Username</small>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" id="sendMessageButton" type="submit" name="submit">Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php
        include 'layout/footer.php';
        ?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/clean-blog.js"></script>
    </body>

    </html>

<?php
}
?>