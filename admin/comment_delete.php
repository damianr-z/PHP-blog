<?php include(__DIR__ . "/includes/init.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("comment.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $commment->delete();
    $session->message("The comment with {$comment->id} has been deleted");
    redirect("comment_photo.php");
} else {
    redirect("comments.php");
}


?>