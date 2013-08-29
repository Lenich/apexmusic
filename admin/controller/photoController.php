<?php
include_once './class/photoModel.php';

class photoController extends Controller {
    protected $upload_dir   = "",
              $upload_url   = "",
              $upload_thumb = "thumb/",
              $accept_file_types = '/\.(gif|jpe?g|png)$/i';

    public function __construct() {
        parent::__construct();
        $this->upload_dir = $_SERVER["DOCUMENT_ROOT"]."/assets/img/upload/";
        $this->upload_url = "http://".$_SERVER["HTTP_HOST"]."/assets/img/upload/"; 
    }
    
    public function index() {
        $this->css("jquery_file_upload/css/jquery.fileupload-ui.css")
             ->css("css/photo.css")
             ->js("jquery_ui/jquery-ui.min.js")
             ->js("jquery_file_upload/js/jquery.iframe-transport.js")
             ->js("jquery_file_upload/js/jquery.fileupload.js");
        
        echo $this->render("photo/main", array(
            "content" => $this->renderImages()
        ));
    }
    
    public function upload() {
        $this->is_ajax = TRUE;
        
        require('./assets/jquery_file_upload/server/php/UploadHandler.php');

        $upload_handler = new UploadHandler(array(
            "upload_dir" => $this->upload_dir,
            "upload_url" => $this->upload_url,
            "accept_file_types" => $this->accept_file_types,
            "callback_done" => function($file) {
                $file->id   = photoModel::dbAddImage($file->name);
                $file->view = $this->renderImage($file);
                return $file;
            }
        ));    
    }
    
    public function delete() {
        $id = mysql_real_escape_string($_GET['id']);
        $query = "DELETE FROM `photo` WHERE `id` = {$id}";
        mysql_query($query);
        mysql_errno();
        $this->is_ajax = TRUE;
        echo mysql_errno() ? mysql_errno() : 1;
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
        return $this->render("photo/photo_show", array(
            "image" => $this->upload_url.$this->upload_thumb.$image->name,
            "id"    => $image->id
        ));
    }
}