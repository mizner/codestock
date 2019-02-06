<?php

namespace CodeStock\Core\Controllers\Enqueues;

use const CodeStock\Core\URI;

class Blocks
{
    const WHITELIST = [
        'acf/accordion',
        'acf/hero',
        'core/paragraph',
        'core/image',
        // 'core/heading',
        // 'core/gallery',
        'core/list',
        // 'core/quote',
        // 'core/shortcode',
        // 'core/archives',
        // 'core/audio',
        // 'core/button',
        // 'core/categories',
        // 'core/code',
        'core/columns',
        'core/column',
        // 'core/cover',
        // 'core/embed',
        // 'core-embed/twitter',
        // 'core-embed/youtube',
        // 'core-embed/facebook',
        // 'core-embed/instagram',
        // 'core-embed/wordpress',
        // 'core-embed/soundcloud',
        // 'core-embed/spotify',
        // 'core-embed/flickr',
        // 'core-embed/vimeo',
        // 'core-embed/animoto',
        // 'core-embed/cloudup',
        // 'core-embed/collegehumor',
        // 'core-embed/dailymotion',
        // 'core-embed/funnyordie',
        // 'core-embed/hulu',
        // 'core-embed/imgur',
        // 'core-embed/issuu',
        // 'core-embed/kickstarter',
        // 'core-embed/meetup-com',
        // 'core-embed/mixcloud',
        // 'core-embed/photobucket',
        // 'core-embed/polldaddy',
        // 'core-embed/reddit',
        // 'core-embed/reverbnation',
        // 'core-embed/screencast',
        // 'core-embed/scribd',
        // 'core-embed/slideshare',
        // 'core-embed/smugmug',
        // 'core-embed/speaker',
        // 'core-embed/speaker-deck',
        // 'core-embed/ted',
        // 'core-embed/tumblr',
        // 'core-embed/videopress',
        // 'core-embed/wordpress-tv',
        // 'core/file',
        // 'core/freeform',
        // 'core/html',
        'core/media-text',
        // 'core/latest-comments',
        'core/latest-posts',
        // 'core/missing',
        // 'core/more',
        // 'core/nextpage',
        // 'core/preformatted',
        // 'core/pullquote',
        // 'core/separator',
        'core/block',
        'core/spacer',
        'core/subhead',
        'core/table',
        // 'core/template',
        // 'core/text-columns',
        // 'core/verse',
        // 'core/video',
    ];

    public static function init()
    {
        $class = new self;
        add_filter('allowed_block_types', [$class, 'allowed_blocks'], 10, 2);
    }

    public function allowed_blocks($allowed_blocks, $post)
    {

        $allowed_blocks = self::WHITELIST;

        // if ($post->post_type === 'page') {
        //     $allowed_blocks[] = 'core/shortcode';
        // }

        return $allowed_blocks;

    }
}








































































