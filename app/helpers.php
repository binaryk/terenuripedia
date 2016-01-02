<?php

/**
 * Global helpers file with misc functions
 *
 */
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (!function_exists('javascript')) {
    /**
     * Access the javascript helper
     */
    function javascript()
    {
        return app('JavaScript');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}


function _color(){
    switch(auth()->user()->type_id){
        case 1:
            return '#0D9AEC';
            break;
        case 2:
            return '#ECBC0D';
            break;
        case 3:
            return '#EC0D0D';
            break;
    }
    return '#000';
}


function _toFloat($value, $decimals = 2)
{
    return number_format( (float) $value, $decimals, ',', '.');
}

function _toInt($value)
{
    return number_format( (int) $value, 0, ',', '.');
}

function _toDate($value, $format = 'd.m.Y', $default = '-')
{
    if( empty($value) )
    {
        return $default;
    }
    $value = substr($value, 0, 10);
    return Carbon\Carbon::createFromFormat('Y-m-d', $value)->format($format);
}

function _toDateTime($value, $format = 'd.m.Y H:i:s', $default = '-')
{
    if( empty($value) )
    {
        return $default;
    }
    $value = substr($value, 0, 19);
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format);
}

function _toDateTimeCarbon($value, $format = 'd.m.Y H:i:s', $default = '-')
{
    if( empty($value) )
    {
        return $default;
    }
    $value = substr($value, 0, 19);
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);
}

function _toFileSize($size, $precision = 2)
{
    if($size == 0){
        return _toFloat(0);
    }
    $base     = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');
    return _toFloat(round(pow(1024, $base - floor($base)), $precision)) . ' ' . $suffixes[floor($base)];
}
