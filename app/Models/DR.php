<?php

namespace App\Models;

class DR{
    private $directory;
    private $listing;

    public function __construct($directory){
        try {
            $this->directory = $directory;
            $this->listing = array();
            $this->ListDir();
        } catch(UnexpectedValueException $e){
            die("Path cannot be opened.");
        } catch(RuntimeException $e){
            die("Path given is empty string.");
        }
    }

    public function philes(){
        return $this->listing['files'];
    }

    public function pholders(){
        return $this->listing['directories'];
    }

    public function GetListing(){
        return $this->listing;
    }

    private function ListDir(){
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->directory), \RecursiveIteratorIterator::CHILD_FIRST);
        foreach($iterator as $path){
            if($path->isDir()){
                $cache = $this->minimal($path->__toString());
//                $cache = $this->GetInfoArray($path->__toString());
                isset($cache) ? $this->listing['directories'][] = $cache : "";
                unset($cache);
            } else {
                $this->listing['files'][] = $this->minimal($path->__toString());
//                $this->listing['files'][] = $this->GetInfoArray($path->__toString());
            }
        }
    }

    private function minimal($path){
        $d = new \SplFileInfo($path);
        if($d->getBasename() == "." || $d->getBasename() == ".."){
            return;
        } else {
			$prepath = $d->getPathname();
			$webpath=str_replace(MARQUES,"",$prepath);
			$basename= str_replace(".md", "", ($d->getBasename()));
            return array(
				"stuff" => file_get_contents($path),
               "pathname"    => $webpath,
               "type"        => $d->getType(),
               "modified"    => $d->getMTime(),
               "size"        => $d->getSize(),
               "path"        => $d->getPath(),
               "basename"    => $d->getBasename(),
               "filename"    => $d->getFilename()

            );
        }
    }

    private function GetInfoArray($path){
        $d = new SplFileInfo($path);
        if($d->getBasename() == "." || $d->getBasename() == ".."){
            return;
        } else {
            return array(
               "pathname"    => $d->getPathname(),
               "access"      => $d->getATime(),
               "modified"    => $d->getMTime(),
               "permissions" => $d->getPerms(),
               "size"        => $d->getSize(),
               "type"        => $d->getType(),
               "path"        => $d->getPath(),
               "basename"    => $d->getBasename(),
               "filename"    => $d->getFilename()
            );
        }
    }
}

