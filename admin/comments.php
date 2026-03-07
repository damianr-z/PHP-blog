<?php include(__DIR__ . "/includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");}  ?>

<?php 

$comments = Comment::find_all();

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
                            Comments
                        </h1>



            <div class="col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Author</td>
                            <td>Body</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : ?>
                        <tr>
                            <td><?php echo $comment->id; ?></td>     
                            <td><?php echo $comment->author; ?>                            
                                <div class="action_links">
                                    <a href="comment_delete.php?id=<?php echo $comment->id; ?>">Delete</a>
                                    <!-- <a href="user_edit.php?id=COMMENT_ID">Edit</a> -->
                                </div>
                            </td>
                                
                            <td><?php echo $comment->body; ?></td>
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