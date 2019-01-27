<?php

namespace CodeStock\Core\Controllers\Blocks;

use CodeStock\Core\Utils\Blocks;
use Timber\Timber;
use const CodeStock\Core\PATH;

class Block
{

    public function render($context)
    {
        $slug = $context['register']['slug'];
        $view_path = "views/blocks/{$slug}/{$slug}.twig";
        $filepath_theme = get_template_directory() . $view_path;
        $filepath_plugin = PATH . $view_path;

        $filepath = file_exists($filepath_theme) ? $filepath_theme : $filepath_plugin;

        Timber::render($filepath, $context);
    }

}