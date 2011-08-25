<?

/**  
* Counts the total number users (of a given cohort) who who have hit an event.
* 
*  @param event (which event are we looking for)
*  @param cohort sql query returning the our target users
*  @param instances the minimum number of events for the user to be counted (for example
*  you may want to pull how many users have uploaded a photo at least 5 times.
* 
*   @example $userCohort = "SELECT uid FROM log WHERE date BETWEEN '2011-05-01' AND '2011-06-11' AND event = 'first time fut use: user record created'";
* countUsersWithEvent('first time fut use: user record created', $userCohort)
*  
*   IMPORTANT: NEVER EXPOSE 'cohort' TO END-USER AS IT EXECUTES SQL DIRECTLY WITHOUT ESCAPING
*/

function countUsersWithEvent($event, $minInstances = '', $cohort) {
    
    $event = mysql_real_escape_string($event);
    $minInstances = intval($minInstances);
    
    if($minInstances) {
        $having = "HAVING event_instances >= $minInstances";
    } else {
        $having = '';
    }

    $sql = "SELECT 
    	    log.uid AS users, count(log.uid) AS event_instances
    	    FROM log
    	        INNER JOIN ($cohort) AS target_users
        	ON target_users.uid = log.uid
        	WHERE event = '$event'
        	GROUP BY log.uid
        	$having";  //group by uid to ensure that only unique users returned    	
    $res = SonarStatManager::dbQuery($sql);
    return mysql_num_rows($res);
}



    /**
     * Counts the number of times an event appears in the log file
     * within a given date-range that were triggered by only a certain
	 * user segment.
     *
     * @param string event 
     * @param string start - starting date of (strtotime compatible)
     * @param string end - ending date of
     * @param string userCohortSql - accepts an SQL expression which must
     * return userids. Used as a subquery for the countEvents to limit the
     * events to a given cohort (ie, those that signed up on x month, 
     * those that have seen x advertisement, etc). 
     * 
     * Of note is that the dates of the events can be totally different 
     * from the dates of the cohort query. For example, you may want to find
     * what users that signed up in december of last year logged an event
     * on the site today.
     * 
	 * @return int Count of how many times that event occurred in that cohort
     *
     * Example $userSegment = "SELECT uid FROM log WHERE date BETWEEN '2011-05-01' AND '2011-06-11' AND event = 'first time fut use: user record created'";
     * print SonarStatManager::countCohortEvents('sent: welcome email', '2011-05-01', '2011-06-11', $userSegment); 
     *
     * IMPORTANT: NEVER EXPOSE 'userCohortSql' TO END-USER AS IT EXECUTES SQL DIRECTLY WITHOUT ESCAPING
     * @todo I think this class is broken...
     * 
     */

    function countEvents($event, $userCohortSql = '', $start = '', $end = '') {
        $event = mysql_real_escape_string($event);
        if ($start && $end) {
            $start =  date('Y-m-d', strtotime($start)); 
            $end = date('Y-m-d', strtotime($end));
        }

        $sql = "SELECT
	                COUNT(log.uid) as event_instances
                FROM log
                INNER JOIN
    	            ({$userCohortSql}) AS target_users
    	            ON target_users.uid = log.uid
                WHERE event = '$event'
                GROUP BY log.event;";

        self::dbConnect();
        $res = self::dbQuery($sql);
        list($count) = mysql_fetch_array($res);
        return $count;
    }




function eventFrequency($event, $cohort, $start = '', $end = '') {

}


/* 
* Returns nicely formatted percentage between numbers
*/

function pct($num, $total) {
    return number_format($num / $total * 100, 2);
}




?>