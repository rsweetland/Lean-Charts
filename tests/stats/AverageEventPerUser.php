<?php

class AverageEventPerUser extends LeanCharts_CustomStat
{
    public function define()
    {
        $this->setName('Average number of event initiated by an user');
        $this->setInterval(LeanCharts::INTERVAL_DAY);
        $this->setTimeAgo(1);
    }

    public function getUserCohort()
    {
        $sql = "SELECT DISTINCT user_id FROM logs";
        return $sql;
    }

    public function getValue()
    {
        $average = 0;

        $sql = "SELECT COUNT(DISTINCT user_id) AS total_users FROM logs";
        $users = $this->db->sql($sql)->one();
        $totalUsers = $users['total_users'];

        $statId = $this->getStatId('fut scheduled');
        $sql = "SELECT COUNT(*) AS total_events FROM logs WHERE stat_id = $statId";
        $events = $this->db->sql($sql)->one();
        $totalEvents = $events['total_events'];

        if ($totalUsers > 0) {
            $average = $totalEvents / $totalUsers;
        }

        return $average;
    }
}