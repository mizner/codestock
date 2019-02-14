<?php

namespace CodeStock\Core\Controllers\PostTypes;

use CodeStock\Core\Utils\General as Utils;

class Post
{
    public static function init()
    {
        $class = new self;
        add_filter('rest_prepare_post', [$class, 'single'], 10, 3);
    }

    public function single($data, $post, $context)
    {
        $data->data['image'] = Utils::get_image_data($data->data['featured_media']);

        return $data;
    }
}