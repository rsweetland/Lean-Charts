<?php

class LeanCharts_ChangeEventManager
{
    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stats = $this->db->from('changes')->many();
        return $stats;
    }
}