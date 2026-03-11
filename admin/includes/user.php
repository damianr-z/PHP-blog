<?php 

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_id = "id";
    protected static $db_table_fields = array('id', 'username', 'password', 'first_name', "last_name", "user_image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $filename;
    public $tmp_path = '';
    public $uploads_directory = "images";
    public $image_placeholder = "https://placeholdit.com/600x400/?text=No+Image";

    //this id passing $_FILES['uploaded_file'] as an argument

    public function set_file($file) {
        parent::set_file($file);

        if(!empty($this->errors)) {
            return false;
        }

        $this->user_image = $this->filename;
        return true;
    }

    public function photo_uploader() {

            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "There was no file uploaded here";
                return false;
            }

            // this is the permanent path
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->uploads_directory . DS . $this->user_image; 

            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->user_image} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path)) {
                    unset($this->tmp_path);
                    return true;
            } else {
                $this->errors[] = "The file directory does not have permission";
                return false;
            }
    }


    public function image_placeholder_path() {
        return empty($this->user_image) ? $this->image_placeholder : $this->uploads_directory . '/' . $this->user_image;
    }


    public static function verify_user($username,$password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        // First, find user by username only
        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        
        return !empty($the_result_array) ? array_shift($the_result_array) : false ;
    }

    public function ajax_save_user_image($user_image, $user_id) {

    global $database;
    
    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);
    $this->user_image = $user_image;
    $this->id = $user_id;
    
    $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
    $sql .= " WHERE id = {$this->id} ";
    $update_image = $database->query($sql);

    echo $this->image_placeholder_path();

    }



}

?>

