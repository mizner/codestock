<?php

namespace Pyxl\Theme;

class MarkupHelper
{
    public static function init()
    {
        $class = new self;

        add_action('theme_before_head', [$class, 'beforeHead']);

        add_action('theme_before_header', [$class, 'svgSprites']);

        add_action('theme_after_header', [$class, 'afterHeader']);
        add_action('theme_before_footer', [$class, 'beforeFooter']);

        add_action('theme_before_header', [$class, 'beforeHeader']);
        add_action('theme_after_footer', [$class, 'afterFooter']);
    }

    public function svgSprites()
    {
        $path = PATH . 'dist/svgs/sprite.svg';
        if (!file_exists($path)) {
            return;
        }
        include_once $path;
    }

    public function beforeHead()
    {
        ?>
        <!doctype html>
        <html <?php language_attributes(); ?>>
        <?php
    }

public function beforeHeader()
{
    ?>
<body <?php body_class() ?>>
<div id="wrapper">
    <?php
}

public function afterHeader()
{
    ?>
    <main id="content">
    <?php
}

public function beforeFooter()
{
    ?>
    </main><!-- #content-->
    <?php
}

    public function afterFooter()
    {
        ?>
        </div><!-- #wrapper-->
        </body>
        </html>
        <?php
    }
}
