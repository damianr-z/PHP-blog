<?php require_once("init.php");

if (isset($_POST['photo_id'])) {
    Photo::display_sidebar_data($_POST['photo_id']);
    exit;
}

if(isset($_POST['image_name'], $_POST['user_id'])) {
    $user = User::find_by_id((int)$_POST['user_id']);

    if($user) {
        $user->ajax_save_user_image($_POST['image_name'], (int)$_POST['user_id']);
        echo "saved";
    } else {
        echo "user not found";
    }
    exit;
}

echo "missing params";

?>