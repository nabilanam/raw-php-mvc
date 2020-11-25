<?php

function redirect_back()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function redirect_to($to)
{
    header('Location: ' . APP_URL . $to);
}

function dd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    exit;
}
