<?php

class LeanCharts_StatHelper
{
    /**
     * @var Sparrow
     */
    protected $db;

    /**
     * @var string User cohort SQL
     */
    private $userCohort;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setUserCohort($cohort)
    {
        $this->userCohort = $cohort;
    }

    public function countUsersByStat($statName, $minInstances = 0)
    {
        $statId = $this->getStatId($statName);

        if (empty($statId)) {
            return 0;
        }

        $cohort = '';

        if (!empty($this->userCohort)) {
            $cohort = "INNER JOIN ({$this->userCohort}) AS target_users ON target_users.user_id = logs.user_id ";
        }
        
        $sql = "SELECT logs.user_id AS users, count(logs.user_id) AS event_instances
                FROM logs
                {$cohort}
                WHERE logs.stat_id = {$statId}
                GROUP BY logs.user_id ";

        if ($minInstances > 0) {
            $sql .= "HAVING event_instances >= $minInstances";
        }

        $this->db->sql($sql)->execute();
        return $this->db->num_rows;
    }

    public function getStatId($statName)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $stat = $statManager->getByName($statName);

        return !empty($stat) ? $stat['stat_id'] : null;
    }
}