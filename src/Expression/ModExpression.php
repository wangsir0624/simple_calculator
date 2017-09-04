<?php
namespace SimpleCalculator\Expression;

class ModExpression extends BinaryExpression {
    protected $operator = '%';

    public function execute() {
        return $this->subExecute($this->left) % $this->subExecute($this->right);
    }
}