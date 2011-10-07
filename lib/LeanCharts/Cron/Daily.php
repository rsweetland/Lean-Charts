<?php

class LeanCharts_Cron_Daily extends LeanCharts_Cron_Abstract
{
    public function execute()
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $statManager->populateDailyStats();
        $this->runCustomStats(LeanCharts::INTERVAL_DAY);
    }
}