<?php

namespace CRUD\Controller;

abstract class Action {
    protected $view;

    public function __construct() {
        $this->view = new \stdClass();
    }

    protected function render($view, $layout) {
        $this->view->page = $view;
        if (file_exists(__DIR__ . "\\..\\..\\..\\App\\Views\\" . $layout . ".phtml")) {
            require __DIR__ . "\\..\\..\\..\\App\\Views\\" . $layout . ".phtml";
        } else {
            $this->content();
        }
        
    }

    protected function content() {
        $classAtual = get_class($this);
        $classAtual = str_replace('App\\Controllers\\', '', $classAtual);
        $classAtual = strtolower(str_replace('Controller', '', $classAtual));
        require __DIR__ . "\\..\\..\\..\\App\\Views\\". $classAtual ."\\". $this->view->page . ".phtml";
    }
}