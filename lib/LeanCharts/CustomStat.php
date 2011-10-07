<?php

abstract class LeanCharts_CustomStat
{
    /**
     * @var Sparrow
     */
    protected $db;

    /**
     * @var \LeanCharts_StatHelper
     */
    protected $helper;

    public $name;
    public $timeAgo;
    public $interval;
    public $historicalStart;

    public function __construct($db)
    {
        $this->db = $db;
        
        $this->helper = new LeanCharts_StatHelper($this->db);
        $this->helper->setUserCohort($this->getUserCohort());
        
        $this->define();
    }

    public function run($interval)
    {
        $statManager = new LeanCharts_StatManager($this->db);

        $stat = $statManager->register($this->name);
        $value = $this->getValue();

        if ($this->interval == $interval) {
            if ($this->interval == LeanCharts::INTERVAL_DAY) {
                $statManager->insertDailyStat($stat['stat_id'], $this->timeAgo, $value);
            } else {
                $statManager->insertHourlyStat($stat['stat_id'], $this->timeAgo, $value);
            }
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    public function setTimeAgo($timeAgo)
    {
        $this->timeAgo = $timeAgo;
    }

    abstract public function define();
    abstract public function getValue();
    abstract public function getUserCohort();
}