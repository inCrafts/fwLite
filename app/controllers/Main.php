<?php

namespace app\controllers;

class Main extends App {

//    public $layout = 'main';

    public function indexAction() {
//        $this->layout = false;
//        $this->layout = 'default';
//        $this->view = 'test';

        $name = 'Александр';
        $hi = 'Привет';
        $title =  'Page title';
        $this->set(compact('name', 'hi', 'title'));
    }

}