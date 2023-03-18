<?php

class Config {
    private string $title;
    private string $description;

    private static ?Config $INSTANCE = null;

    private function __construct() {
        $handle = fopen("inputfile.txt", "r");
        if ($handle) {
            $line = fgets($handle);

            $this->title = $line;
            $line = fgets($handle);
            $this->description = $line;

            fclose($handle);
        }
    }

    public static function getInstance(): Config
    {
        if (self::$INSTANCE == null) {
          self::$INSTANCE = new Config();
        }

        return self::$INSTANCE;
    }

    public function getTitle(): string
    {
        return self::$INSTANCE->title;
    }

    public function getDescription(): string
    {
        return self::$INSTANCE->description;
    }
 }

$config = Config::getInstance();
$config2 = Config::getInstance();

echo ($config === $config2).PHP_EOL;
