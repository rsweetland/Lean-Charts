<?php

class LeanChartsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config/app.ini');
        setupTestDatabase();
    }

    public function testLoggingWithMinimalInformationWorks()
    {
        $logId = LeanCharts::log("sent: fut to sender");
        $this->assertEquals(1, $logId);
    }

    public function testLoggingWithSpecificDateWorks()
    {
        $targetDate = "2010-12-30 23:59:59";
        $logId = LeanCharts::log('sent: fut to sender', 1, 1, null, null, null, $targetDate);

        $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
        $log = $logManager->getById($logId);

        $this->assertEquals($targetDate, $log['create_date']);
    }
}