<?php

namespace CodeStock\Core\Controllers\Blocks;

use CodeStock\Core\Utils\Blocks;

class Accordion extends Block
{
    public static function init()
    {
        $class = new self;
        add_action('block/accordion', [$class, 'filter']);
    }

    public function filter($context)
    {
        parent::render($context);
    }

}