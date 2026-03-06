<?php include(__DIR__ . "/includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include(__DIR__ . "/includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include(__DIR__ . "/includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <?php include(__DIR__ . "/includes/admin_content.php")?>
            

        </div>
        <!-- /#page-wrapper -->

    <?php include(__DIR__ . "/includes/footer.php"); ?>