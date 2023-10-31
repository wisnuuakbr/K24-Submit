<?php

use App\Models\Navigation;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->whereNull('parent_id')->orderBy('sort', 'asc')->get();
    }
}
