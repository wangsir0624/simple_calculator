<?php
namespace SimpleCalculator\LexicalAnalysis;

class Scanner {
    const NUM = 1;
    const LB = 2;
    const RB = 3;
    const ADD = 4;
    const MIN = 5;
    const MUL = 6;
    const DIV = 7;
    const MOD = 8;
    const POW = 9;

    protected static $operators = [
      '+', '-', '*', '/', '%', '^', '(', ')'
    ];

    /**
     * @param $string
     * @throw
     */
    public static function scan($string) {
        $tokens = [];

        $i = 0;
        while(($char = substr($string, $i++, 1)) != '') {
            if($char == ' ') {
                continue;
            } else if($char >= '0' && $char <= '9') {
                $temp = $char;

                $j = 0;
                do {
                    $next = substr($string, $i+$j++, 1);

                    if($next == ' ') {
                        $i++;
                        continue;
                    } else if($next >= '0' && $char <= '9') {
                        $temp .= $next;
                        $i++;
                    } else if(in_array($next, self::$operators)) {
                        break;
                    } else {
                        if($i < strlen($string)) {
                            exit('语法错误');
                        } else {
                            break;
                        }
                    }
                } while(true);

                $tokens[] = [self::NUM, intval($temp)];
            } else if(in_array($char, self::$operators)) {
                if($char == '(') {

                } else if($char == ')') {

                } else {

                }
            }
        }

        return $tokens;
    }
}