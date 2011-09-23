<?php

class LeanCharts_ConfigTest extends PHPUnit_Framework_TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new LeanCharts_Config(TEST_DIR . '/config.ini');
    }

    public function testConfigurationLoadWorks()
    {
        $this->assertEquals('lean_charts_test', $this->config->get('db.name'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidKeyThrowsException()
    {
        $this->config->get('invalid.key');
    }
}