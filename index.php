<?php

require_once('vendor/autoload.php');

$fw = Base::instance();
$fw->mset(array(
    'CACHE' => true,
    'AUTOLOAD' => 'app/',
    'TEMP' => 'tmp/',
    'UI' => 'templates/',
    'LOGS' => 'log/',
    'site.url' => $fw->get('SCHEME') . '://' . $fw->get('HOST') . $fw->get('BASE') . '/'
));

$fw->config('app/config/routes.ini');

$fw->run();