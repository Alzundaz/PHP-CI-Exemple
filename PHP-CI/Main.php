<?php

namespace PHP_CI;

use Exception;

class Main
{
    private $arguments;

    public function __construct(...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function getLength(): int
    {
        return count($this->arguments);
    }

    public function getIndex($value, $strict = null): int
    {
        $key = array_search($value, $this->arguments, $strict);
        if ($key !== false)
        {
            return $key;
        }
        throw new Exception('Value not present in the array.');
    }

    public function get(int $index)
    {
        if ($index < count($this->arguments))
        {
            return $this->arguments[$index];
        }

        throw new Exception('Index not present in the array.');
    }
}
