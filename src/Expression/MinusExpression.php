<?php
namespace SimpleCalculator\Expression;

class MinusExpression extends BinaryExpression {
    protected $operator = '-';

    public function execute() {
        return $this->subExecute($this->left) - $this->subExecute($this->right);
    }
}