<?php

class LeanChartsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        ini_set('error_reporting', 1);
        ini_set('display_errors', 1);
        LeanCharts::init(TEST_DIR . '/config/app.ini');
        setupTestDatabase();
    }

    // public function testLoggingWithMinimalInformationWorks()
    // {
    //     $logId = LeanCharts::log("sent: fut to sender");
    //     $this->assertEquals(1, $logId);
    // }
    // 
    // public function testLoggingWithSpecificDateWorks()
    // {
    //   
    //     $targetDate = "2010-12-30 23:59:59";
    //     $params = array('user_id' =>1, 'create_date'=>$targetDate); 
    //     // $logId = LeanCharts::log('sent: fut to sender', 1, 1, null, null, null, $targetDate);
    //     $logId = LeanCharts::log('sent: fut to sender', $params);
    // 
    //     $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
    //     $log = $logManager->getById($logId);
    // 
    //     $this->assertEquals($targetDate, $log['create_date']);
    // }
    
    public function testLoggingWithNormalParamsWorks()
    {
        $data = array('event'     => 'sent:fut to sender1',
                        'user_id'    => 2,
                        'object_id'  => 2,
                        'object_type'=> null,
                        'num_value'  => 43,
                        'create_date' => 'NOW()');
    
        $logId = LeanCharts::log('sent: fut to sender1', $data);
    
        $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
        $log = $logManager->getById($logId);
    
        $this->assertEquals($data['user_id'], $log['user_id']);
    }


    public function testLoggingWithCustomParamsWorks()
    {
        $targetDate = "2010-12-30 23:59:59";
        $data = array('event'     => 'sent:fut to sender1',
                        'user_id'    => 2,
                        'object_id'  => 2,
                        'object_type'=> null,
                        'num_value'  => 43,
                        'custom_1'  => 'lorem',
                        'custom_2'  => 'ipsum',
                        'custom_3'  => 'sigmit',
                        'create_date' => $targetDate);
    
        $logId = LeanCharts::log('sent: fut to sender1', $data);
    
        $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
        $log = $logManager->getById($logId);
    
        $this->assertEquals($data['custom_1'], $log['data']['custom_1']);
    }


}