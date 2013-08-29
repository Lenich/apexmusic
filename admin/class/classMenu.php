<?php
/**
 * @author Yakud <yakudgm@gmail.com>
 */

class Menu {
    private $event_var  = "event";
    private $class_menu = "menu";
    private $menu_array = "";
    
    private $li_prefix = "<li>",
            $li_prefix_noactive = "<li class=\"active\">",
            $li_suffix = "</li>",
            $a_prefix  = "<a href=\"?event=",
            $a_postfix = "\">",
            $a_suffix  = "</a>";
    
    private $glue = "";
    private $result;
    
    public function __construct($menu_array) {
        $this->menu_array = $menu_array;
    }
    
    public function build() {
        $elements = $this->each_menu(function($elem) {
            return $this->build_element($elem);    
        });
        
        $elements = implode($this->glue, $elements);
        //$this->result = "<ul class=\"{$this->class_menu}\">".$elements."</ul>";
        
        $this->result = '
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Apex</a>
                    <ul class="nav">'.$elements.'</ul>
                </div>
                </div>
            </div>';
        
        return $this->result;
    }    
    
    public function getResult() {
        return $this->result == "" ? $this->build() : $this->result;
    }

    private function each_menu($fn) {
        $elements = array();
        foreach ($this->menu_array as $element) {
            $elements[] = $fn($element);
        }
        
        return $elements;
    }
    
    private function build_element($elem) {
        $active_link = $_GET[$this->event_var] == $elem[1] 
                    || ($_GET[$this->event_var] == "" && $elem[1] == "main");
        
        if(!$active_link) {
            $link = 
                $this->li_prefix.
                $this->a_prefix.$elem[1].$this->a_postfix.$elem[0].$this->a_suffix.
                $this->li_suffix;    
        } else {
            $link = $this->li_prefix_noactive.
                $this->a_prefix.$elem[1].$this->a_postfix.$elem[0].$this->a_suffix.
                $this->li_suffix;
        }

        return $link;
    }
};
/*
$menu = new Menu($menu_array);
echo $menu->build();*/