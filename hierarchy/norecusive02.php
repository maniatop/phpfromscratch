<?php
//https://www.sitepoint.com/hierarchical-data-database/
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


function printTree($tree, $level=0) {
    if(!is_null($tree) && count($tree) > 0) {
        echo  "\r\n" . str_repeat('  ', $level) .'<ul>'."\r\n";
        $cnt = count($tree);
        $idx=0;
        foreach($tree as $key =>$node) {
            $idx++;
            echo str_repeat('  ', $level+1) . '<li>'.$key;
            if (count($node)>0)
            {
                printTree($node, $level+1);
                echo str_repeat('  ', $level+1) .  '</li>'."\r\n";
            }
                
            else
                 echo '</li>'."\r\n";
        }
        echo str_repeat(' ', $level+1) . '</ul>'."\r\n";
    }   
}

function getSpace($no) { $str='';for($i=0;$i<$no;$i++) $str .= ' '; return $str;}