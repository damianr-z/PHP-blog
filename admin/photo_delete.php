<?php include(__DIR__ . "/includes/init.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id((int) $_GET['id']);

if($photo) {
    if ($photo->delete_resource()) {
        $session->message("The photo {$photo->filename} has been deleted");
    } else {
        $session->message("The photo could not be deleted");
    }
    redirect("photos.php");
} else {
    redirect("photos.php");
}

?>