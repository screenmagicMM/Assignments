<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

// Let's define very primitive autoloader
spl_autoload_register(function($classname){
    $classname = str_replace('Api_', 'Apis/', $classname);
    if (file_exists(__DIR__.'/'.$classname.'.php')) {
        require __DIR__.'/'.$classname.'.php';
    }
});

// For 4.3.0 <= PHP <= 5.4.0
if (!function_exists('http_response_code'))
{
    function http_response_code($newcode = NULL)
    {
        static $code = 200;
        if($newcode !== NULL)
        {
            header('X-PHP-Response-Code: '.$newcode, true, $newcode);
            if(!headers_sent())
                $code = $newcode;
        }       
        return $code;
    }
}

// Our main method to handle request
Api::serve();
