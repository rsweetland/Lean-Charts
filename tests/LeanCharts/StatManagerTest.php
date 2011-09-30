<?php

class LeanCharts_StatManagerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config/app.ini');
        setupTestDatabase();
    }

    public function testDailyLogSummaryIsCorrect()
    {
        // Populate the logs
        $numberOfEntries = rand(1, 10);
        $targetDate = date("Y-m-d H:i:s", strtotime("yesterday"));
        $this->populateLogTable($numberOfEntries, $targetDate);

        // Simulate cron run
        $dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
        $dailyCron->execute();

        // Get stats
        $statManager = new LeanCharts_StatManager(LeanCharts::getDb());
        $statValues = $statManager->getStatValues(1, "daily");

        // Assertions
        $this->assertEquals(1, count($statValues));
        $this->assertEquals($numberOfEntries, $statValues[$targetDate]);
    }

    public function testHourlyLogSummaryIsCorrect()
    {
        // Populate the logs
        $numberOfEntries = rand(1, 10);
        $targetDate = date("Y-m-d H:i:s", strtotime("last hour"));
        $this->populateLogTable($numberOfEntries, $targetDate);

        // Simulate cron run
        $hourlyCron = new LeanCharts_Cron_Hourly(LeanCharts::getDb());
        $hourlyCron->execute();

        // Get stats
        $statManager = new LeanCharts_StatManager(LeanCharts::getDb());
        $statValues = $statManager->getStatValues(1, "hourly");

        // Assertions
        $this->assertEquals(1, count($statValues));
        $this->assertEquals($numberOfEntries, $statValues[date("Y-m-d H", strtotime("last hour")) . ":00:00"]);
    }

    private function populateLogTable($numberOfEntries, $targetDate)
    {
        for ($i = 1; $i <= $numberOfEntries; $i++) {
            LeanCharts::log('first time fut use: user record created', 1, 1, 'user', null, null, $targetDate);
        }
    }

}