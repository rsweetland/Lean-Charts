<?php

class LeanCharts_Cron_Hourly extends LeanCharts_Cron_Abstract
{
    public function execute($hoursAgo = 1)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $statManager->populateHourlyStats();
        $this->runCustomStats(LeanCharts::INTERVAL_HOUR);
    }
}