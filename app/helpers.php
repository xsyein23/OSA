<?php

function strip_p_tags($text) {
    // Replace <p> tags with double new lines
    $text = preg_replace('/<p[^>]*>(.*?)<\/p>/is', "$1\n\n", $text);
    // Replace <br> tags with single new lines
    $text = preg_replace('/<br\s*\/?>/i', "\n", $text);
    // Strip all tags except <em> and <strong>
    $text = strip_tags($text, '<em><strong>');
    return $text;
}

if (!function_exists('ordinal_suffix')) {
    function ordinal_suffix($num)
    {
        $num = $num % 100;
        if ($num < 11 || $num > 13) {
            switch ($num % 10) {
                case 1:
                    return $num . 'st';
                case 2:
                    return $num . 'nd';
                case 3:
                    return $num . 'rd';
            }
        }
        return $num . 'th';
    }
}
