<?php 

class Photo extends Db_object {
    protected static $db_table = "photos";
    protected static $db_table_id = "id";
    protected static $db_table_fields = array("id", "title", "caption", "description", "filename", "alternate_text", "type", "size", "user_id");
    public $id;
    public $title;
    public $caption; 
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    public $tmp_path;
    public $uploads_directory = "images";
    public $user_id;

    //thi si passing $_FILES['uploaded_file'] as an argument

    public function __construct() {
        $this->user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function set_file($file) {

        if(empty($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } else if ($file['error'] != 0 ) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }


    public function picture_path() {
        return $this->uploads_directory . '/' . $this->filename;
    }

    public function save() {
        if($this->id) {
            $this->update();
        } else {
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "There was no file uploaded here";
                return false;
            }

            // this is the permanent path
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->uploads_directory . DS . $this->filename; 
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                } 
            } else {
                $this->errors[] = "The file directory does not have permission";
                return false;
            }

        } 
    }

    public function delete_resource() {
        if (!$this->delete()) {
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
        if (file_exists($target_path)) {
            return unlink($target_path);
        }

        return true;
    }

    public static function display_sidebar_data($photo_id) {
        $photo = Photo::find_by_id($photo_id);
        // $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}' /></a>";
         $output = "<h4 class='modal-title'>Photo Information</h4>";
        $output .= "<ul class='modal-list'><li>{$photo->filename}</li>";
        $output .= "<li>{$photo->type}</li>";
        $output .= "<li>{$photo->size}</li></ul>";

        echo $output;
    }


}



?>