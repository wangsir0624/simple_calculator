<?php
namespace SimpleCalculator;

use SimpleCalculator\Expression\ExpressionParser;

class Calculator {
    /**
     * the expression parser
     * @var \SimpleCalculator\Expression\ExpressionParser
     */
    protected $parser;

    public function __construct() {
        $this->parser = new ExpressionParser;
    }

    /**
     * calculate an expression
     * @param string $expression
     * @return string
     */
    public function calc($expression) {
        //parse the expression string
        $expression = $this->parser->parse($expression);

        //calculate the expression
        return $expression->execute();
    }
}