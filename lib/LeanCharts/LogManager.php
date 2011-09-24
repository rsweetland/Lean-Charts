<?php

class LeanCharts_LogManager extends LeanCharts_AbstractManager
{
    public function create($log)
    {
        $statManager = new LeanCharts_StatManager($this->db);
        $stat = $statManager->getByName($log['event']);

        $logEntry = array(
            'stat_id'       => $stat['stat_id'],
            'user_id'       => $log['userId'],
            'object_id'     => $log['objectId'],
            'object_type'   => $log['objectType'],
            'num_value'     => $log['numValue'],
            'data'          => $log['data']
        );

        $this->db->from('logs')->insert($logEntry)->execute();
        return $this->db->insert_id;
    }
}