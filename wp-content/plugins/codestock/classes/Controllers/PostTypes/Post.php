<?php

namespace CodeStock\Core\Controllers\PostTypes;

class Post
{
    public static function init()
    {
        $class = new self;
        add_filter('views/singles/post', [$class, 'single']);
    }

    public function single($context)
    {
        $post_id           = get_the_ID();
        $featured_image_id = get_post_thumbnail_id($post_id);

        $context['title']   = get_the_title($post_id);
        $context['content'] = get_the_content($post_id);
        // TODO, write helper function to loop through image sizes for full url's
        // $context['image'] = wp_get_attachment_metadata($featured_image_id);

        $context['image']     = [
            'alt' => get_post_meta($featured_image_id, '_wp_attachment_image_alt', true),
            'url' => get_the_post_thumbnail_url($post_id, 'large'),
        ];
        $context['srcset']    = wp_get_attachment_image_srcset($featured_image_id);
        $context['htmlImage'] = get_the_post_thumbnail($post_id);

        return $context;
    }
}