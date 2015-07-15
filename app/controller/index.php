<?php

namespace Controller;

class Index extends \Controller
{
    function index(\Base $fw)
    {
        $fw->set('TITLE', 'This is Test Title');
        $this->_render('index.htm');
    }
}