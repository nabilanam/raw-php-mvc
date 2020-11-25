<?php
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'app/helpers/helper.php';

spl_autoload_register(function ($className) {
    require_once 'app/libraries/' . $className . '.php';
});

new Core;
