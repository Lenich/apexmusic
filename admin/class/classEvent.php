<?php
/**
 * @author Yakud <yakudgm@gmail.com>
 */
class classEvent {
    private $event, 
            $action;
    
    /**
     * @var Controller
     */
    public $class;
    
    public function __construct($event = "main", $action = "index") {
        $this->event  = $event  == "" ? "main"  : $event;
        $this->action = $action == "" ? "index" : $action;
    }
    
    
    public function run() {
        $class  = $this->event."Controller";
        $action = $this->action;
        $file   = "controller/{$class}.php";

        if(file_exists($file)){
            require_once $file;
            if(class_exists($class)) {
                $this->class = new $class();
                if(method_exists($this->class, $action)) {
                    ob_start();
                        $res = $this->class->$action();
                    $this->class->addResult(ob_get_clean());
                } else {
                    throw new Exception("Method \"{$action}\" in class \"{$class}\" not found!");
                }
            } else {
                throw new Exception("Class \"{$class}\" not found!");
            }
        } else {
            throw new Exception("File \"{$file}\" not found!");
        }
    }
    
    public function getResult() {
        return $this->class->getResult();
    }
    
    public function getJS() {
        $js_files = $this->class->js();
        $result   = "";
        foreach ($js_files as $js) {
            $result .= "<script src='{$js}'></script>";
        }
        return $result;
    }
    
    public function getCSS() {
        $css_files = $this->class->css();
        $result   = "";
        foreach ($css_files as $css) {
            $result .= "<link rel=\"stylesheet\" media=\"screen\" href=\"{$css}\">";
        }
        return $result;
    }
}
