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

$fw->config('app/config/settings.ini');
$fw->config('app/config/routes.ini');

$fw->set('db.instance', new \DB\SQL(
    'mysql:host=' . $fw->get('db.host') . ';port=' . $fw->get('db.port') . ';dbname=' . $fw->get('db.name'),
    $fw->get('db.user'),
    $fw->get('db.pass')
));
\Helper\Settings::instance();

$fw->run();