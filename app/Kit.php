<?php

namespace App;

class Kit {

    public function __construct(){
        $this->Tool = new \App\Sys\Box();
        $this->dot = $this->Tool = new \App\Sys\Inator();
        $this->lister = $this->Tool = new \App\Models\Lister();
        $this->phinder = $this->Tool = new \Symfony\Component\Finder\Finder();
        $this->ontology = $this->Tool = new \League\Flysystem\Filesystem(new \League\Flysystem\Adapter\Local(MARQUES));
    }

    public function phinder(){
        return $this->phinder;
    }

    public function ontology(){
        return $this->ontology;
    }

    public function render($tpl, $data = []){
        $this->view = $this->Tool = new \App\Sys\Twig();
        return $this->view->render($tpl.'.twig', $data);
    }
    public function parse($k){
        $this->extra = $this->Tool = new \ParsedownExtra();
        return $this->extra->text($k);
    }
    public function auth(){
        $this->auth = $this->Tool = new \App\Models\Account();
        return $this->auth;
    }
    public function login($k,$m){
        return $this->auth->login($k,$m);
    }
    public function check($k){
        return $this->auth->check($k);
    }
    public function read($k){
        return $this->ontology->read($k);
    }
    public function getlist(){
        return $this->ontology->listContents();
    }
    public function got($k){
        return $this->ontology->has($k);
    }
    public function save($k,$m){
        return $this->ontology->put($k,$m);
    }
    public function msg(){
        $this->msg = $this->Tool = new \Plasticbrain\FlashMessages\FlashMessages();
        return $this->msg;
    }
    public function dot(){
        return $this->dot;
    }
}
