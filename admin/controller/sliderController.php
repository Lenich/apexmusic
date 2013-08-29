<?php
include_once './class/photoModel.php';

class sliderController extends Controller {
    protected $upload_dir   = "",
              $upload_url   = "",
              $upload_thumb = "thumb/";
      
    public function __construct() {
        parent::__construct();
        $this->upload_dir = $_SERVER["DOCUMENT_ROOT"]."/assets/img/upload/";
        $this->upload_url = "http://".$_SERVER["HTTP_HOST"]."/assets/img/upload/"; 
    }
    
    public function index() {
        echo $this->render("slider/main", array(
            "images" => $this->renderImages()
        ));
    }
    
    public function select() {
        $this->is_ajax = TRUE;
        
        $id = mysql_real_escape_string($_GET['id']);
        
        $query  = "SELECT `id` FROM `slider` WHERE `photo`={$id}";
        $res    = mysql_query($query);
        if(mysql_num_rows($res)) {
            $query = "DELETE FROM `slider` WHERE `photo` = {$id}";
            $res   = mysql_query($query);
            echo 0;
        } else {
            $query = "INSERT INTO `slider` (`id`, `photo`) VALUES (NULL, '{$id}');";
            $res   = mysql_query($query);
            echo 1;
        }
    } 
    
    public function description() {
        $this->is_ajax = TRUE;
        
        $id = mysql_real_escape_string($_GET['id']);
        $descr = mysql_real_escape_string($_POST['description']);
        
        $query = "UPDATE `slider` SET `description`=\"{$descr}\" WHERE `photo`={$id}";

        mysql_query($query);
        echo 1;
    }


    protected function renderImages() {
        $slides = photoModel::dbGetSlider();
        $slides_photos = array();
        $slides_descriptions = array();
        
        if($slides)
        foreach ($slides as $slide) {
            $slides_photos[] = $slide->photo;
            $slides_descriptions[$slide->photo] = $slide->description;
        }
        
        $images = photoModel::dbGetImage();
        $images = !is_array($images) && $images != FALSE ? array($images) : $images;
        $responce = "";

        if($images != FALSE)
        foreach ($images as $image) {
            $image->in_slides = FALSE;
            if(in_array($image->id, $slides_photos)) {
                $image->in_slides = TRUE;
                $image->description = $slides_descriptions[$image->id];
            }
            $responce .= $this->renderImage($image);
        }
        
        $responce = $this->render("photo/photo_show_wrapper", array(
            "content" => $responce
        ));
        
        return $responce;
    }
    
    protected function renderImage($image) {
        return $this->render("slider/photo_show", array(
            "image" => $this->upload_url.$this->upload_thumb.$image->name,
            "id"    => $image->id,
            "in_slides" => $image->in_slides,
            "description" => $image->description
        ));
    }
}