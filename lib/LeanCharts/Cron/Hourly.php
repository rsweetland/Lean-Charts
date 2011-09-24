<?php

class LeanCharts_Cron_Hourly extends LeanCharts_Cron_Abstract
{
    public function execute()
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $statManager->populateHourlyStats();
    }
}