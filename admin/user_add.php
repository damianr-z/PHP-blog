<?php include(__DIR__ . "/includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

$user = new User();

if(isset($_POST['create'])) {
   if($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];

        if(isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
            $user->set_file($_FILES['user_image']);
            $user->photo_uploader();
        }
        $session->message("The user {$user->username} has been created");
        $user->save();
        redirect("users.php");
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
                    Users
                </h1>

                <p class="bg-success"><?php echo $message; ?></p>

                <div class="col-md-6 user_image_box">
                <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_placeholder_path(); ?>" alt=""></a>

                </div>
                 
                <form action="" method='post' enctype="multipart/form-data">

                    <div class="col-md-6">
                    
                    <div class="form-group">     
                        <input type="file" name="user_image">
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>    
                        <input type="text" name='username' class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>    
                        <input type="text" name='first_name' class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>    
                        <input type="text" name='last_name' class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>    
                        <input type="password" name='password' class="form-control">
                    </div>


                    <div class="form-group"> 
                        <input type="submit" name='create' class="btn btn-primary pull-right">
                    </div>
                    
                </div>
            </form>

            </div>
            <!-- /.side_menu -->
        
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    

</div>
<!-- /#page-wrapper -->

<?php include(__DIR__ . "/includes/footer.php"); ?>