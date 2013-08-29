<?php
require_once '/class/Review.php';

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
        
        
        
        $all_id = Review::getAllId();
        $reviews_id = array();
        
        if (count($all_id) > 0) {
            $first_id = $all_id[rand(0, count($all_id)-1)];
            $reviews_id[] = $first_id;
            $second_id = -1;
        } else {
            $first_id = -1;
            $second_id = -1;
        }
        
        if (count($all_id) > 1) {
            do {
                $second_id = $all_id[rand(0, count($all_id)-1)];
            } while($second_id == $first_id);
            $reviews_id[] = $second_id;
        } else {
            if (count($all_id) == 1) {
                $second_id = -1;
            }
        }
        
        if($reviews_id) {
            $Reviews = $this->getReviews($reviews_id);
        } else {
            $Reviews = array();
        }
        
        echo $this->render("main/main", array(
            "slider" => $slider_templ,
            "reviews" => $Reviews,
        ));
    }

    /**
     * 
     * @param array $reviews_id
     * @return Review[]
     */
    private function getReviews(array $reviews_id) {
        $reviews = array();
        foreach ($reviews_id as $review_id) {
            $reviews[] = $this->getReview($review_id);
        }
        return $reviews;
    }
    
    
    private function getReview($id) {
        return new Review($id);
    }
}
