<?php

namespace Pyxl\Theme;

use Timber\Timber;

class View
{
    private $path;
    private $type;
    private $file;
    private $context = [];
    private $queriedObject;

    public static function init()
    {
        $class = new self;
        add_action('theme_view_header', [$class, 'header']);
        add_action('theme_view_main', [$class, 'main']);
        add_action('theme_view_footer', [$class, 'footer']);
    }

    private function getArchiveType()
    {
        if (is_post_type_archive() || is_home()) {
            $type = 'post_type';
        } else {
            $type = 'taxonomy';
        }

        return $type;
    }

    private function getType()
    {
        // Archive, Single, Search, 404
        if (is_archive() || is_home()) {
            $type = 'archives';
        } elseif (is_singular()) {
            $type = 'singles';
        } elseif (is_search()) {
            $type = 'search';
        } else {
            $type = '404'; // Default
        }

        return $type;
    }

    private function getPath($type)
    {
        $path = (object)[
            'dir' => 'views/',
            'basename' => '',
            'file' => '',
        ];

        switch ($type) {
            case 'archives':
                if (is_home()) {
                    $path->basename = 'post';
                    $path->dir .= "{$type}/post_type/{$path->basename}";
                } elseif (is_post_type_archive()) {
                    $path->basename = $this->queriedObject->name;
                    $path->dir .= "{$type}/post_type/{$path->basename}";
                } else {
                    $path->basename = $this->queriedObject->taxonomy;
                    $path->dir .= "{$type}/taxonomy/{$path->basename}";

                }
                break;
            case 'singles':
                $path->basename = $this->queriedObject->post_type;
                $path->dir .= "{$type}/{$path->basename}";
                break;
            case 'search':
                $path->basename = 'search';
                $path->dir .= "{$path->basename}";
                break;
            default:
                $path->basename = '404';
                $path->dir .= "{$path->basename}";
                break;
        }

        if (class_exists(Timber::class)) {
            $path->file = PATH . "{$path->dir}/{$path->basename}.twig";
        }

        return $path;
    }

    private function setContext()
    {
        $context = [
            'filter' => $this->path->dir,
            'file' => $this->path->file,
            'queried' => $this->queriedObject,
            // 'context' => Timber::get_context(), // Avoiding, given too much information
        ];

        if ('singles' === $this->type) {
            // $context['post'] = Timber::get_post();
            $context['post'] = Timber::get_post();
        }

        if ('archives' === $this->type) {
            $context['posts'] = Timber::get_posts();
        }

        return $context;
    }

    public function header()
    {
        if (class_exists(Timber::class)) {
            do_action('theme_before_head');
            Timber::render(PATH . 'views/head.twig');
            do_action('theme_after_head');

            do_action('theme_before_header');
            Timber::render(PATH . 'views/layouts/header/header.twig');
            do_action('theme_after_header');
        }
    }

    public function main($queriedObject)
    {
        $this->queriedObject = $queriedObject;
        $this->type = $this->getType();
        $this->path = $this->getPath($this->type);
        $this->context = $this->setContext();

        $data = apply_filters($this->path->dir, $this->context);

        if (!have_posts()) {
            Timber::render('views/archives/none.twig', $data);
        }

        printf("<!-- start: {$this->path->dir} -->");


        do_action('theme_before_render', $data);
        switch ($this->type):
            case 'singles':
                while (have_posts()) :
                    the_post(); // Set up post data
                    Timber::render($this->path->file, $data);
                endwhile;
                break;
            case 'archives':
                Timber::render($this->path->file, $data);
                break;
            default:
                break;
        endswitch;

        do_action('theme_after_render', $data);

        printf("<!-- end: {$this->path->dir} -->");
    }

    public function footer()
    {
        do_action('theme_before_footer');
        Timber::render(PATH . 'views/layouts/footer/footer.twig');
        do_action('theme_after_footer');
    }


}