<?php

class LeanCharts_ChangeEventManager
{
    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stats = $this->db->from('changes')->many();
        return $stats;
    }

    public function create($data)
    {
        $changeEventEntry = array(
            'title'         => $data['title'],
            'description'   => $data['description'],
            'date'          => date("Y-m-d", strtotime($data['date']))
        );

        $this->db->from('changes')->insert($changeEventEntry)->execute();
        return $this->db->insert_id;
    }

    public function getEventsWithinDataRange($data)
    {
        $count = 0;
        $startDate = '';
        $endDate = '';

        foreach ($data as $date => $value) {

            if ($count == 0) {
                $endDate = date("Y-m-d", strtotime($date));
            }

            if ($count == count($data) - 1) {
                $startDate = date("Y-m-d", strtotime($date));
            }

            $count++;
        }

        $sql = "SELECT * FROM changes WHERE `date` BETWEEN '$startDate' AND '$endDate'";
        $result = $this->db->sql($sql)->many();

        return $result;
    }
}