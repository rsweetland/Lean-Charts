<?php

class LeanCharts_LogManager extends LeanCharts_AbstractManager
{
    public function create($log)
    {
        $eventManager = new LeanCharts_EventManager($this->db);
        $event = $eventManager->getByName($log['event']);

        $logEntry = array(
            'event_id'      => $event['event_id'],
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