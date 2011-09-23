<?php

class LeanChartsTest extends PHPUnit_Framework_TestCase
{
    public function testLeanChartsCanBeInstantiated()
    {
        $leanCharts = new LeanCharts();
        $this->assertInstanceOf("LeanCharts", $leanCharts);
    }
}