<?php

abstract class State {
    protected JukeBox $jukeBox;

    public function __construct(JukeBox $jukeBox)
    {
        $this->jukeBox = $jukeBox;
    }

    public function insertLari(): void
    {}

    public function stopMusic(): void
    {}
}

class Playing extends State {
    protected JukeBox $jukeBox;

    public function __construct(JukeBox $jukeBox)
    {
        $this->jukeBox = $jukeBox;
        parent::__construct($jukeBox);
    }

    public function stopMusic(): void
    {
        $this->jukeBox->setState(new Stopped($this->jukeBox));
        echo 'Stopped Music'.PHP_EOL;
    }
}

class Stopped extends State {
    protected JukeBox $jukeBox;

    public function __construct(JukeBox $jukeBox)
    {
        $this->jukeBox = $jukeBox;
        parent::__construct($jukeBox);
    }

    public function insertLari(): void
    {
        echo 'Tsiiiiintskarooo chamaviareeee tsintskaroooo'.PHP_EOL;
        $this->jukeBox->setState(new Playing($this->jukeBox));
    }
}

class JukeBox {
    private State $state;

    public function __construct()
    {
        $this->state = new Stopped($this);
    }

    public function insertLari(): void
    {
        $this->state->insertLari();
    }

    public function stopMusic(): void
    {
        $this->state->stopMusic();
    }

    public function getState(): string
    {
        return 'State: '.get_class($this->state).PHP_EOL;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }
}

$jukeBox = new JukeBox();

$jukeBox->insertLari();
echo $jukeBox->getState();

$jukeBox->stopMusic();
echo $jukeBox->getState();