<?php
namespace SimpleCalculator\Expression;

use SplStack;

class ExpressionParser {
    /**
     * the operators
     * @var array
     */
    protected static $operators = [
      '+', '-', '*', '/'
    ];

    /**
     * the operator priority
     * @var array
     */
    protected static $operatorPriority = [
        '*' => 1,
        '/' => 1,
        '+' => 0,
        '-' => 0
    ];

    /**
     * parse the expression string
     * @param string $expression
     * @return \SimpleCalculator\Expression\Expression
     */
    public static function parse($expression) {
        $stack = new SplStack;
        $tempString = '';
        $level = 0;
        $tempExpression = null;

        $i = 0;
        while(($char = substr($expression, $i++, 1)) !== '') {
            if(in_array($char, self::$operators)) {
                if($level == 0) {
                    if(isset($tempExpression)) {
                        if(self::priorThan($char, $tempExpression->operator())) {
                            $stack->push($tempExpression);

                            $tempExpression = self::createBinaryExpression($char);
                            $tempExpression->left = $tempString;
                            $tempString = '';
                        } else {
                            $tempExpression->right = $tempString;
                            $tempString = '';

                            $temp = self::createBinaryExpression($char);
                            $temp->left = $tempExpression;
                            $tempExpression = $temp;
                        }
                    } else {
                        $tempExpression = self::createBinaryExpression($char);
                        $tempExpression->left = $tempString;
                        $tempString = '';
                    }
                } else {
                    $tempString .= $char;
                }
            } else {
                if($char == '(') {
                    if($level > 0) {
                        $tempString .= $char;
                    }

                    $level++;
                } else if($char == ')') {
                    $level--;

                    if($level > 0) {
                        $tempString .= $char;
                    } else {
                        $tempString = self::parse($tempString);
                    }
                } else {
                    $tempString .= $char;
                }
            }
        }

        if(!isset($tempExpression)) {
            $tempExpression = self::createBinaryExpression('*');
            $tempExpression->left = 1;
        }
        $tempExpression->right = $tempString;

        while($stack->count()) {
            $top = $stack->pop();
            $top->right = $tempExpression;

            $tempExpression = $top;
        }

        return $tempExpression;
    }

    /**
     * create a binary expression
     * @param string $operator
     * @return \SimpleCalculator\Expression\Expression
     */
    public static function createBinaryExpression($operator) {
        $expression = null;

        switch($operator) {
            case '+':
                $expression = new AddExpression;
                break;
            case '-':
                $expression = new MinusExpression;
                break;
            case '*':
                $expression = new MutipleExpression;
                break;
            case '/':
                $expression = new DivisionExpression;
                break;
            default:
                break;
        }

        return $expression;
    }

    /**
     * check whether one operator priorer than another
     * @param string $operator1
     * @param string $operator2
     * @return bool
     */
    protected static function priorThan($operator1, $operator2) {
        return self::$operatorPriority[$operator1] > self::$operatorPriority[$operator2];
    }
}