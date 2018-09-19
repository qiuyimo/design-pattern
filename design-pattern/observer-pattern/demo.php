<?php

/**
 * 抽象被观察者.
 * @since https://www.jianshu.com/p/3a98b530e195
 *
 * Class Subject
 */
abstract class Subject
{
    // 定义一个观察者数组
    private $observers = [];

    // 增加观察者方法
    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
        echo "添加观察者成功, " . get_class($observer) . PHP_EOL;
    }

    // 删除观察者方法
    public function delObserver(Observer $observer)
    {
        // 判断是否有该观察者存在
        $key = array_search($observer, $this->observers);

        // 值虽然相同 但有可能不是同一个对象 ，所以使用全等判断
        if ($observer === $this->observers[$key]) {
            unset($this->observers[$key]);
            echo '删除观察者成功, ' . get_class($observer) . PHP_EOL;
        } else {
            echo '观察者不存在，无需删除, ' . get_class($observer) . PHP_EOL;
        }
    }

    // 通知所有观察者
    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

/**
 * 具体被观察者 服务端.
 * Class Server
 */
class Server extends Subject
{
    // 具体被观察者业务 发布一条信息，并通知所有客户端
    public function publish()
    {
        echo '`被观察者:` 今天天气很好，我发布了更新包' . PHP_EOL;
        $this->notifyObservers();
    }
}

/**
 * 抽象观察者接口.
 * Interface Observer
 */
Interface Observer
{
    public function update();
}

/**
 * 具体观察者类, 微信端.
 * Class Wechat
 */
class Wechat implements Observer
{
    public function update()
    {
        echo '通知已接收，微信更新完毕' . PHP_EOL;
    }
}

/**
 * web端.
 * Class Web
 */
class Web implements Observer
{
    public function update()
    {
        echo '通知已接收，web端系统更新中' . PHP_EOL;
    }
}

/**
 * app端.
 * Class App
 */
class App implements Observer
{
    public function update()
    {
        echo '通知已接收，APP端稍后更新' . PHP_EOL;
    }
}

// 实例化被观察者
$server = new Server;

// 实例化观察者
$wechat = new Wechat;
$web = new Web;
$app = new App;

if (new Web !== new Web) {
    echo '实例化的 2 个对象, 用全等判断是不相等的.' . PHP_EOL;
} else {
    echo '实例化的 2 个对象, 用全等判断是相等的.' . PHP_EOL;
}

if (new Web != new Web) {
    echo '实例化的 2 个对象, 用非全等判断是不相等的.' . PHP_EOL;
} else {
    echo '实例化的 2 个对象, 用非全等判断是相等的.' . PHP_EOL;
}

// 添加被观察者
$server->addObserver($wechat);
$server->addObserver($web);
$server->addObserver($app);

// 被观察者 发布信息
$server->publish();

// 删除观察者
$server->delObserver($wechat);

// 再次发布信息
$server->publish();

// 尝试删除一个未添加成观察者的对象, 注意, new Web() !== new Web()
$server->delObserver(new Web);

// 再次发布信息
$server->publish();

/**
 * 总结:
 * 被观察者和观察者是一对多的关系. 即: 一个被观察者, 可以对应多个观察者, 文中的例子中, 服务端是被观察者, web, app, wechat 都是观察者.
 *
 * 被观察者: 保存了所有观察者对象, 可以添加和删除观察者. 然后遍历这些对象, 分别调用观察者必须存在的 update() 方法.
 * 观察者: 所有的观察者必须实现 update() 方法.
 */
