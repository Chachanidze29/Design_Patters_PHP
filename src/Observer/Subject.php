<?php

namespace Observer;

interface Subject
{
    public function subscribe(Observer $observer);
    public function unsubscribe(Observer $observer);
    public function notify($context);
}