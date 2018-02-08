<?php

namespace App\Sys;

class Inator{

    public $items = [];
    public function __construct()
    {
        $this->items = $this->getArrayItems(include(SETTINGS));
    }

    public function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->items;
        }
        if ($this->exists($this->items, $key)) {
            return $this->items[$key];
        }
        if (strpos($key, '.') === false) {
            return $default;
        }
        $items = $this->items;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !$this->exists($items, $segment)) {
                return $default;
            }
            $items = &$items[$segment];
        }
        return $items;
    }
    protected function exists($array, $key)
    {
        return array_key_exists($key, $array);
    }
    protected function getArrayItems($items)
    {
        return (array) $items;
    }
}
