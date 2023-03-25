<?php

namespace Observer;

require_once('Observer.php');

class Jimmy implements Observer
{
    public function update($context)
    {
        if (gettype($context) === 'string' && $context === 'Iphone 13') {
            print("I'm Jimmy and I'll buy {$context}\n");
        } else {
            print("I'm Jimmy and I ain't buying {$context}\n");
        }
    }
}