<?php
//this is just to make the code run for now
class TestProdRepo
{
    static function init()
    {
        $a = new Product("A1", 1);
        $b = new Product("B1", 2);
        $c = new Product("C1", 3);
        $d = new Product("D1", 4);
        $e = new Product("E1", 5);
        $f = new Product("F1", 6);

        return array($a, $b, $c, $d, $e, $f);
    }
}