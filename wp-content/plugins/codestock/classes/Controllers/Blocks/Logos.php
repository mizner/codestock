<?php

namespace CodeStock\Core\Controllers\Blocks;

use CodeStock\Core\Utils\Blocks;

class Logos extends Block
{
    public static function init()
    {
        $class = new self;
        add_action('blocks/logos', [$class, 'filter']);
    }

    public function filter($context)
    {
        parent::render($context);
    }

}