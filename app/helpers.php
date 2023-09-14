<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


if (! function_exists('date_now')) {
    function date_now()
    {
        $now = Carbon::parse(now())->format('m/d/Y') ;
        return $now;
    }

}

if (! function_exists('display_date')) {
    function display_date($myDate)
    {
        $date = date('l F Y', strtotime($myDate));
        return $date;
    }
}
if (! function_exists('display_date2')) {
    function display_date2($myDate)
    {
        $date = date('l j F Y', strtotime($myDate));
        return $date;
    }
}


if (! function_exists('userName')) {
    function userName()
    {
    $name = auth()->user()->name;
        return $name;
    }
}

if (! function_exists('userID')) {
    function userID()
    {
        $id = auth()->user()->id;
        return $id;
    }
}


if (!function_exists('userAvatarUrl')) {
    function userAvatarUrl()
    {
        $user = Auth::User();
        if ($user->avatar) {
            $userName = $user->name;
            $avatarName = $user->avatar->name;

            $pathfile = "/$userName/$avatarName";

            return asset('storage/userAvatar' . $pathfile);
        }

        return null; 
    }


}


