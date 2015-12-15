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
