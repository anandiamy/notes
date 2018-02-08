<?php
function siteurl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://".$_SERVER['HTTP_HOST'].'/';
}
function checkLogin() {
        return isset($_SESSION['authentique']);
}
function twigUser() {
        if(isset($_SESSION['username']))
        return $_SESSION['username'];
}
function redirect($path)
{
    header("'Location: /'.$path");
}
function bonsai($items, $level = 0) {
    $ret = "";
    $indent = str_repeat(" ", $level * 2);
    $ret .= sprintf("%s<ul id='pholdering' data-position='$level' class='list'>\n", $indent);
    $indent = str_repeat(" ", ++$level * 2);
    foreach ($items as $item => $subitems) {
		ksort($items);
        if (!is_numeric($item)) {
        $clean=basename($item);
        $item=str_replace(MARQUES,"",$item);
            $ret .= sprintf("%s<li class='$level'><span class='space'><a class='linky text-uppercase font-weight-bold' href='%s'>%s</a></span>", $indent, $item, $clean);
        }
        if (is_array($subitems)) {
			krsort($subitems);
            $ret .= "\n";
            $ret .= bonsai($subitems, $level + 1);
            $ret .= $indent;
        } else if (strcmp($item, $subitems)){
			ksort($subitems);
                $subitems=str_replace(MARQUES,"",$subitems);
        $subitems= str_replace(".md", "", $subitems);
            $ret .= sprintf("%s<li id=''  class='filed'><a class='' href='%s'>%s</a>", $indent, $subitems, basename($subitems));
        }
        $ret .= sprintf("</li>\n", $indent);
    }
    $indent = str_repeat(" ", --$level * 2);
    $ret .= sprintf("%s</ul>\n", $indent);
    return($ret);
}
function recur_ksort(&$array) {
        foreach ($array as &$value) {
            if (is_array($value)) $this->recur_ksort($value);
        }
        return ksort($array);
    }
