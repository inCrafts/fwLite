<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController {

//    public $layout = 'main';

    public function indexAction() {

        $model = new Main;
//        $res = $model->query("CREATE TABLE newposts2 SELECT * FROM posts");
        $posts = $model->findAll();
        $post = $model->findOne(2);
//        $post_title = $model->findOne('Рыбный текст', 'title');
//        $data = $model->findBySql("SELECT * FROM posts ORDER BY id DESC LIMIT 2");
//        $data = $model->findBySql("SELECT * FROM {$model->table} WHERE title LIKE ?", ['%щс%']);
        $data = $model->findLike('sit', 'text');
        debug($data);
        $title =  'Page title';
        $this->set(compact('title', 'posts'));
    }

}