<?php

class LeanChartsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config.ini');
    }

    public function testEventsLoggingWithMinimalInformation()
    {
        $logId = LeanCharts::logEvent("fut scheduled");
        $this->assertEquals(3, $logId);
    }
}