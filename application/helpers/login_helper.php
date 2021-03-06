<?php
defined('BASEPATH') or die('No direct script access allowed!');

function is_login($is_true = false)
{
    $CI = &get_instance();
    if (!@$CI->session->is_login && !$is_true) {
        redirect('login');
    } elseif ($CI->session->is_login && $is_true) {
        redirect('pegawai');
    }

    return;
}

function is_level($level)
{
    $CI = &get_instance();
    if ($CI->session->level == $level) {
        return true;
    }

    return false;
}

function redirect_if_level_not($level)
{
    $CI = &get_instance();
    $is_match = false;
    if (is_array($level)) {
        if (in_array($CI->session->level, $level)) {
            $is_match = true;
        }
    } else {
        $is_match = is_level($level);
    }

    if (!$is_match) {
        return redirect('pegawai/');
    }

    return;
}

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
