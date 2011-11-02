<?php

class LeanCharts_Cron_Daily extends LeanCharts_Cron_Abstract
{
    public function execute($daysAgo = 1)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $statManager->populateDailyStats($daysAgo);
        $this->runCustomStats(LeanCharts::INTERVAL_DAY);
    }
}