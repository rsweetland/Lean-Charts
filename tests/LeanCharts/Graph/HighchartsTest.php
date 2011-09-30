<?php

class LeanCharts_Graph_HighchartsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        LeanCharts::init(TEST_DIR . '/config/app.ini');
        setupTestDatabase();
    }

    public function testCorrectHighchartsConfigurationIsGenerated()
    {
        $data = array(
            '2011-06-15' => 10,
            '2011-06-16' => 5,
            '2011-06-17' => 17
        );

        $stat = array(
            'stat_id' => 1,
            'name' => "fut scheduled",
            'weight' => 1,
            'send_alert' => 0
        );

        $graph = new LeanCharts_Graph_Highcharts($stat, $data);
        $output = $graph->render();

        $this->assertContains("lean_graph", $output);
        $this->assertContains("name: 'fut scheduled'", $output);
        $this->assertContains("data: [17,5,10]", $output);
        $this->assertContains("pointStart: Date.UTC(2011, 5, 17)", $output);
    }
}