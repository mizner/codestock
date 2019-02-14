<?php

namespace CodeStock\Theme;

use WP_REST_Request;
use const CodeStock\Theme\PATH;
use const CodeStock\Theme\URI;

class Utils
{
    public static function get_posts($post_type = 'posts', $params = [])
    {
        $request = new WP_REST_Request('GET', "/wp/v2/{$post_type}");
        empty($params) ?: $request->set_query_params($params);
        $response = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return $response->get_data();
    }

    public static function get_post($post_type, $id)
    {
        $request = new WP_REST_Request('GET', "/wp/v2/{$post_type}/{$id}");
        $response = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return $response->get_data();
    }

    public static function archive_link($post_type = false)
    {
        if (!$post_type) {
            $post_type = get_post_type();
        }

        return get_post_type_archive_link($post_type);
    }

    public static function svg_inline($filename)
    {
        $filepath = PATH . 'dist/svgs/' . $filename . '.svg';

        if (!file_exists($filepath)) {
            return;
        }

        ob_start();

        include $filepath;

        $html = ob_get_clean();
        return $html;
    }

    public static function image($args)
    {
        $filename          = $args['file'];
        $alt               = $args['alt'];
        $relative_filepath = "dist/images/{$filename}";
        $url               = file_exists(PATH . $relative_filepath) ? URI . $relative_filepath : false;
        return "<img src='{$url}' alt='{$alt}'>";
    }

    public static function is_empty($data)
    {
        if (is_integer($data)) {
            return false;
        }
        if (is_string($data)) {
            return empty(trim($data));
        }
        if (is_array($data)) {
            return empty($data);
        }
        if (is_object($data)) {
            return empty((array)$data);
        }
    }

    public static function has_key($key, $data)
    {
        if (is_array($data)) {
            return array_key_exists($key, $data);
        }
        if (is_object($data)) {
            return property_exists($data, $key);
        }
    }

    public static function noop()
    {
        return null;
    }

    function log()
    {
        if (!WP_DEBUG_LOG) {
            return;
        }

        foreach (func_get_args() as $arg) {
            error_log("--------------------------------------------------------------------------------------------------");
            if (is_array($arg) || is_object($arg)) {
                error_log(print_r($arg, true));

            }
            else {
                error_log($arg);
            }
            error_log("--------------------------------------------------------------------------------------------------");
        }
    }

    /**
     * @param $file
     *
     * @return bool|int|null
     * @since 1.9.0
     */
    public static function cache_buster($file)
    {
        return file_exists(PATH . $file) ? filectime(PATH . $file) : null;
    }

    /**
     * @param $path
     *
     * @return null|string
     */
    public static function env_check($path)
    {
        // Our default variable, will pass as null by default.
        $qualifiedFile = null;

        $themePath = PATH;
        $themeUri  = URI;

        // If dev file exists e.g( app.js ) override $qualifiedFile.
        if (file_exists($themePath . $path)) {
            $qualifiedFile = $themeUri . $path;
        }

        // Create a string to match a possible production file e.g.( app.min.js ) which is likely uglified/minified.
        $extensionPos   = strrpos($path, '.');
        $fileProduction = substr($path, 0, $extensionPos) . '.min' . substr($path, $extensionPos);

        // Test for production file e.g.( app.min.js) override $qualifiedFile.
        if (file_exists($themePath . $fileProduction)) {
            $qualifiedFile = $themeUri . $fileProduction;
        }

        // In order or priority return null, development file, or production file.
        return $qualifiedFile;
    }
}