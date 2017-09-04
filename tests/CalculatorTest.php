<?php
namespace SimpleCalculator\Test;

use PHPUnit\Framework\TestCase;
use SimpleCalculator\Calculator;

class CalculatorTest extends TestCase {
    protected $calculator;

    public function setUp() {
        $this->calculator = new Calculator;
    }

    public function testCalc() {
        $this->assertEquals($this->calculator->calc('1+2'), 3);
        $this->assertEquals($this->calculator->calc('1+2*2'), 5);
        $this->assertEquals($this->calculator->calc('(1+2)*2'), 6);
        $this->assertEquals($this->calculator->calc('(1-2)*2'), -2);
        $this->assertEquals($this->calculator->calc('(1-2)*(2+3)'), -5);
        $this->assertEquals($this->calculator->calc('(1-2)*(2+3)'), -5);
        $this->assertEquals($this->calculator->calc('(1-(2/4))*(2+3)'), 2.5);
        $this->assertEquals($this->calculator->calc('((1+2))*3'), 9);
    }
}