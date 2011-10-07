<?php

class LeanCharts_CustomStatTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config/app.ini');
        setupTestDatabase();
    }

    public function testCustomStatLoadsFromDirectory()
    {
        $dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
        $dailyCron->setCustomStatsPath(TEST_DIR . '/stats');
        $dailyCron->execute();

        $this->assertTrue(class_exists('AverageEventPerUser'));
    }

    public function testCustomStatValueRecordedProperly()
    {
        // Populate the logs
        $targetDate = date("Y-m-d H:i:s", strtotime("yesterday"));
        $this->populateLogTable(3, $targetDate, 1);
        $this->populateLogTable(5, $targetDate, 5);
        $this->populateLogTable(4, $targetDate, 9);

        // Simulate cron run
        $dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
        $dailyCron->setCustomStatsPath(TEST_DIR . '/stats');
        $dailyCron->execute();

        // Get stats
        $statManager = new LeanCharts_StatManager(LeanCharts::getDb());
        $statId = $statManager->getByName('Average number of event initiated by an user');
        $statValues = $statManager->getStatValues($statId, "daily", 1);

        // Average is (12 entries / 3 users) = 4
        $this->assertEquals(4, $statValues[$targetDate]);
    }

    public function testUserCountByStatWorksWithCohort()
    {
        // Create registration data
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-8 days")), 1, 'first time fut use: user record created');
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-10 days")), 5, 'first time fut use: user record created');
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-12 days")), 9, 'first time fut use: user record created');
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-12 days")), 13, 'first time fut use: user record created');

        // Create validation data
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-3 days")), 9, 'validation completed');
        $this->populateLogTable(1, date("Y-m-d H:i:s", strtotime("-2 days")), 5, 'validation completed');

        // Simulate cron run
        $dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
        $dailyCron->setCustomStatsPath(TEST_DIR . '/stats');
        $dailyCron->execute();

        // Get stats
        $statManager = new LeanCharts_StatManager(LeanCharts::getDb());
        $stat = $statManager->getByName('2 week funnel: step 1 - percent of new users that validate');
        $statValues = $statManager->getStatValues($stat['stat_id'], "daily", 1);

        // Percentage is :: (total validated / total registered) * 100 = (2/4) * 100 = 50
        $targetDate = date("Y-m-d H:i:s", strtotime("yesterday"));
        $this->assertEquals(50, $statValues[$targetDate]);
    }

    private function populateLogTable($numberOfEntries, $targetDate, $userId = 1, $event = 'fut scheduled')
    {
        for ($i = 1; $i <= $numberOfEntries; $i++) {
            LeanCharts::log($event, $userId, 1, 'user', null, null, $targetDate);
        }
    }
}