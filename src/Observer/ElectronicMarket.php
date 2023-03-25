<?php

namespace Observer;

require_once('Subject.php');

class ElectronicMarket implements Subject
{
    private array $observers = [];

    private array $products = ['Iphone 12', 'Samsung Galaxy S12'];

    public function addNewProduct($newProduct) {
        $this->products[] = $newProduct;

        $this->notify($newProduct);
    }

    public function subscribe(Observer $observer)
    {
        if (!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
        }
    }

    public function unsubscribe(Observer $observer)
    {
        if (($key = array_search($observer, $this->observers)) !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify($context)
    {
        foreach ($this->observers as $observer) {
            $observer->update($context);
        }
    }

    public function getAllProducts(): array
    {
        return $this->products;
    }
}