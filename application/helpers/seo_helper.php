<?php

function seo_title($s)
{

    $c = array(' ');
    $d = array('-', '"', '/', '.', ',', '#', '%', '\\', '&', '{', '}', '(', ')', ';', ':', '<', '>', '?', '|', '=', '+', '_', '@', '!', '`', '~', '$', '^', '*');
    $s = str_replace($d, '', $s);
    $s = strtolower(str_replace($c, '-', $s));
    return $s;
}
