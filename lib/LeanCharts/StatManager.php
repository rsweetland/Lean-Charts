<?php

class LeanCharts_StatManager extends LeanCharts_AbstractManager
{
    public function get($statId)
    {
        $stat = $this->db->from('stats')->where('stat_id', $statId)->one();
        return $stat;
    }

    public function getByName($statName)
    {
        $stat = $this->db->from('stats')->where('name =', $statName)->one();

        if (empty($stat)) {

            $statEntry = array(
                'name' => $statName
            );

            $this->create($statEntry);
            return $this->getByName($statName);
        }

        return $stat;
    }

    public function create($stat)
    {
        $this->db->from('stats')->insert($stat)->execute();
        return $this->db->insert_id;
    }

    public function getAll()
    {
        $events = $this->db->from('stats')->many();
        return $events;
    }

    public function populateHourlyStats($hoursAgo = 1)
    {
        $stats = $this->getAll();

        $rangeStart = (int) $hoursAgo + 1;
		$rangeEnd = (int) $hoursAgo - 1;

        foreach ($stats as $stat) {

            $value = $this->getHourlySum($stat['stat_id'], $rangeStart, $rangeEnd, $hoursAgo);

            $sql = "INSERT INTO
                        stats_hour (stat_id, timestamp, value)
                    VALUES
                        ({$stat['stat_id']}, DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR), '%Y-%m-%d %H:00:00'), $value);";

            $this->db->sql($sql)->execute();

        }
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

            $sql = "INSERT INTO
                        stats_day (stat_id, timestamp, value)
                    VALUES
                        ({$stat['stat_id']}, DATE(DATE_SUB(NOW(), INTERVAL $daysAgo DAY)), $value);";

            $this->db->sql($sql)->execute();

        }
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
                    HOUR(create_date)";

        $value = $this->db->sql($sql)->one();

        return (empty($value)) ? 0 : $value['daily_count'];
    }
}