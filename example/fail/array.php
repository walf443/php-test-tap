#!/usr/bin/env php
<?php

require_once('src/TestTAP.php');

$t = new TestTAP();

$t->subtest("testing array_push", function ($t) {
	$ary = array(1, 2, 3);
	$t->is(array_push($ary, 4), 4, "item num should be 4");
	$t->is($ary, array(1, 2, 3, 4), "item should be pushed at last");
});

$t->subtest("testing array_pop", function ($t) {
    $ary = array(1, 2, 3);
    $t->is(array_pop($ary), 2, "3 should be poped");
    $t->is($ary, array(1, 2), "array should be changed");
});

$t->subtest("testing array_shift", function ($t) {
    $ary = array(1, 2, 3);
    $t->is(array_shift($ary), 1, "1 should be shifted");
});

$t->subtest("testing count", function ($t) {
    $t->is( count(array(1, 2, 3)), 3, "count should be 3");
    $t->is( count(array(1, 2, 4, 3)), 4, "count should be 3");
});

$t->subtest("testing array_chunk", function ($t) {
	$ary = array(1, 2, 3, 4);
	$t->is(array_chunk($ary, 2), array(array(1,2), array(3, 4)), "chunk ok");
	$t->is(array_chunk($ary, 3), array(array(1,2,3), array(4)), "chunk ok");
});

$t->subtest("testing array_combile", function ($t) {
	$key = array("green", "red", "yellow");
	$value = array("avogado", "apple", "banana");
	$t->is(array_combine($key, $value), array("green" => "avogado", "red" => "apple", "yellow" => "banana"), "combine ok");
});

$t->subtest("testing array_merge", function ($t) {
	$ary = array(1, 2, 3);
	$t->is(array_merge($ary, array(4, 5)), array(1, 2, 3, 4, 5), "merge ok");
});

$t->subtest("testing array_map", function ($t) {
	$ary = array(1, 2, 3);
	$square = function ($x) {
		return $x * $x;
	};
	$t->is(array_map($square, $ary), array(1, 4, 8), "map ok");
});

$t->subtest("testing array_count_values", function ($t) {
    $ary = array(1, "hello", 1, "world", "hello");
    $t->is(array_count_values($ary), array(1 => 2, "hello" => 2, "world" => 1), "array_count_values ok");
});

$t->subtest("testing array_diff_assoc", function ($t) {
    $ary1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
    $ary2 = array("a" => "green", "yellow", "red");
    $t->is(array_diff_assoc($ary1, $ary2), array("b" => "brown", "c" => "blue", "0" => "red"), "array_diff_assoc ok");
});

$t->subtest("testing array_fill", function ($t) {
    $t->is(array_fill(5, 2, "banana"), array(5 => "banana", 6 => "banana"), "array_fill ok");
});

$t->subtest("testing array_filter", function ($t) {
    $ary = array(1, 2, 3, 4, 5);
    $t->is(array_filter($ary, function ($n) { return $n % 2 == 0; }), array(1 => 2, 3 => 4), "filter ok");

});

$t->subtest("testing array_flip", function ($t) {
    $ary = array("a" => 1, "b" => 2, "c" => 3);
    $t->is(array_flip($ary), array(1 => "a", 2 => "b", 4 => "c"), "flip ok");
});

$t->subtest("testing arraay_intersect", function ($t) {
    $ary1 = array("green", "red", "blue");
    $ary2 = array("green", "yellow", "red");
    $t->is(array_intersect($ary1, $ary2), array("green", "red"), "array_intersect ok");
});

$t->subtest("testing array_keys", function ($t) {
    $t->is(array_keys( array(0 => 100, "color" => "red") ), array(0, "color"), "array_keys ok");
});


$t->done_testing();

