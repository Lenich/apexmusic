<?php
/**
 * @author Yakud <yakudgm@gmail.com>
 */
class Controller {
    public $is_ajax = FALSE;
    
    protected $result = "";
    protected $js = array();
    protected $css = array();
    
    public function __construct() {
        
    }
    
    public function getResult() {
        return $this->result;
    }
    
    public function addResult($res = "") {
        $this->result .= $res;
    }
    
    protected function render($template, $arr = array()) {
        foreach ($arr as $key => $val) {
            $$key = $val;
        }
        
        ob_start();
        include "/templ/controller/{$template}.php";
        return ob_get_clean();        
    }
    
    public function js($file = "") {
        if($file == "") {
            return $this->js;
        } else {
            $this->js[] =  strpos($file, "ttp") ? $file : "./assets/".$file;
        }
        return $this;
    }
    
    public function css($file = "") {
        if($file == "") {
            return $this->css;
        } else {
            $this->css[] = strpos($file, "ttp") ? $file : "./assets/".$file;
        }
        return $this;
    }
}
