<?php
namespace App\Controllers;
use TeamTNT\TNTSearch\TNTSearch;

class SearchController {

	public function __construct(){
		$this->tnt = new \TeamTNT\TNTSearch\TNTSearch();
    }
}
