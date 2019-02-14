<?php

namespace CodeStock\Core\Utils;

class General
{
    public static function has_key($key, $data)
    {
        if (is_array($data)) {
            return array_key_exists($key, $data);
        }
        if (is_object($data)) {
            return property_exists($data, $key);
        }
    }

    public static function get_image_data($id)
    {
        if (!is_integer($id) || !$id) {
            return [];
        }

        $uploads   = wp_get_upload_dir();
        $metadata  = wp_get_attachment_metadata($id);
        $image_dir = $uploads['baseurl'] . '/' . str_replace(basename($metadata['file']), '', $metadata['file']);


        $sizes = [];
        foreach ($metadata['sizes'] as $size => $size_data) {
            $file         = str_replace(basename($size_data['file']), '', $size_data['file']);
            $sizes[$size] = array_merge($size_data, [
                'url' => "{$image_dir}{$size_data['file']}",
            ]);
        }


        $image = array_merge($metadata, [
            'url'   => "{$uploads['baseurl']}/{$metadata['file']}",
            'alt'   => get_post_meta($id, '_wp_attachment_image_alt', true),
            'sizes' => $sizes,
        ]);

        return $image;
    }
}