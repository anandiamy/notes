<?php

namespace App\Controllers;

class NoteController {

	public function __construct(){
        $this->app = new \App\Kit();
    }

    public function getNote($url)
    {
        $card = $this->init($url);
        $data = $this->finit($card, $url);
        echo $this->app->render('cards/'.$card,$data);
    }
    public function init($k){
        if ($this->app->got($k.'.md')) $status="note";
        elseif ($this->app->got($k)) $status="list";
        else $status="generic";
        return $status;
    }
    public function finit($card, $k){
        $getting=$this->app->lister->folderOnly(MARQUES);
        $generic = [
            'title' => basename($k),
            'breadcrumbs' => \App\Sys\BreadProvider::makeBread($k),
            'files' => $this->app->lister->sidebarList($getting)
        ];
    switch ($card) {
    case "note":
        $unmarked = $this->app->read($k.'.md');
        $marked = $this->app->parse($unmarked);
        $m = ['unmarked'=>$unmarked, 'marked'=>$marked];
        break;
    case "list":
        $prelist = $this->app->lister->leaves(MARQUES.'/'.$k);
        $m = ['list' => bonsai($prelist)];
        break;
    default:
        $m = [];
        }
        $unity=array_merge($generic,$m);
        return $unity;
    }
    public function postNote($url) {
        $k=$url.'.md';
        $postal=$this->preText($_POST['takethis']);
        $this->app->save($k, $postal);
    }
    public function preText($text) {
        $text = strip_tags($text);
        $text = trim($text);
        $text = htmlspecialchars($text);
        return $text;
    }

}
