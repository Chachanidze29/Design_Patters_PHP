<?php

interface Notifier {
    public function notify(string $message);
}

class ConcreteNotifier implements Notifier
{
    public function notify(string $message): string
    {
        return $message;
    }
}

class Decorator implements Notifier {
    public function notify(string $message): string
    {
        return 'Decorate '.$message;
    }
}

class DecoratorA extends Decorator {
    public function notify(string $message): string
    {
        return 'Decorator A'. parent::notify($message);
    }
}

class DecoratorB extends Decorator {
    public function notify(string $message): string
    {
        return 'Decorator B'. parent::notify($message);
    }
}

function sendNotification(Notifier $notifier, string $message): void
{
    echo $notifier->notify($message).PHP_EOL;
}

$concreteNotifier = new ConcreteNotifier();
$message = 'Hello World';
sendNotification($concreteNotifier, $message);

$decoratorA = new DecoratorA();
sendNotification($decoratorA, $message);

$decoratorB = new DecoratorB();
sendNotification($decoratorB, $message);
