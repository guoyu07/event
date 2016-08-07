<?php
/**
 *
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Event\Event;

class EventsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        include_once __DIR__ . '/DemoEvent.php';
    }

    public function testOn()
    {
        $event = new Event();

        $event->on('test.name', function () {
            return 'name';
        });

        $this->assertEquals('name', $event->trigger('test.name'));

        $event->on('test.array', [$this, 'arrayReturn']);

        $this->assertEquals(['name' => 'jan'], $event->trigger('test.array'));
    }

    public function testArgs()
    {
        $event = new Event();

        $event->on('test.args', function ($name) {
            return $name;
        });

        $this->assertEquals('jan', $event->trigger('test.args', ['jan']));
    }

    public function arrayReturn()
    {
        return ['name' => 'jan'];
    }

    public function testEventCallable()
    {
        $demoEvent = new DemoEvent();

        $demoEvent->on('demoAction', function ($method) {
            return $method;
        });

        $result = $demoEvent->trigger('demoAction');

        print_r($result);
    }
}
