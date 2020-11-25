<?php

class Controller
{
    /**
     * @param string $model 
     * @return Model 
     */
    protected function model($model)
    {
        if (file_exists('app/models/' . $model . '.php')) {
            require_once 'app/models/' . $model . '.php';
            return new $model;
        }

        die('Model ' . $model . ' does not exist!');
    }

    protected function view($view, $data = [])
    {
        if (file_exists('app/views/' . $view . '.php')) {
            require_once 'app/views/' . $view . '.php';
            return 0;
        }

        die('View ' . $view . ' does not exist!');
    }
}
