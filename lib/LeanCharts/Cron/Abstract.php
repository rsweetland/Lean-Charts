<?php

class LeanCharts_Cron_Abstract
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