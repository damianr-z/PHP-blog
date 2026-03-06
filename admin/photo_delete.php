<?php include(__DIR__ . "/includes/init.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if($photo) {
    $photo->photo_delete();
    redirect("photos.php");
} else {
    redirect("photos.php");
}

?>