<?php
namespace App\Models;

class Lister {

    public function leaves($navPath) {
        $recursiveIteratorIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($navPath, \FilesystemIterator::SKIP_DOTS));
        $filesTree = [];
        foreach ($recursiveIteratorIterator as $splFileInfo) {
            $path = $splFileInfo->isDir()
                 ? array($splFileInfo->getPathname() => [])
                 : array($splFileInfo->getPathname());
            for ($depth = $recursiveIteratorIterator->getDepth() - 1; $depth >= 0; $depth--) {
                $path = [$recursiveIteratorIterator->getSubIterator($depth)->current()->getPathname() => $path];
            }
            $filesTree = array_merge_recursive($filesTree, $path);
        }
        $this->recur_ksort($filesTree);
 return $filesTree;
}
    public function recur_ksort(&$array) {
        foreach ($array as &$value) {
            if (is_array($value)) $this->recur_ksort($value);
        }
        return ksort($array);
    }

	public function folderOnly($k){
		$filesTree=$this->leaves($k);
		        foreach ($filesTree as $key => $val)
            if (is_numeric($key))
            unset($filesTree[$key]);
            return $filesTree;
        }
public function sidebarList($items, $level = 0) {
    $ret = "";
    $indent = str_repeat("", $level * 2);
    $ret .= sprintf("%s<ul id='ugh'>\n", $indent);
    $indent = str_repeat(" ", ++$level * 2);
    foreach ($items as $item => $subitems) {
        if (!is_numeric($item)) {
        $clean=basename($item);
        $item=str_replace(MARQUES,"",$item);
            $ret .= sprintf("%s<li class='blanc pholder'><a class='linky' href='%s'>%s</a>", $indent, $item, $clean);
        }
        if (is_array($subitems)) {
            $ret .= "\n";
            $ret .= $this->sidebarList($subitems, $level + 1);
            $ret .= $indent;
        } else if (strcmp($item, $subitems)){
                $subitems=str_replace(MARQUES,"",$subitems);
        $subitems= str_replace(".md", "", $subitems);
            $ret .= sprintf("%s<li id='$level' class='blanc phile'><a class='somping' href='%s'>%s</a>", $indent, $subitems, basename($subitems));
        }
        $ret .= sprintf("</li>\n", $indent);
    }
    $indent = str_repeat(" ", --$level * 2);
    $ret .= sprintf("%s</ul>\n", $indent);
    return($ret);
}
}

