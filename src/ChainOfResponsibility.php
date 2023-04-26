<?php

interface Chef {
    public function passNext(Chef $chef): Chef;

    public function cook(string $foodName): ?string;
}

abstract class AbstractChef implements Chef {
    private Chef $nextChef;

    public function passNext(Chef $chef): Chef
    {
        $this->nextChef = $chef;

        return $chef;
    }

    public function cook(string $foodName): ?string
    {
        if ($this->nextChef) {
            return $this->nextChef->cook($foodName);
        }

        return null;
    }
}

class PizzaChef extends AbstractChef {
    public function cook(string $foodName): string
    {
        if ($foodName === 'Pizza') {
            return "Here take pizza";
        }

        return parent::cook($foodName);
    }
}

class BreadChef extends AbstractChef {
    public function cook(string $foodName): string
    {
        if ($foodName === 'Bread') {
            return "Here take bread";
        }

        return parent::cook($foodName);
    }
}

$pizzaChef = new PizzaChef();
$breadChef = new BreadChef();
$pizzaChef->passNext($breadChef);

$foodName = 'Bread';

$result = $pizzaChef->cook($foodName);

if ($result) {
    echo $foodName.' Was cooked'.PHP_EOL;
}