<?php

/**
 * @since https://segmentfault.com/a/1190000008626919
 * Interface Component
 */

// 被装饰者基类
interface Component
{
    public function operation();
}

// 装饰者基类
abstract class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation()
    {
        $this->component->operation();
    }
}


// 具体装饰者类
class ConcreteComponent implements Component
{
    public function operation()
    {
        echo 'do operation' . PHP_EOL;
        return 'do operation' . PHP_EOL;
    }
}

// 具体装饰者a
class ConcreteDecoratorA extends Decorator
{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }

    public function operation()
    {
        parent::operation();
        $this->addOperationA();
    }

    public function addOperationA()
    {
        echo 'add operation a' . PHP_EOL;
        return 'add operation a' . PHP_EOL;
    }
}

// 具体装饰者类b
class ConcreteDecoratorB extends Decorator
{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }

    public function operation()
    {
        parent::operation();
        $this->addOperationB();
    }

    public function addOperationB()
    {
        echo 'add operation b' . PHP_EOL;
    }
}

$decoratorA = new ConcreteDecoratorA(new ConcreteComponent());
$decoratorA->operation();
