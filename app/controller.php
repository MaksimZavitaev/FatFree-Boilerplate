<?php

class Controller
{
    protected function _render($file, $mime = 'text/html', array $hive = NULL, $ttl = 0)
    {
        echo \View\Html::instance()->render($file, $mime, $hive, $ttl);
    }
}