<?php

namespace App\Services;

class Calculator
{
    public $operand1;
    public $operand2;

    public function __construct($operand1, $operand2)
    {
        $this->operand1 = $operand1;
        $this->operand2 = $operand2;
    }

    public function add()
    {
        return $this->operand1 + $this->operand2;
    }

    public function subtract()
    {
        return $this->operand1 - $this->operand2;
    }

    public function multiply()
    {
        return $this->operand1 * $this->operand2;
    }

    public function divide()
    {
        if ($this->operand2 == 0) {
            return 'Error: Division by zero';
        }
        return $this->operand1 / $this->operand2;
    }
}
