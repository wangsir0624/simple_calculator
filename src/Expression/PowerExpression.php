<?php
namespace SimpleCalculator\Expression;

class PowerExpression extends BinaryExpression {
    protected $operator = '^';

    public function execute() {
        return pow($this->subExecute($this->left), $this->subExecute($this->right));
    }
}