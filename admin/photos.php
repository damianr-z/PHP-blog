<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

$photos = Photo::find_all();


?>


        <!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php include("includes/top_nav.php") ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    
    <?php include("includes/side_nav.php") ?>

    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

            <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos
                    <small>Subheading</small>
                </h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Photo</td>
                            <td>Id</td>
                            <td>File Name</td>
                            <td>Title</td>
                            <td>Size</td>
                            <td>Comments</td>
                        </tr>
                    </thead>
                        <tbody>

                        <?php foreach ($photos as $photo) : ?>
                            <tr>
                            <td>
                                <img class="admin_photo_thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="" />
                                <div class="action_links">
                                    <a href="photo_delete.php?id=<?php echo $photo->id; ?>">Delete</a>
                                    <a href="photo_edit.php?id=<?php echo $photo->id; ?>">Edit</a>
                                    <a href="../photo.php?id=<?php echo $photo->id;?>">View</a>
                                </div>
                            </td>
                                <td><?php echo $photo->id;?></td>
                                <td><?php echo $photo->filename;?></td>
                                <td><?php echo $photo->title;?></td>
                                <td><?php echo $photo->size;?></td>
                                <td>
                                    <a href="comment_photo.php?id=<?php echo $photo->id; ?>"><?php
                                $comments = Comment::find_the_comments($photo->id);
                                echo count($comments);
                                ?></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                </table>


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>