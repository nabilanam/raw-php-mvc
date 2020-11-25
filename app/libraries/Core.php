<?php

class Core
{
    private $currentController = 'HomeController';
    private $currentMethod = 'index';
    private $params = [];

    public function __construct()
    {
        $paths = $this->getUrlPaths();

        if (array_key_exists(0, $paths) && file_exists('app/controllers/' . ucwords($this->getCamelCase($paths[0])) . 'Controller.php')) {
            $this->currentController = ucwords($this->getCamelCase($paths[0])) . 'Controller';
            unset($paths[0]);
        }

        require_once 'app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        if (array_key_exists(1, $paths) && method_exists($this->currentController, $this->getCamelCase($paths[1]))) {
            $this->currentMethod = $this->getCamelCase($paths[1]);
            unset($paths[1]);
        }

        $this->params = array_values($paths);

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getUrlPaths()
    {
        return explode('/', ltrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/'));
    }

    private function getCamelCase($str)
    {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));

        if ($str)
            $str[0] = strtolower($str[0]);

        return $str;
    }
}
