<?php

class LeanChartsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config/app.ini');
    }

    public function testEventsLoggingWithMinimalInformation()
    {
        $logId = LeanCharts::logEvent("sent: fut to sender");
        $this->assertEquals(1, $logId);
    }
}