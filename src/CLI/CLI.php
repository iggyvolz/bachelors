<?php

namespace iggyvolz\Bachelors\CLI;

use Symfony\Component\Console\Application;

class CLI extends Application
{
    public function __construct()
    {
        parent::__construct("Bachelors", "dev");
        $this->add(new StartCommand());
    }
}