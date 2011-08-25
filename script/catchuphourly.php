<?
include realpath(dirname(__FILE__) . '/../../../init.php');

$stats = SonarStatManager::getStatList();

$hoursAgo = (int) $argv[1];

foreach($stats as $stat) {
  SonarStatManager::populateHourlyStat($stat['event'], $hoursAgo);
}

echo count($stats) . " stats have been populated with data from $hoursAgo hours ago\n\n";

?>