<?php

namespace CodeStock\Core\Controllers\PostTypes;

class Speakers
{
    public static function init()
    {
        $class = new self;
        add_filter('views/archives/post_type/speakers', [$class, 'single']);
    }

    public function single($context)
    {
        $context[] = [

        ];

        return $context;
    }
}