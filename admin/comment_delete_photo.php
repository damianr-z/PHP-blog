<?php include(__DIR__ . "/includes/init.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("comment.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $comment->delete_resource();
    $session->message("The comment with ID {$comment->id} has been deleted");
    redirect("comment_photo.php?id={$_GET['id']}");
} else {
    redirect("comment_photo.php?id={$_GET['id']}");
}


?>