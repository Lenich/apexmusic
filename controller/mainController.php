<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/class/Review.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/class/PopupSignup.php';

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
        
        $Popup = new PopupSignup(
                "popup/signup", 
                "Запишись на урок!", 
                $this->render("popup/signupBody", array(
                    
                ))
        );
        
        echo $this->render("main/main", array(
            "slider" => $slider_templ,
            "reviews" => $Reviews,
            "popup" => $Popup,
        ));
    }
    
    public function signUp() {
        $this->is_ajax = true;
        $all_subj = array(
            1 => "Гитара",
            2 => "Вокал",
            3 => "Фортепиано",
            4 => "Общая подготовка",
        );
        $name = mysql_real_escape_string($_POST['myName']);
        $old = mysql_real_escape_string($_POST['myOld']);
        $subj = mysql_real_escape_string($_POST['mySubj']);
        if(in_array($subj, $all_subj)) {
            $subj = $all_subj[$subj];
        } else {
            $subj = "*не выбран предмет*";
        }
        $phone = mysql_real_escape_string($_POST['myPhone']);
        $other = mysql_real_escape_string($_POST['myOther']);
        
        $options = $this->getOptions();
        
        $mail = $options['email']->value; 
        $Bubj1 = sprintf($options['title_mail']->value, $name); 
        $mess1 = sprintf($options['body_mail']->value, $name, $old, $subj, $phone, $other); 
        $head1 = sprintf($options['title_mail']->value, $name);

        if(mail($mail, $Bubj1, $mess1, $head1, sendmail)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    private function getOptions() {
        $query = "SELECT * FROM `options` ORDER BY `num` ASC ";
        $res = mysql_query($query);
        $responce = array();
        while($row = mysql_fetch_object($res)) {
            $responce[$row->variable] = $row;
        }
        return $responce;
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
