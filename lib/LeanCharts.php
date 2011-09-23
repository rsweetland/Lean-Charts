<?php

class LeanCharts
{
    private static $db;
    private static $config;

    public static function init($config)
    {
        self::$config = new LeanCharts_Config($config);
        self::$db = new Sparrow(self::getDsn());
    }

    public static function logEvent($event, $userId = null, $objectId = null, $objectType = null, $numValue = null, $data = null)
    {
        $log = array(
            'event'     => $event,
            'userId'    => $userId,
            'objectId'  => $objectId,
            'objectType'=> $objectType,
            'numValue'  => $numValue,
            'data'      => $data
        );

        $logManager = new LeanCharts_LogManager(self::$db);
        $logId = $logManager->create($log);

        return $logId;
    }

    private static function getDsn()
    {
        return "mysqli://" . self::$config->get('db.user')
               . ":" . self::$config->get('db.pass')
               . "@" . self::$config->get('db.host')
               . ":" . self::$config->get('db.port')
               . "/" . self::$config->get('db.name');
    }

}