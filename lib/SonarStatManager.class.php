<?php


include realpath(dirname(__FILE__) . '/helpers.php');

/**
 * This class manages and updates sonar stats
 *
 * @author Reilly Sweetland <esweetland@gmail.com>
 * @copyright 2011
 */
class SonarStatManager
{

  	/**
     * database connectoin resource
     *
     * @var mysql resource link
     */
    private static $dbLink = '';


    /**
     * Current Settings
     * @access public
     * @var array
     */
    private static $settings = array();


    /**
     * Gets list of the stats from sonar_stats table
     * @param int limit
     * @return string
     */
    public static function getStatList($limit = 200)
    {
		self::dbConnect();
        $limit = mysql_real_escape_string($limit);
        if ($limit > 200) {
            print 'Too many stats for now! SonarStatManager.class.php limit hit.'; 
            exit;
        }
		$sql = "SELECT event, alert FROM sonar_stats ORDER BY weight DESC LIMIT $limit;";

		if (! $res = mysql_query($sql)) {
			$dbError[] = mysql_error();
			return false;
			exit;
		} 

		while(list($event, $alert) = mysql_fetch_array($res)) {
			$stats[] = array('event' => $event, 'alert' => $alert);
		}
		
        if ($limit > 200) return false;		
		return $stats;
    }



    /**
     * Grabs all unique log values, populates sonar_stats so each can be tracked
     *
     * @return string
     */
    public static function populateStatList()
    {
		self::dbConnect();	
		$sql = "INSERT INTO sonar_stats (event)
				SELECT DISTINCT event from log WHERE log.event NOT IN 
				(
					SELECT sonar_stats.event from sonar_stats
				);";

		if (! $res = mysql_query($sql)) {
			$dbError[] = mysql_error();
			return false;
		} else {
			return true;
		}		
    } 



    /**
     * Processes log files, populating 'hourly' table with summary results from last hour (by default). 
	 * Populating "hoursAgo" processes stats from that particular hour, Ex: 36 means one hour, 36 hours ago
     *
     * @param string event 
     * @param string hoursAgo 
	 * @return bool
     *
     */
    public static function populateHourlyStat($event, $hoursAgo = 1)
	{
        self::dbConnect();
        $event = mysql_real_escape_string($event); 
		$rangeStart = (int) $hoursAgo+1; 
		$rangeEnd = (int) $hoursAgo-1;
	
	    /* calculate latest value */
		$sql = "SELECT COUNT(*) FROM log WHERE event = '" . mysql_real_escape_string($event) . "' 
            AND date BETWEEN DATE_SUB(NOW(), INTERVAL $rangeStart HOUR) AND DATE_SUB(NOW(), INTERVAL $rangeEnd HOUR) 
			AND  HOUR(date) = HOUR(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR)) GROUP BY HOUR(date)";
		
		$res = self::dbQuery($sql);
		
		list($currentVal) = mysql_fetch_array($res);
		$currentVal = ($currentVal) ? $currentVal : 0; //can't be null

//        $change = self::calculateChange($event, $currentVal); 

	    /* insert into stats table */
         $sql ="INSERT INTO sonar_stat_val_hr 
            (date, event, count) VALUES 
            (DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR), '%Y-%m-%d %H:00:00'), ' " . mysql_real_escape_string($event) . "', $currentVal);";

		$res = self::dbQuery($sql);


		/* Process log files and update hourly table. This query brackets the rough time
		span of the target date, then selects only the values where the "hour" number matches up */
//      $sql = <<<EOF
//      INSERT INTO sonar_stat_val_hr 
//      (date, event, count) VALUES 
//      (DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR), '%Y-%m-%d %H:00:00'), '$event',
//          COALESCE((
//          SELECT COUNT(*) FROM log WHERE event = '$event' 
//             AND date BETWEEN DATE_SUB(NOW(), INTERVAL $rangeStart HOUR) AND DATE_SUB(NOW(), INTERVAL $rangeEnd HOUR) 
//          AND  HOUR(date) = HOUR(DATE_SUB(NOW(), INTERVAL $hoursAgo HOUR)) GROUP BY HOUR(date)
//          ), 0)
//      );
// EOF;
//      self::dbQuery($sql); 

