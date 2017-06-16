<?php
$tree = array(
    'H' => 'G',
    'F' => 'G',
    'G' => 'D',
    'E' => 'D',
    'A' => 'E',
    'B' => 'C',
    'C' => 'E',
    'D' => null
);

function to_tree($array)
{
    $flat = array();
    $tree = array();

    foreach ($array as $child => $parent) {
        if (!isset($flat[$child])) {
            $flat[$child] = array();
        }
        if (!empty($parent)) {
            $flat[$parent][$child] =& $flat[$child];
        } else {
            $tree[$child] =& $flat[$child];
        }
    }

    return $tree;
}

$result = to_tree($tree);


printTree($result);

function printTree($tree) {
    static $strSpace;
    global $depth;
    
    if(!is_null($tree) && count($tree) > 0) {
        

        echo  "\r\n" . getSpace($depth) .'<ul>'."\r\n";
        $depth ++;
        foreach($tree as $key =>$node) {
            
            echo getSpace($depth) . '<li>'.$key;
            printTree($node);

            echo  '</li>'."\r\n";
        }
        echo getSpace($depth) . '</ul>'."\r\n";
        $depth --;
    }
   
}

function getSpace($no) { $str='';for($i=0;$i<$no;$i++) $str .= ' '; return $str;}