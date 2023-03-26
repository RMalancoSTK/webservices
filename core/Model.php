<?php

class Model extends Database
{
    public function __construct()
    {
        $this->connect();
        $this->setNames();
    }
}
