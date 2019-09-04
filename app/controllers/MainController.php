<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController {

//    public $layout = 'main';

    public function indexAction() {

        $model = new Main;
        $posts = \R::findAll('posts');
        $menu = $this->menu;
        $title =  'Page title';
        $this->setMeta('Главная страница', 'Описание', 'Ключевики');
        $meta = $this->meta;
        $this->set(compact('title', 'posts', 'menu', 'meta'));
    }

    public function testAction() {

        $this->layout = 'test';
    }

}