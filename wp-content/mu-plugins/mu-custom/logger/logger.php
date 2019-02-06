<?php
/**
 * Plugin Name: WP Logger
 * Version: 1.0
 * License: GPL3+
 */

function _log()
{
    if (!WP_DEBUG_LOG) {
        return;
    }

    foreach (func_get_args() as $arg) {
        error_log("--------------------------------------------------------------------------------------------------");
        if (is_array($arg) || is_object($arg)) {
            error_log(print_r($arg, true));

        } else {
            error_log($arg);
        }
        error_log("--------------------------------------------------------------------------------------------------");
    }
}

function _dump()
{
    foreach (func_get_args() as $arg) {
        var_dump($arg);
    }
    die;
}

