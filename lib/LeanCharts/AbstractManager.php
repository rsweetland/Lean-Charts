<?php

class LeanCharts_AbstractManager
{
    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}