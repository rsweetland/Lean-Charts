<?php

class PercentOfNewUsersValidatingAccount extends LeanCharts_CustomStat
{
    public function define()
    {
        $this->setName('2 week funnel: step 1 - percent of new users that validate');
        $this->setInterval(LeanCharts::INTERVAL_DAY);
        $this->setTimeAgo(1);
    }

    public function getUserCohort()
    {
        $statId = $this->helper->getStatId('first time fut use: user record created');
        $oneWeekBefore = date("Y-m-d", strtotime("-1 week"));
        $twoWeekBefore = date("Y-m-d", strtotime("-2 week"));

        $sql = "SELECT DISTINCT user_id
                FROM logs
                WHERE DATE(create_date) BETWEEN '$twoWeekBefore' AND '$oneWeekBefore'
                AND stat_id = $statId";

        return $sql;
    }

    public function getValue()
    {
        $percentage = 0;

        $countNewUsers = $this->helper->countUsersByStat('first time fut use: user record created', 1);
        $countValidUsers = $this->helper->countUsersByStat('validation completed', 1);

        if ($countNewUsers > 0) {
            $percentage = ($countValidUsers  / $countNewUsers) * 100;
        }

        return $percentage;
    }
}
 
