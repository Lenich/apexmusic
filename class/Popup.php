<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Popup
 *
 * @author Yakud
 */
class Popup extends Controller {
    public $title = "Default title";
    public $body = "Default body";
    public $templ = "";
    
    public function __construct($templ, $title, $body) {
        $this->templ = $templ;
        $this->title = $title;
        $this->body = $body;
    }
    
    public function renderPopup() {
        return $this->render($this->templ, array(
            'title' => $this->title,
            'body'  => $this->body,
        ));
    }
}

?>
