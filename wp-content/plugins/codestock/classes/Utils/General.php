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
}