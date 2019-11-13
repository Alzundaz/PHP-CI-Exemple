<?php

namespace PHP_CI\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use PHP_CI\Main;

class MainTest extends TestCase
{

    private static $argumentsTabs = [
        [],
        ['Argument 1'],
        ['Argument 1', 'Argument 2',],
        ['Argument 1', 'Argument 2', 'Argument 3'],
        ['Argument 1', 'Argument 2', 'Argument 3', 'Argument 4'],
        ['Argument 1', 'Argument 2', 'Argument 3', 'Argument 4', 'Argument 5'],
    ];

    public function testInstance()
    {
        $app = new Main('Test');
        $this->assertInstanceOf('\PHP_CI\Main', $app);
    }

    public function testLength()
    {
        foreach (self::$argumentsTabs as $length => $arguments)
        {
            $app = new Main(...$arguments);
            $this->assertEquals($length, $app->getLength());
        }
    }

    public function testIndex()
    {
        foreach (self::$argumentsTabs as $length => $arguments)
        {
            if ($length === 0)
            {
                continue;
            }
            $app = new Main(...$arguments);
            $index = rand(0, $length - 1);
            $this->assertEquals($index, $app->getIndex($arguments[$index]));
        }

        $app = new Main(...[]);
        $this->expectException(Exception::class);
        $app->getIndex('', true);
        $this->assertFalse();
    }

    public function testGet()
    {
        foreach (self::$argumentsTabs as $length => $arguments)
        {
            if ($length === 0)
            {
                continue;
            }
            $app = new Main(...$arguments);
            $index = rand(0, $length - 1);
            $this->assertEquals($arguments[$index], $app->get($index));
        }

        $app = new Main(...[]);
        $this->expectException(Exception::class);
        $app->get(0);
        $this->assertFalse();
    }
}
