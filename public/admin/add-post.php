<?php
session_set_cookie_params(0);
session_start();
include '../src/config.php';
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        $sql = "INSERT INTO posts (title, author, content) VALUES (:title, :author, :content)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog posted successfully');</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    } ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Add Post</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include "layout/sidebar.php"; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include "layout/header.php"; ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Add a Post</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Add a post</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data">

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Title</strong></label>
                                                                <input class="form-control" id="title1" type="text" placeholder="Enter title" name="title" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="author"><strong>Author</strong></label>
                                                                <input class="form-control" id="author" type="text" placeholder="Enter Author" name="author" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group"><label for="textarea1"><strong>Content</strong></label>
                                                                    <textarea class="form-control" id="textarea1" rows="4" name="content" style="height: 200px;" required></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit" name="submit">Add Post</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include "layout/footer.php"; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php
} ?>