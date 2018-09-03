<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 28/02/2018
 * Time: 13:21
 */
if (!function_exists('read_more')) {
    function read_more($text, $length = 180) : string
    {
        $string = strip_tags($text);
        if (strlen($string) > $length) {

            // truncate string
            $stringCut = substr($text, 0, $length);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }
}