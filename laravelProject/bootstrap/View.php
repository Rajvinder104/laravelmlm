<?php

if (!function_exists('adminView')) {
    function adminView($path, $response = [])
    {
        return view('admin/' . $path, $response);
    }
}


if (!function_exists('userView')) {
    function userView($path, $response = [])
    {
        return view('user/' . $path, $response);
    }
}


if (!function_exists('siteView')) {
    function siteView($path, $response = [])
    {
        return view('site/' . $path, $response);
    }
}


if (!function_exists('configArray')) {
    function configArray($array_name)
    {
        return config('myarray.' . $array_name);
    }
}
