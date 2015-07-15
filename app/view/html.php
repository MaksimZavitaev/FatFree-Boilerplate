<?php namespace View;

class Html extends \Template
{
    protected $_template = 'default';

    public function render($file, $mime = 'text/html', array $hive = NULL, $ttl = 0)
    {
        return parent::render($this->_template . DIRECTORY_SEPARATOR . $file, $mime, $hive, $ttl);
    }
}