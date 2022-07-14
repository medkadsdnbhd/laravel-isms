<?php

if (! function_exists('sanitize_response')) {

    function sanitize_response($value)
    { 
        return str_replace(['"', '[', ']','-','`'], '', $value);
    }
}

if (! function_exists('response_code')) {

    function response_code($value)
    { 
        return substr($value, 0, 4);
    }
}

if (! function_exists('response_code_first_digit')) {

    function response_code_first_digit($value)
    { 
        return substr($value, 0, 1);
    }
}