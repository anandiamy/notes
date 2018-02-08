<?php

namespace App\Sys;

class Box {

    protected $services=[];

    public function add($k, $c) {
        $this->service[$k]=$c;
    }
    public function get($k) {
        return $this->service[$k]($this);
    }
}

