<?php

/**
 * This class handles an instance of a sonar stat
 *
 * @author Reilly Sweetland <esweetland@gmail.com>
 * @copyright 2011
 */

require_once('SonarStatManager.class.php');

class SonarStat
{

  /**
     * Makes a new instance of a stat
     *
     * @param string $event (required)
     * @return StatManager
     */
    public function __construct($event) 
	{
		if($event){
			$this->setEvent($event);
		}

	}

  	/**
     * event title
     *
     * @var string
     */
    private $event = '';



  	/**
     * weight for sorting
     *
     * @var int
     */
    private $weight = '';



    /**
     * Sets the event title
     *
     * @return string
     */
    public function setEvent($event) 
	{
		$this->event = $event;
        return $this->getEvent();
    }


    /**
     * Gets the event title
     *
	 * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }


   /**
     * Sets the weight of stat
     *
	 * @return string
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        
        $sql = "UPDATE sonar_stats 
        SET weight =" . mysql_real_escape_string($weight) . 
        " WHERE event ='" . mysql_real_escape_string($this->event) . "'";

        SonarStatManager::dbConnect(); 
        return SonarStatManager::dbQuery($sql);
    }


   /**
     * Sets the weight of stat
     *
	 * @return string
     */
    public function getWeight()
    {

        if ($this->weight) {
            return $this->weight;
        } 
        
        $sql = "SELECT weight FROM sonar_stats
        WHERE event = '" . mysql_real_escape_string($this->event) ."'";

        SonarStatManager::dbConnect(); 
        list($weight) = mysql_fetch_array(SonarStatManager::dbQuery($sql));
        $this->weight = $weight;
        
        return $weight;
    }



    /**
     * gets date / value array for count('log event') in that date span. 
     *
     * @param string event 
     * @param int limit
	 * @return array ('date'=>'value');
     * 
     */

    public function getStatValues($interval = 'daily', $limit = '20') 
	{

		$from = ($interval == 'daily') ? 'sonar_stat_val_day' : 'sonar_stat_val_hr';
		
		/* get stats */
		$sql = "SELECT date, count FROM $from
				WHERE event = '" . mysql_real_escape_string($this->event) . 
				"' ORDER BY date DESC 
				LIMIT $limit;";

        SonarStatManager::dbConnect();
        $res = SonarStatManager::dbQuery($sql);
		
		$data = array();
		while (list($date, $value) = mysql_fetch_array($res)) {
			$data[$date] = $value;			
		}
		
		return $data;
	}


    /**
     * Returns an array of dates in Y-m-d format for given range
     *
     * @return array
     */
         
    static function dateRange($startDate, $endDate, $interval) 
    {
    
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        
        $date = $startDate;
        
        while ($date <= $endDate) {
            switch ($interval) {
                case 'daily':
                    $dates[] = date("Y-m-d", $date);
                    $date += 86400;
                    break;
                
                case 'weekly':
                    $dates[] = date("Y-m-d", $date);
                    $shift = "next Sunday";
                    $date = strtotime($shift, $date);
	    		    break;
	    		
	    		case 'monthly':
	    	        $dates[] = date("Y-m-t", $date);
	    		    $shift = "next month";
	    	        $date = strtotime($shift, $date);
	    	        break;
                
                case 'yearly':
                    $dates[] = date("Y", $date);
                    $shift = "next year";
                    $date = strtotime($shift, $date);
                    break;
                default:
                    break;
            }        
        }   
        
        return $dates;
    }
       
    /**
     * Returns graphable array of data accounting for zero-value entries
     * NOTE: Data must be formatted like 'Y-m-d'=> (value)
     * @param data array raw data values
     * @param dateRange array of the whole date range
     * @return array of the two merged in graphable format
     */         
    static function getGraphableData($format = 'highcharts')
    {
        $data = $this->getStatValues();
        $dateRange = $this->dateRange();

        foreach ($dateRange as $date) {
            $mergedStat[$date] = $data[$date] ? $data[$date] : 0;
        }
        
        return $mergedStat;
    }
    


    /**
     * Renders a highcharts graph 
     *
     * @param int $width
     * @param int $height
     * @param int $id
     * @return string
     */
    public function renderGraph($interval = 'daily', $intervals = 30, $size = 'large', $target = null) {

        $id = null; 
        $target = null;

        switch($size) {
            case 'large': 
            $width = 920;
            $height = 400;
            break;

            case 'medium': 
            $width = 700;
            $height = 400;
            break;

            
            case 'small':
            $width = 400;
            $height = 200;
            break;
        }

        $data = $this->getStatValues($interval, $intervals);
        $data = array_reverse($data);

        $start = null;
        
        $dates = array();
        $values = array();
        $targetValues = array();

        foreach ($data as $date => $value) {
            if (!isset($start)) {
                $start = $date;
            }
            //split array for highcharts compatibility
            $dates[] = date('Y-m-d', strtotime($date));
            $values[] = $value;
            $targetValues[] = $target;   //create target graph
        }
        
        $dates = implode(", ", $dates);
        $values = implode(",", $values);
        $targetValues = implode(",", $targetValues);

        $time = strtotime($start);
        $year = date('Y', $time); 
        $month = date('n', $time) - 1;
        $day = date('j', $time);
        $hour = date('G', $time);

        $title = $this->getEvent(); 
        $id = $id ? $id : microtime();
    
    return <<<HTML
            <div class="sonar_graph">
            <h1>{$title}</h1>
    		<script type="text/javascript">
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: '$id',
						defaultSeriesType: 'line',
						marginRight: 130,
						marginBottom: 25
					},
                    title: {
                        text: null
                    },
                    legend: {
                        enabled: false
                    },
					xAxis: {
                        type: 'datetime'
					},
					yAxis: {
						title: {
							text: 'Values'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					series: [{
						name: '$title',
						data: [$values],
						pointStart: Date.UTC({$year}, {$month}, {$day}),
                        pointInterval: 24 * 3600 * 1000 // one day
					}, {
                        type: 'column',
                        name: 'meaningful event', 
                        data: []
					} , {
                        name: 'target', 
                        data: [$targetValues],
					}]
				});
				
				
			});
		</script>	
		<div id="$id" style="width: {$width}px; height: {$height}px; margin: 0 auto"></div>
	</div>

HTML;
    
    
}
    



}

?>