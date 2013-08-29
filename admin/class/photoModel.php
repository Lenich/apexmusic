<?php

class photoModel {
    static public function dbAddImage($image) {
        $image = mysql_real_escape_string($image);
        
        $query = "INSERT INTO `photo` (`id`, `name`) VALUES (NULL, '{$image}');";
        mysql_query($query);
        return mysql_insert_id();
    }
    
    static public function dbGetImage($id = "*") {
        return self::getById("id, name", "photo", $id);
    }
    
    static public function dbGetSlider($id = "*") {
        return self::getById("id, photo, description", "slider", $id);
    }
    
    static public function dbGetReview($id = "*") {
        return self::getById("id, photo, title, description", "review", $id);
    }
    
    static protected function getById($select, $from, $id) {
        $query  = "SELECT {$select} FROM `{$from}`";
        $idtype = 0;
        if($id != "*") {
            if(is_array($id)) {
                $str_id = mysql_real_escape_string(implode(",", $id));
                $query .= " WHERE `id` IN ({$str_id})";
            } else {
                $str_id = mysql_real_escape_string($id);
                $query .= " WHERE `id` = {$str_id}";
                $idtype = 1;
            }
        }

        $res = mysql_query($query);
        if(mysql_num_rows($res) == 0) return FALSE;
        
        switch($idtype) {
            // Many
            case 0:
                $responce = array();
                while ($row = mysql_fetch_object($res)) {
                    $responce[] = $row;
                }
                break;
            
            case 1:
                $responce = mysql_fetch_object($res);
                break;
        }
        
        return $responce;
    }
}