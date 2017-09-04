<?php
namespace SimpleCalculator\Expression;

class AddExpression extends BinaryExpression {
    protected $operator = '+';

    public function execute() {
        return $this->subExecute($this->left) + $this->subExecute($this->right);
    }
}