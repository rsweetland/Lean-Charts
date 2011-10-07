<?php

class LeanCharts_StatManager
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
        $stats = $this->db->from('stats')->many();
        return $stats;
    }

    public function getAllWeighted()
    {
        $stats = $this->db->from('stats')->sortDesc('weight')->many();
        return $stats;
    }

    public function getById($statId)
    {
        $stat = $this->db->from('stats')->where('stat_id =', $statId)->one();
        return $stat;
    }

    public function getByName($statName)
    {
        $stat = $this->db->from('stats')->where('name =', $statName)->one();
        return $stat;
    }

    public function getStatValues($statId, $interval = 'daily', $limit = 20)
    {
        $table = ($interval == 'daily') ? 'stats_day' : 'stats_hour';

        $stats = $this->db->from($table)
                          ->where('stat_id = ', $statId)
                          ->sortDesc('timestamp')
                          ->limit($limit)
                          ->select(array('timestamp', 'value'))
                          ->many();

        $data = array();
        foreach($stats as $stat) {
            $data[$stat['timestamp']] = $stat['value'];
        }

        return $data;
    }

    public function register($statName)
    {
        $stat = $this->getByName($statName);

        if (empty($stat)) {
            $this->create(array('name' => $statName));
            $stat = $this->getByName($statName);
        }

        return $stat;
    }

    public function create($stat)
    {
        $this->db->from('stats')->insert($stat)->execute();
        return $this->db->insert_id;
    }

    public function populateHourlyStats($hoursAgo = 1)
    {
        $stats = $this->getAll();

        $rangeStart = (int) $hoursAgo + 1;
		$rangeEnd = (int) $hoursAgo - 1;

        foreach ($stats as $stat) {
            $value = $this->getHourlySum($stat['stat_id'], $rangeStart, $rangeEnd, $hoursAgo);
            $this->insertHourlyStat($stat['stat_id'], $hoursAgo, $value);
        }
    }

    public function insertHourlyStat($statId, $hoursAgo, $value)
    {
        $sql = "INSERT INTO
                    stats_hour (stat_id, timestamp, value)
                VALUES
                    ($statId, DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR), '%Y-%m-%d %H:00:00'), $value);";

        $this->db->sql($sql)->execute();
    }

    private function getHourlySum($statId, $rangeStart, $rangeEnd, $hoursAgo)
    {
        $sql = "SELECT
                    COUNT(*) AS hourly_count
                FROM
                    logs
                WHERE
                    stat_id = '$statId'
                AND
                    create_date BETWEEN DATE_SUB(NOW(), INTERVAL $rangeStart HOUR) AND DATE_SUB(NOW(), INTERVAL $rangeEnd HOUR)
			    AND
			        HOUR(create_date) = HOUR(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR))
                GROUP BY
                    HOUR(create_date)";

        $value = $this->db->sql($sql)->one();
        return (empty($value)) ? 0 : $value['hourly_count'];
    }

    public function populateDailyStats($daysAgo = 1)
    {
        $stats = $this->getAll();

        $rangeStart = (int) $daysAgo + 1;
		$rangeEnd = (int) $daysAgo - 1;

        foreach ($stats as $stat) {
            $value = $this->getDailySum($stat['stat_id'], $rangeStart, $rangeEnd, $daysAgo);
            $this->insertDailyStat($stat['stat_id'], $daysAgo, $value);
        }
    }

    public function insertDailyStat($statId, $daysAgo, $value)
    {
        $sql = "INSERT INTO
                    stats_day (stat_id, timestamp, value)
                VALUES
                    ($statId, DATE(DATE_SUB(NOW(), INTERVAL $daysAgo DAY)), $value);";

        $this->db->sql($sql)->execute();
    }

    private function getDailySum($statId, $rangeStart, $rangeEnd, $daysAgo)
    {
        $sql = "SELECT
                    COUNT(*) AS daily_count
                FROM
                    logs
                WHERE
                    stat_id = '$statId'
                AND
                    create_date BETWEEN DATE_SUB(NOW(), INTERVAL $rangeStart DAY) AND DATE_SUB(NOW(), INTERVAL $rangeEnd DAY)
			    AND
			        DAY(create_date) = DAY(DATE_SUB(NOW(), INTERVAL $daysAgo DAY))
                GROUP BY
                    DAY(create_date)";

        $value = $this->db->sql($sql)->one();
        return (empty($value)) ? 0 : $value['daily_count'];
    }
}