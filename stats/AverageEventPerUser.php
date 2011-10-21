<?php

class AverageEventPerUser extends LeanCharts_CustomStat
{
    public function define()
    {
        $this->setName('Average number of event initiated by an user');
        $this->setInterval(LeanCharts::INTERVAL_DAY);
        /* Comment: This constant is cool, and probably way more technically
        correct, but I would prefer just writing 'day' or 'month' just to 
        make the "user interface" simpler.  */
        $this->setTimeAgo(1);
        /* Comment: Sorry, I forget what this param is...is it wishful thinking for
        historical values? */
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

            $sql = "SELECT COUNT(*) AS total_events FROM logs WHERE stat_id = $statId";
            $events = $this->db->sql($sql)->one();
            $totalEvents = $events['total_events'];

            if ($totalUsers > 0) {
                $average = $totalEvents / $totalUsers;
            }

        }

        return $average;
    }
}