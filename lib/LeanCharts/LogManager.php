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
        $log['data'] = unserialize($log['data']);
        return $log;
    }
    
    /** 
    * Writes log to database 
    * @param $log array
    */
    
    public function create($log)
    {
        $statId = $this->getStatId($log);

        $logEntry = array(
            'stat_id'       => $statId,
            'user_id'       => $log['user_id'],
            'object_id'     => $log['object_id'],
            'object_type'   => $log['object_type'],
            'num_value'     => $log['num_value'],
            'create_date'   => $log['create_date']
        );
        
        // build 'data' from custom-entered keys
        $specialKeys = array_keys($logEntry);
        $customData = array();
        foreach($log as $key => $value) {
          if (!in_array($key, $specialKeys)) {
            $customData[$key] = $value;
          }
        }
        
        $logEntry['data'] = serialize($customData);
        
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