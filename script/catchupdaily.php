<?
include realpath(dirname(__FILE__) . '/../../../init.php');

$stats = SonarStatManager::getStatList();

$daysAgo = (int) $argv[1];

foreach($stats as $stat) {
  SonarStatManager::populateDailyStat($stat['event'], $daysAgo);
}

echo count($stats) . " stats have been populated with data from the day that was $daysAgo days ago\n\n";

?>