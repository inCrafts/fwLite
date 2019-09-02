<?php


namespace vendor\core\base;


abstract class Controller
{
    /**
     * Текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * Текущий вид
     * @var string
     */
    public $view;

    /**
     * Текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * Пользоваиельские данные
     * @var array
     */
    public $vars = [];

    public function __construct($route) {

        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     * Получает вид из маршрута, и ыида, передает в шаблон
     * @param array $route
     */
    public function getView() {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    /**
     * @param array $route
     */
    public function set($vars) {
        $this->vars = $vars;
    }
}
