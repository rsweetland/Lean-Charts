<?php

class LeanCharts
{
    /**
     * @var Sparrow
     */
    private static $db;

    /**
     * @var LeanCharts_Config
     */
    private static $config;

    /**
     * Initializes LeanCharts
     *
     * @param $configFile string Location of configuration file
     * @return void
     */
    public static function init($configFile)
    {
        self::$config = new LeanCharts_Config($configFile);
        self::$db = new Sparrow(self::getDsn());
    }

    /**
     * Logs an Event
     *
     * Logs an event in the system as it happens in an application.
     *
     * @param $event string Name of event
     * @param $userId int An user ID associated for the event (optional)
     * @param $objectId int An object ID associated with the event (optional)
     * @param $objectType string The type of object specified in earlier parameter (optional)
     * @param $numValue float An arbitrary number associated with the event (optional)
     * @param $data string Any related data in string format (optional)
     * @param $date string Date of the event
     * @return int The ID of the recorded log
     */
    public static function log($event, $userId = null, $objectId = null, $objectType = null, $numValue = null, $data = null, $date = null)
    {
        $log = array(
            'event'     => $event,
            'userId'    => $userId,
            'objectId'  => $objectId,
            'objectType'=> $objectType,
            'numValue'  => $numValue,
            'data'      => $data,
            'date'      => $date
        );

        $logManager = new LeanCharts_LogManager(self::$db);
        $logId = $logManager->create($log);

        return $logId;
    }

    /**
     * Get the database object
     *
     * @return Sparrow
     */
    public static function getDb()
    {
        return self::$db;
    }

    /**
     * Get the DSN string
     *
     * @return string
     */
    private static function getDsn()
    {
        return "mysqli://" . self::$config->get('db.user')
               . ":" . self::$config->get('db.pass')
               . "@" . self::$config->get('db.host')
               . ":" . self::$config->get('db.port')
               . "/" . self::$config->get('db.name');
    }
}