//		self::setAlertLevel($event);
		return true; 
	}



    /**
     * Processes log files, populating 'daily' table with summary results from yesterday (by default). 
	 * Populating "daysAgo" processes stats from that particular day, Ex: 3 means one day, 3 days ago
     *
     * @param string event 
     * @param string daysAgo  
	 * @return bool
     *
     */
    public static function populateDailyStat($event, $daysAgo = 1) 
	{
		self::dbConnect();
		
		$rangeStart = (int) $daysAgo+1; 
		$rangeEnd = (int) $daysAgo-1; 
		$event = mysql_real_escape_string($event);
		
		/* Process log files and update the daily table. Works same as above "hourly" stat. */
		$sql = <<<EOF
		INSERT INTO sonar_stat_val_day 
		(date, event, count) VALUES 
		(DATE(DATE_SUB(NOW(), INTERVAL $daysAgo DAY)), '$event',
		    COALESCE((
			SELECT COUNT(*) FROM log WHERE event = '$event' 
            AND date BETWEEN DATE_SUB(NOW(), INTERVAL $rangeStart DAY) AND DATE_SUB(NOW(), INTERVAL $rangeEnd DAY) 
			AND DAY(date) = DAY(DATE_SUB(NOW(), INTERVAL $daysAgo DAY)) GROUP BY DAY(date)
			), 0)
		);
EOF;

        self::dbQuery($sql);
				
		return true; 
	}



    /**
     * Populate the sonar_stat_val_day tables
	 * passing that value to the stat name
     *
     * @param string event
     * @param float value
     * @param string hoursAgo 
	 * @return bool
     *
     */
    public static function setDailyStatValue($event, $val, $daysAgo = 1) 
    {
        self::dbConnect();
        
        $event = mysql_real_escape_string($event);
        
        $sql = <<<EOF
        INSERT INTO sonar_stat_val_day
        (date, event, count) VALUES
        (DATE(DATE_SUB(NOW(), INTERVAL $daysAgo DAY)), '$event', $val);
EOF;
        self::dbQuery($sql); 

        return true;
    }


    /**
     * Adds an external event to external event table to log actions that
     * can be cross-referenced with application metrics.
     *
	 * @return string
     */
    public static function addExternalEvent($title, $date)
    {    
        $title = mysql_real_escape_string($title); 
        $date = mysql_real_escape_string($date);

        date_default_timezone_set('America/Los_Angeles');
        $date = date('Y-m-d H:i:s', strtotime($date));
        $sql = "INSERT INTO sonar_ext_events (event, date)
        VALUES ('" . mysql_real_escape_string($title) . "', '$date')";

        self::dbConnect(); 
        return self::dbQuery($sql);
    }


   /**
     * Gets external events from sonar_ext_events table
     *
	 * @return string
     */
    public function getExternalEvents($start, $end)
    {   

        $start = date('Y-m-d H:i:s', strtotime($start));
        $end = date('Y-m-d H:i:s', strtotime($end));
        
        $sql = "SELECT event, date FROM sonar_ext_events
        WHERE date BETWEEN '$start' AND '$end'";

        SonarStatManager::dbConnect(); 
        $res = SonarStatManager::dbQuery($sql);
        while (list($extEvents[]) = mysql_fetch_array($res)) {
            continue;
        }

        return $extEvents;
    }

    /**
     * sets alert on a given stat
     *
     * @param string event 
	 * @return bool
     * 
     */

	public static function setAlert($event, $value) 
	{	
		// mail('help@followupthen.com', "Graph on the move | $event | Current Val: $value", "The following graph has been marked for alert: $event \n\n The current val is: $value");
        $event = mysql_real_escape_string($event);
		$sql = "UPDATE sonar_stats SET alert = 1 WHERE event = '$event';";
		return (bool) mysql_query($sql);
	} 


	public static function removeAlert($event) 
	{	
        $event = mysql_real_escape_string($event);
		$sql = "UPDATE sonar_stats SET alert = 0 WHERE event = '$event';";
		return (bool) mysql_query($sql);
	}
	
	
    /**
     * Find the peak values for this graph over the last 3 weeks. Alert if exceeds by certain amt.
     *
     * @param string event 
	 * @return false (if max not exceeded), otherwise return the percentage exceeded
     * 
     */

	public static function alertMax($event, $currentVal, $maxLimit = 1.2)
	{

        $sql = "SELECT MAX(count) FROM sonar_stat_val_hr 
        WHERE event LIKE '%" . mysql_real_escape_string($event)  ."%' AND date > DATE_SUB(NOW(), INTERVAL 21 DAY) 
        GROUP BY event;";
        
        $res = self::dbQuery($sql);
        list($max) = mysql_fetch_array($res);

		if((bool) intval($max)) {
			$pctChangeOver = $currentVal / $max; 			
			if($pctChangeOver > $maxLimit) {	   //if pct change was over 20% of the peaks from last 3 weeks
			    return $pctChangeOver; 
		    }
		} 
		
		return false;
    }



    /**
     * Find the lowest values for this graph over the last 3 weeks. Alert if exceeds by certain amt.
     *
     * @param string event 
	 * @return false (if min not exceeded), otherwise return the percentage under
     * 
     */

	public static function alertMin($event, $currentVal, $maxLimit = .8)
    {
        $sql = "SELECT MIN(count) FROM sonar_stat_val_hr 
        WHERE event LIKE '%" . mysql_real_escape_string($event)  ."%' AND date > DATE_SUB(NOW(), INTERVAL 21 DAY)
        GROUP BY event;";
        
        $res = self::dbQuery($sql);
        list($min) = mysql_fetch_array($res);
	
		if((bool) intval($min)) {
			$pctChangeUnder = $currentVal / $min;
			if ($pctChangeUnder < $minLimit) {
			    return $pctChangeUnder;
		    }		
	    }
	    
	    return false;
    }		



    /**
     * Find the percentage change from last week's values at this time.
     *
     * @param string event 
	 * @return percentage by which this entry varies over last week's entry (float). 1 returned it past val was zero.
     * 
     */

	public static function percentChange($event, $currentVal, $interval = 'hourly')
	{
        $event = mysql_real_escape_string($event);        

        switch ($interval) {
            
            case 'hourly': 
            /* Exactly a week ago, find the average value of this stat taking into account 2 hours before and 2 hours after */
            $sql = "SELECT AVG(count) FROM sonar_stat_val_hr WHERE event LIKE '%" . mysql_real_escape_string($event)  ."%' AND date BETWEEN DATE_SUB(NOW(), INTERVAL 170 HOUR) AND DATE_SUB(NOW(), INTERVAL 166 HOUR) GROUP BY event;";
            break;
            
            case 'daily':
            $sql = "SELECT AVG(count) FROM sonar_stat_val_day WHERE event LIKE '%" . mysql_real_escape_string($event)  ."%' AND date BETWEEN DATE_SUB(NOW(), INTERVAL 6 DAY) AND DATE_SUB(NOW(), INTERVAL 8 DAY) GROUP BY event;";
            break;
        }
        
        $res = self::dbQuery($sql); 
        list($pastAverage) = mysql_fetch_array($res); 
        
        if((bool) intval($pastAverage)) {
            $pctChange = abs(($pastAverage-$current) / $pastAverage);
            return $pctChange; 

        } else {
            return 1; //past value was zero..nothing with which to compare.

        }

	}


    /*
     * Run mysql query
     * @param sql string
     *
     */
    public static function dbQuery($sql) {
        self::dbConnect(); 

		if (! $res = mysql_query($sql)) {
			echo "\nMySQL Query Error:\n";
			print_r (mysql_error());
			echo "\nSQL: $sql\n\n";
            exit;
        } else {
            return $res; 
        }
    }
    
    
    
    /*
     * Load mysql
     * @param array $config a configuration array to overload the default settings
     *
     */
    public static function dbConnect() {

		if(self::$dbLink) {
			return true;
		}

    	// establish a DB connection
        self::$dbLink = mysql_connect(DB_HOST, DB_USER, DB_PASS); 
        return mysql_select_db(DB_NAME, self::$dbLink);
	}



    /*
     * Disconnect from mysql
     * 
     *
     */
    public static function dbDisconnect() {
		self::$dbLink = '';
		mysql_close();
		return true;
	}








}


?>