<?php include(__DIR__ . "/includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

$users = User::find_all();


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

                <a href="user_add.php" class="btn btn-primary">Add User</a>
            <div class="col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Image</td>
                            <td>Username</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user->id;?></td>
                            <td><img class="img_thumbnail" src="<?php echo $user->image_placeholder_path(); ?>" alt="" /></td>
                                
                            <td><?php echo $user->username;?>                            
                                <div class="pictures_link">
                                    <a href="user_delete.php?id=<?php echo $user->id; ?>">Delete</a>
                                    <a href="user_edit.php?id=<?php echo $user->id; ?>">Edit</a>
                                    <a href="user.php?id=<?php echo $user->id; ?>">view</a>
                                </div>
                            </td>
                                
                            <td><?php echo $user->first_name;?></td>
                            <td><?php echo $user->last_name;?></td>
                        </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
             </div>


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    

</div>
<!-- /#page-wrapper -->

<?php include(__DIR__ . "/includes/footer.php"); ?>