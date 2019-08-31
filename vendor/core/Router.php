<?php

/**
 * Таблица маршрутов
 * @var array
 */
class Router
{
    /**
     *  Лист маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     *  Ntreobq маршрут
     * @var array
     */
    protected static $route = [];

    /**
     *  Добавляемт маршрут в лист маршрутов
     * @param string $regexp Ругулярное выражение маршрута
     * @param array $route Ьаршрут ([контроллер, экшн, параметры])
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * Возвращает лист маршрутов
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Возвращвет текущий маршрут
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Ищет URL в листе маршрутов
     * @param string $url Входящий маршрут
     * @return bool Найден маршрут в листе или нет
     */
    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                debug($matches);
                foreach ($matches as $key => $val) {
                    if (is_string($key)) {
                        $route[$key] = $val;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                debug(self::$route);
                return true;
            }
        }
        return false;
    }

    /**
     * Перенаправляет URL по корректномку маршруту
     * @param string $url Входящая строка запроса
     * @return void
     */
    public static function dispatch($url) {
        if (self::matchRoute($url)) {
            $controller = self::upperCamelCase(self::$route['controller']);
            if (class_exists($controller)) {
                $cObj = new $controller;
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                } else {
                    echo "Метод <strong>$controller::$action</strong> не найден";
                }
            } else {
                echo "Контроллер <strong>$controller</strong> не найден";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    /**
     * Приводит строку к написанию Upper camel case
     * @param string $name строка
     * @return mixed Возвращает исправленную строку
     */
    protected static function upperCamelCase($name) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * Приводит строку к написанию Lower camel case
     * @param string $name строка
     * @return mixed Возвращает исправленную строку
     */
    protected static function lowerCamelCase($name) {
        return lcfirst(self::upperCamelCase($name));
    }

}