<?php
include realpath(dirname(__FILE__) . '/../init.php');

// Specify custom stats to be run. Custom stats must be added to this
// array to be included in the daily run. 

$customStats = array(
    'example.php'
);

foreach ($customStats as $customStat) {
    include_once(APP_ROOT . 'stats/' . $customStat);
}

SonarStatManager::populateStatList(); //add any new stats that appeared in log files that day
echo "\nStat list updated from unique log entries.\n";

$stats = SonarStatManager::getStatList();

foreach($stats as $stat) {
		SonarStatManager::populateDailyStat($stat['event']);
}

echo count($stats) . " stats have been updated with yesterday's values\n";

?>