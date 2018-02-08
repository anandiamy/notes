<?php

namespace App\Sys;
use App\Kit;
use App\Models\Marque;

class BreadProvider  {

    public static function makeBread($post)
    {
        $crumbs = explode('/', $post);
        $crumbs = empty($crumbs[0]) ? [] : $crumbs;
        $breadcrumbs = [];
        foreach ($crumbs as $i => $crumb) {
            $breadcrumbs[$i] = [
                'href' => '/'.self::slugify(implode('/', array_slice($crumbs, 0, $i+1))),
                'name' => self::deslugify($crumbs[$i]),
            ];
        }
        return $breadcrumbs;
    }

    public static function slugify($string, $separator = '-')
    {
        return str_replace(' ', $separator, $string);
    }

    public static function deslugify($slugged)
    {
        if (is_array($slugged)) {
            return array_map('static::deslugify', $slugged);
        }

        return str_replace(['-', '_'], ' ', $slugged);
    }

public static function getBreadCrumbs($path)

    {
        $explodedPath = explode('/', $path);
        $breadcrumbs = [];
        $prefix ="";
        if (!empty($explodedPath)) {
            $number = count($explodedPath);
            $link = $prefix;

            foreach ($explodedPath as $key => $breadcrumb) {
                if ($breadcrumb !== '') {
                    $breadcrumbs[] = [
                        'name' => explode('.', $breadcrumb)[0],
                        'link' => $link,
                        'active' => $key === $number - 1,
                    ];
                }
            }
        }
        return $breadcrumbs;
}


}
