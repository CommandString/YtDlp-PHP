<?php

namespace Yt\Dlp\Abstractions;

use RuntimeException;
use Yt\Dlp\Abstractions\Search\Result;
use InvalidArgumentException;
use Iterator;
use ArrayAccess;
use Countable;

abstract class AbstractCollection implements Iterator, ArrayAccess, Countable
{
    protected int $position = 0;
    protected array $items;
    protected static string $itemClass;

    public function __construct(array $items)
    {
        if (empty($items)) {
            throw new InvalidArgumentException("Items cannot be empty");
        }

        if (!isset(static::$itemClass)) {
            throw new RuntimeException("Class not set");
        }

        foreach ($items as $item) {
            if (!$item instanceof static::$itemClass) {
                throw new InvalidArgumentException("Item must be instance of " . static::$itemClass);
            }
        }

        $this->items = $items;
    }

    public function current(): Result
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset): Result
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof static::$itemClass) {
            throw new InvalidArgumentException("Item must be instance of " . static::$itemClass);
        }

        $this->items[$offset ?? count($this)] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
