<?
include realpath(dirname(__FILE__) . '/../init.php');

SonarStatManager::populateStatList(); //add any new stats that appeared in log files in the last hour
echo "Stat list updated from unique log entries.\n";

$stats = SonarStatManager::getStatList();

foreach($stats as $stat) {
		SonarStatManager::populateHourlyStat($stat['event']);
}
echo "Stat values updated.\n";

SonarStatManager::dbDisconnect(); 
?>
