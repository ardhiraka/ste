<?php

class permutation {
    public $permutations = array();
    function __construct(array $arr) { $this->showPerms($this->permute($arr)); }
    private function showPerms($a,$i='') {
        if (is_array($a))
            foreach($a as $k => $v) 
                $this->showPerms($v,$i.$k);
        else 
            $this->results[] = $i.$a;
    }
    private function permute(array $arr) {
        $out = array();
        if (count($arr) > 1) 
            foreach($arr as $r => $c) {
                $n = $arr;
                unset($n[$r]);
                $out[$c] = $this->permute($n);
            }
        else
            return array_shift($arr);
        return $out;
    }       
}

$a = new permutation([1, 2]);
echo "<pre>";
print_r($a->results);
