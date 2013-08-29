<?php
include_once './class/photoModel.php';

class reviewController extends Controller {
    protected $upload_dir   = "",
              $upload_url   = "",
              $upload_thumb = "thumb/";
      
    public function __construct() {
        parent::__construct();
        $this->upload_dir = $_SERVER["DOCUMENT_ROOT"]."/assets/img/upload/";
        $this->upload_url = "http://".$_SERVER["HTTP_HOST"]."/assets/img/upload/"; 
    }
    
    public function index() {
        $this->css("css/review.css");
        
        echo $this->render("review/main", array(
            "content" => $this->renderReviews(),
            "photos" => $this->renderImages()
        ));
    }
    
    public function save() {
        $this->is_ajax = TRUE;
        
        $id = mysql_real_escape_string($_POST['id']);
        $photo = mysql_real_escape_string($_POST['photo']);
        $title = mysql_real_escape_string($_POST['title']);
        $description = mysql_real_escape_string($_POST['description']);
   
        if(!$photo) $photo = "NULL";
        
        $query = "UPDATE `review` "
                ."SET `photo`={$photo}, `title`='{$title}', "
                ."`description` = '{$description}'"
                ."WHERE `id`={$id}";
                
        mysql_query($query);
        $err = mysql_errno();
        echo $err ? $err : 1;
    }

    public function add() {
        $this->is_ajax = TRUE;
        
        $query = "INSERT INTO `review` (`id`, `photo`, `title`, `description`) VALUES (NULL, NULL, '', '');";
        mysql_query($query);
        
        $id = mysql_insert_id();
        $review = photoModel::dbGetReview($id);
        
        echo json_encode(array(
            "id" => $id,
            "view" => $this->renderReview($review)
        ));
    }

    public function delete() {
        $this->is_ajax = TRUE;
        
        $id = mysql_real_escape_string($_GET["id"]);
        
        $query = "DELETE FROM `review` WHERE `id` = {$id}";
        mysql_query($query);
        
        $err = mysql_errno();
        echo $err ? $err : 1;
    }

    protected function renderReviews() {
        $responce = "";
        $reviews = photoModel::dbGetReview();
        
        $images = photoModel::dbGetImage();
        $images = !is_array($images) && $images != FALSE ? array($images) : $images;
        $responce = "";
        $images_temp = array();
        
        foreach ($images as $image) {
            $images_temp[$image->id] = $image;
        }
        $images = $images_temp;
        unset($images_temp);   
        
        foreach ($reviews as $review) {
            $review->photo = $images[$review->photo];
            $responce .= $this->renderReview($review);
        }

        return $this->render("photo/photo_show_wrapper", array(
            "content" => $responce
        ));
    }
    
    protected function renderReview($review) {
        $image = $this->upload_url.$this->upload_thumb.$review->photo->name;
        $image_id = $review->photo->id ? $review->photo->id  : 0;
        
        if(!isset($review->photo->name)) {
            $image = "assets/img/no_photo.jpg";
        }
        
        return $this->render("review/review", array(
            "id" => $review->id,
            "image" => $image,
            "image_id" => $review->photo->id,
            "title" => $review->title,
            "description" => $review->description
        ));
    }
    
    protected function renderImages() {
        $images = photoModel::dbGetImage();
        $images = !is_array($images) && $images != FALSE ? array($images) : $images;
        $responce = "";

        if($images != FALSE)
        foreach ($images as $image) {
            $responce .= $this->renderImage($image);
        }
        
        $responce = $this->render("photo/photo_show_wrapper", array(
            "content" => $responce
        ));
        
        return $responce;
    }
    
    protected function renderImage($image) {
        return $this->render("review/photo_show", array(
            "image" => $this->upload_url.$this->upload_thumb.$image->name,
            "id"    => $image->id
        ));
    }
}