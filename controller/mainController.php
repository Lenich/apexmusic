<?php

class mainController extends Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $slider = array();
        $slider_templ = "";
        $query = "SELECT * FROM `slider`";
        $res   = mysql_query($query);
        while ($row = mysql_fetch_object($res)) {
            $slider[] = $row;
            
            $query = "SELECT * FROM `photo` WHERE `id`='{$slider[count($slider)-1]->photo}'";
            $res_photo = mysql_query($query);
            while($photo = mysql_fetch_object($res_photo)) {
                $slider_templ .= $this->render("main/slider", array(
                    "photo" => $photo->name,
                    "description" => $row->description
                ));
            }
        }
        
        echo $this->render("main/main", array(
            "slider" => $slider_templ
        ));
    }
}
