<?php
namespace SimpleCalculator\Expression;

abstract class Expression {
    /**
     * the operator of the expression
     * @var string
     */
    protected $operator;

    /**
     * execute the expression
     * @return mixed
     */
    abstract public function execute();

    /**
     * get the operator of the expression
     * @return string
     */
    public function operator() {
        return $this->operator;
    }

    /**
     * execute the sub expression
     * @param mixed $expression
     * @return mixed
     */
    public function subExecute($expression) {
        $result = null;

        if($expression instanceof self) {
            $result = $expression->execute();
        } else {
            $result = $expression;
        }

        return $result;
    }
}