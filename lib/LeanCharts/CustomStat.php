<?php

abstract class LeanCharts_CustomStat
{
    /**
     * @var Sparrow
     */
    protected $db;

    public $name;
    public $timeAgo;
    public $interval;
    public $historicalStart;

    public function __construct($db)
    {
        $this->db = $db;
        $this->define();
    }

    public function run($interval)
    {
        $value = $this->getValue();
        $statId = $this->getStatId($this->name);

        $statManager = new LeanCharts_StatManager($this->db);

        if ($this->interval == $interval) {
            if ($this->interval == LeanCharts::INTERVAL_DAY) {
                $statManager->insertDailyStat($statId, $this->timeAgo, $value);
            } else {
                $statManager->insertHourlyStat($statId, $this->timeAgo, $value);
            }
        }
    }

    public function countUsersByStat($statName, $minInstances = 0)
    {
        $statId = $this->getStatId($statName);
        $cohort = $this->getUserCohort();

        $sql = "SELECT
                  logs.user_id AS users,
                  count(logs.user_id) AS event_instances
                FROM
                  logs ";

        if (!empty($cohort)) {
            $sql .= "INNER JOIN ($cohort) AS target_users ON target_users.user_id = logs.user_id ";
        }

        $sql .= "WHERE
                    logs.stat_id = {$statId}
                 GROUP BY
                    logs.user_id ";

        if ($minInstances) {
            $sql .= "HAVING event_instances >= $minInstances";
        }

        $this->db->sql($sql)->execute();
        return $this->db->num_rows;
    }

    public function getStatId($statName)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $stat = $statManager->getByName($statName);

        if (!empty($stat)) {
            $statId = $stat['stat_id'];
        } else {
            $statId = $statManager->create(array(
                'name' => $statName
            ));
        }

        return $statId;
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