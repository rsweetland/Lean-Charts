<?php

include realpath(dirname(__FILE__) . '/../../../init.php');
$start_time = getmicrotime();

// Specify custom stats to be run. Custom stats must be added to this
// array to be included in the daily run. 

$customStats = array(
    'daily_conversion_pct_after_x_days.php',
    'two_week_funnel.php'
);

foreach ($customStats as $customStat) {
    include_once(APP_ROOT . 'lib/sonar/stats/' . $customStat);
}


SonarStatManager::populateStatList(); //add any new stats that appeared in log files that day
echo "\nStat list updated from unique log entries.\n";

$stats = SonarStatManager::getStatList();

foreach($stats as $stat) {
		SonarStatManager::populateDailyStat($stat['event']);
}

$end_time = getmicrotime();
SimpleLog::trigger('sonar: daily cron script run. execution time:', null, null, $end_time - $start_time);
echo count($stats) . " stats have been updated with yesterday's values\n";


?>