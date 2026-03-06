<?php require_once("admin/includes/init.php"); ?>
<?php include_once("includes/header.php"); ?>

<?php
$photos = Photo::find_all();
$comments = [];
?>

            <!-- Blog Entries Column -->
<div class="row">

    
                 <!-- Blog Post Content Column -->
    <div class="col-md-12 ">

                <!-- Blog Post -->

        <div class="thumbnails row">

               <?php foreach($photos as $photo): ?>



                <div class="col-xs-6 col-md-3">

                <a href="photo.php?id=<?php  echo $photo->id; ?>" class="thumbnail">
                    <img class="home_page_photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                </a>

                </div>

                <?php endforeach; ?>

                <?php if(empty($photos)): ?>
                    <p>No photos found.</p>
                <?php endif; ?>
        </div>



    </div>
          
         
    
</div>




<!-- Blog Sidebar Widgets Column -->
<!-- <div class="col-md-4"> -->
    
    
    <?php // include("includes/sidebar.php"); ?>
    
    
    
<!-- </div> -->
<!-- /.row -->


<?php include("includes/footer.php"); ?>