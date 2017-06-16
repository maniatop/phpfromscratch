<?php
// https://stackoverflow.com/questions/2915748/convert-a-series-of-parent-child-relationships-into-a-hierarchical-tree#comment15908756_11942115
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

function parseTree($tree, $root = null) {
    $return = array();
    # Traverse the tree and search for direct children of the root
    foreach($tree as $child => $parent) {
        # A direct child is found
        if($parent == $root) {
            # Remove item from tree (we don't need to traverse this again)
            unset($tree[$child]);
            # Append the child into result array and parse its children
            $return[] = array(
                'name' => $child,
                'children' => parseTree($tree, $child)
            );
        }
    }
    return empty($return) ? null : $return;    
}

function printTree($tree) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul>'."\r\n";
        foreach($tree as $node) {
            echo '<li>'.$node['name'];
            printTree($node['children']);
            echo '</li>'."\r\n";
        }
        echo '</ul>'."\r\n";
    }
}

$result = parseTree($tree);
var_dump($result);
printTree($result);