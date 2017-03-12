<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . "core/config.php");
require(ROOT . "core/core.php");
require(ROOT . "core/route.php");


route();