<?php

use Observer\ElectronicMarket;
use Observer\Jimmy;

require_once('ElectronicMarket.php');
require_once('Jimmy.php');

$electronicMarket = new ElectronicMarket();
$jimmy = new Jimmy();

$electronicMarket->subscribe($jimmy);
$electronicMarket->addNewProduct('Iphone 13');
