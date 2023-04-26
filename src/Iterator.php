<?php

class MyArrayIterator implements Iterator {

    private int $position = 0;

    private array $collection = [];

    public function __construct(int $position, array $collection)
    {
        $this->position = $position;
        $this->collection = $collection;
    }

    public function current(): mixed
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position = $this->position + 1;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}

class MyArray implements IteratorAggregate
{

    private array $items = [];

    public function getIterator(): Traversable
    {
        return new MyArrayIterator(0, $this->items);
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }
}

$myArray = new MyArray();
$myArray->addItem('Hello');
$myArray->addItem('World');

foreach ($myArray->getIterator() as $item) {
    echo $item . "\n";
}
