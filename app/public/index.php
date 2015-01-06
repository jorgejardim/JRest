<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(dirname(__FILE__))).DS);
define('APP', basename(dirname(dirname(__FILE__))).DS);
define('CORE', ROOT.'lib'.DS);
define('WEB', ROOT.APP.'public'.DS);

require CORE.'bootstrap.php';