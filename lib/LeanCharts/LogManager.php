<?php

class LeanCharts_LogManager
{
    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getById($logId)
    {
        $log = $this->db->from('logs')->where('log_id =', $logId)->one();
        return $log;
    }
    
    public function create($log)
    {
        $statId = $this->getStatId($log);

        $logEntry = array(
            'stat_id'       => $statId,
            'user_id'       => $log['userId'],
            'object_id'     => $log['objectId'],
            'object_type'   => $log['objectType'],
            'num_value'     => $log['numValue'],
            'data'          => $log['data'],
            'create_date'   => $log['date']
        );

        $this->db->from('logs')->insert($logEntry)->execute();
        return $this->db->insert_id;
    }

    private function getStatId($log)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $stat = $statManager->register($log['event']);
        return $stat['stat_id'];
    }
}