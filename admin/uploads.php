<?php require_once(__DIR__ . "/includes/init.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php
if(isset($_FILES['file-upload']) && !isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = isset($_POST['title']) ? $_POST['title'] : '';
    $photo->set_file($_FILES['file-upload']);

    if($photo->save()) {
        echo "Photo uploaded successfully";
    } else {
        echo join("<br>", $photo->errors);
    }
    exit;
}

?>

<?php include(__DIR__ . "/includes/header.php"); ?>

<?php 

$message = "";
if(isset($_POST['file'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);

    if($photo->save()) {
        $message = "Photo uploaded successfully";
    } else {
        $message = join("<br>", $photo->errors);
    }
}

?>





        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include(__DIR__ . "/includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include(__DIR__ . "/includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

         <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Uploads
                        </h1>

                    <div class="row">

  
                    <div class="col-md-6">

                    <div id="upload-message"><?php echo $message; ?></div>

                        <form
                        action="uploads.php" method="post" enctype="multipart/form-data"
                        >
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="file" name="file" />
                            </div>


                            
                            <input type="submit" name="submit" />
                        

                        </form>
                    </div>
                </div><!-- end of row -->

                <div class="row">
                    <div class="col-lg-12"></div>
                    <form action="uploads.php" class="dropzone" id="photo-dropzone"></form>
                </div>





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            

        </div>
        <!-- /#page-wrapper -->

    <?php include(__DIR__ . "/includes/footer.php"); ?>