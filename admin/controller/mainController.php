<?php

class mainController extends Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        mysql_query("SET NAMES utf8");
        mysql_query("SET COLLATION_CONNECTION=utf8_bin");
        
        $query = "SELECT * FROM `options`";
        $res = mysql_query($query);
        $responce = array();
        while($row = mysql_fetch_object($res)) {
            $responce[$row->variable] = $row;
        }
        
        echo $this->render("main", array(
            "variable" => $responce
        ));
    }
    
    public function save() {
        $this->is_ajax = TRUE;
        
        $value = mysql_real_escape_string($_POST['value']);
        $variable = mysql_real_escape_string($_POST['variable']);
        
        $query = "INSERT INTO `options` (`variable`, `value`) VALUES ('{$variable}', '{$value}') 
                  ON DUPLICATE KEY UPDATE `variable`='{$variable}', `value`='{$value}';";
        mysql_query($query);          
        $err = mysql_errno();
        
        echo $err ? $err : 1;
    }
}