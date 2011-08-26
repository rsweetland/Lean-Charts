<?
include realpath(dirname(__FILE__) . '/../../../init.php');
$start_time = getmicrotime();

SonarStatManager::populateStatList(); //add any new stats that appeared in log files in the last hour
echo "Stat list updated from unique log entries.\n";

$stats = SonarStatManager::getStatList();

foreach($stats as $stat) {
		SonarStatManager::populateHourlyStat($stat['event']);
}

// alert if followups are not being sent.
$tzSql = "SET time_zone='+0:00'";
SonarStatManager::dbQuery($tzSql);

$sql = "SELECT COUNT(*) FROM task WHERE iscompleted=0 AND isvalidated=1 AND isspam!=1 AND invalidformat!=1 AND due < DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
$res = SonarStatManager::dbQuery($sql);
list($count) = mysql_fetch_array($res);

if($count >= 1) {
   if (mail('help@followupthen.com', "Alert: $count past-due tasks are stuck!", "Query was: $sql") ) {
       echo "Email alert sent to administrators for duplicate followups!";
   };
}
SonarStatManager::dbDisconnect(); //closing the connection forces a re-connection, thereby restoring default timezone
// end alert

SonarStatManager::dbConnect();
list($now) = mysql_fetch_array(SonarStatManager::dbQuery("select now()"));
echo "\nNOW: " . $now . "\n";

$end_time = getmicrotime();
SimpleLog::trigger('sonar: cron script run. execution time: ', null, null, $end_time - $start_time);
echo count($stats) . " stats have been updated with the last hour's values\n";

?>
