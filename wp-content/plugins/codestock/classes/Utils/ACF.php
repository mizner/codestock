<?php

namespace CodeStock\Core\Utils;

class ACF
{
    /**
     * ACF::Field
     * Example Usage: ACF::field($prefix, 'Title', ['type' => 'text', 'instructions' => '']),
     *
     * @param string $prefix
     * @param string $name
     * @param array  $options
     * @return array
     */
    public static function field($prefix, $name, $options = [])
    {
        $suffix = strtolower(preg_replace("/[\-_]/", " ", sanitize_title($name)));
        return array_merge($options, [
            'key'   => "{$prefix}_{$suffix}",
            'name'  => $suffix,
            'label' => $name,
        ]);
    }
}