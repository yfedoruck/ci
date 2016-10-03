<?php
interface Command {
    function execute();
}

class CalculatorCommand implements Command{
    /**
     * @var Calculator
     */
    private $calculator;

    private $operator;

    private $operand;

    public function __construct(Calculator $calculator, $operator,$operand){
        $this->calculator = $calculator;
        $this->operand = $operand;
        $this->operator = $operator;
    }

    public function execute(){
        return $this->calculator->operation($this->operator, $this->operand);
    }
}

class Calculator {
    private $result = 0;

    public function operation($operator, $operand){
        if($operator == '+')
            $this->result += $operand;
        if($operator == '-')
            $this->result -= $operand;

        return $this->result;
    }
}

class User {

    /**
     * @var Calculator
     */
    private $calculator;

    public function __construct(){
        $this->calculator = new Calculator();
    }

    public function compute($operator, $operand){
        $command = new CalculatorCommand($this->calculator, $operator, $operand);
        return $command->execute();
    }
}


$u = new User();
echo $u->compute('+', 1)."<br>";
echo $u->compute('+', 1)."<br>";
echo $u->compute('+', 1)."<br>";
