<?php

namespace App\Sys;

class Twig {

    public $twig;

    public function __construct()
    {
        $this->dot = new \App\Sys\Inator();
        $this->loader = new \Twig_Loader_Filesystem($this->dot->get('TPL'));
        $this->twig = new \Twig_Environment($this->loader, $this->dot->get('TWIG_SETTINGS'));
        $this->twig->addGlobal('siteurl', siteurl());
        $this->twig->addGlobal('auth', checkLogin());
        $this->twig->addGlobal('twigUser', twigUser());
    }

    public function render ($tpl, $data = []) {
        return $this->twig->render($tpl, $data);

    }

}



