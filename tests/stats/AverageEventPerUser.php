<?php

class AverageEventPerUser extends LeanCharts_CustomStat
{
    public function define()
    {
        $this->setName('Average number of event initiated by an user');
        $this->setIntervalDaily();
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

        $statId = $this->helper->getStatId('fut scheduled');

        if (!empty($statId)) {

            $totalEvents = $this->helper->countStats('fut scheduled');

            if ($totalUsers > 0) {
                $average = $totalEvents / $totalUsers;
            }

        }

        return $average;
    }
}