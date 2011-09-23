<?php

class LeanCharts_EventManager extends LeanCharts_AbstractManager
{
    public function get($eventId)
    {
        $event = $this->db->from('events')->where('event_id', $eventId)->one();
        return $event;
    }

    public function getByName($eventName)
    {
        $event = $this->db->from('events')->where('name =', $eventName)->one();
        return $event;
    }

    public function create($event)
    {
        $this->db->from('events')->insert($event)->execute();
    }
}