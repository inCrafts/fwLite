<?php


namespace app\controllers;



class PageController extends AppController {

    public function viewAction() {
            $menu = $this->menu;
            $title =  'Страница';
            $this->set(compact('title', 'posts', 'menu'));
//        debug($this->route);
    }

}