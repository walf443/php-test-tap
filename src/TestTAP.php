<?php

/* 
 *  Example:
 *      you wrote test code.
 *          $t = new TestTAP();
 *          $t->ok(1==0, "failed test");
 *          $t->is(1, 0, "1 should be 0");
 *          $t->subtest("categorize test", function($t) {
 *              $t->ok(0==1, "It's subtest");
 *          });
 *          $t->done_testing();  # you should call at last.
 *
 *      and you run
 *          $ php test.php
 *
 *      If you want to customize more output, use perl's Test::Harnesse's prove command.
 *
 *          $ prove -v --exec=php -r test/*.php
 *
 * */
class TestTAP {
    var $test_num = 0;
    var $fail_count = 0;
    var $context = "";
    var $context_level = 0;
    var $trace_level = 0;

    function ok ($a, $msg = null) {
        if ( $a ) {
            $this->output("ok %d - " . $msg);
            return true;
        } else {
            $this->fail_count++;
            $this->output("not ok %d - " . $msg);
            $trace = debug_backtrace();
            $this->diag("Failed test \"$msg\" file " . $trace[$this->trace_level]["file"] . " line " . $trace[$this->trace_level]["line"] . ".");
            return false;
        }
    }

    function is ($a, $b, $msg = null) {
        $ret = $a === $b;
        $this->trace_level++;
        $ret = $this->ok($ret, $msg);
        $this->trace_level--;
        if ( ! $ret ) {
            $this->diag("expected " . var_export($b, true) . "\n but got " . var_export($a, true));
        }
        return $ret;
    }

    function diag ($msg) {
        foreach ( mb_split("\n", $msg) as $line ) {
            error_log("# " . $line);
        }
    }

    function done_testing () {
        $this->output("1.." . $this->test_num);
    }

    function subtest ($test_name, $callback) {
        $this->trace_level++;
        $new = new TestTAP();
        $new->context = $this->context ? ( $this->context . ": " . $test_name ) : ( $test_name );
        $new->context_level = $this->context_level + 1;
        $callback($new);
        $new->done_testing();
        $ret = $this->ok($new->fail_count == 0, $test_name);
        $this->trace_level--;
        return $ret;
    }

    private function output ($msg) {
        $this->test_num++;
        for ($i = 0; $i < $this->context_level; $i++ ) {
            print "\t";
        }
        printf($msg . "\n", $this->test_num);
    }

}

