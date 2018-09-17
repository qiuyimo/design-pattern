<?php

interface Decorater
{
    public function display();
}


class XiaoFang implements Decorater
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function display()
    {
        echo "我是" . $this->name . "我出门了!!!" . '<br/>';
    }
}


class Finery implements Decorater
{
    private $component;

    public function __construct(Decorater $component)
    {
        $this->component = $component;
    }

    public function display()
    {

        $this->component->display();
    }
}


class Shoes extends Finery
{
    public function display()
    {
        echo '穿上鞋子' . '<br/>';
        parent::display();
    }
}

class Skirt extends Finery
{
    public function display()
    {
        echo '穿上裙子' . '<br/>';
        parent::display();
    }
}

class Fire extends Finery
{
    public function display()
    {
        echo '出门前先整理头发' . '<br>';
        parent::display();
        echo '出门后再整理一下头发' . '<br>';
    }
}

$xiaofang = new XiaoFang('小芳');
$shoes = new Shoes($xiaofang);
$skirt = new Skirt($shoes);

$fire = new Fire($skirt);

new Fire(
    new Skirt(
        new Shoes(
            new XiaoFang(
                '小芳'
            )
        )
    )
);

$fire->display();
