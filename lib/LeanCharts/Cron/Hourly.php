<?php

class LeanCharts_Cron_Hourly extends LeanCharts_Cron_Abstract
{
    public function execute()
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $statManager->populateHourlyStats();
        /* 
        Comment: 
        $this->runCustomStats(LeanCharts::INTERVAL_HOUR);
        May be a to-do for later to add hourly custom stats. I know I didn't
        have this in there previoulsy...I see you are thining with it. Cool.
        */
    }
}