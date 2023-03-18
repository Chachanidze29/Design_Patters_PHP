<?php

class Dog {
    public function bark(): string
    {
        return "Woof";
    }
}

class Cat {
    public function meow(): string
    {
        return "Meow";
    }
}

class CatToDogAdapter extends Dog {
    private Cat $cat;

    public function __construct(Cat $cat)
    {
        $this->cat = $cat;
    }

    public function bark(): string
    {
        return $this->cat->meow();
    }
}

$cat = new Cat();
echo $cat->meow().PHP_EOL;

$catAdapter = new CatToDogAdapter($cat);
echo $catAdapter->bark().PHP_EOL;
