<?php

/* 
    This file is called by the daily and hourly cron scripts to 
    populate the values for this calculated graph.

*/

/* Revenue graph daily */
$transactions = Spreedly::get_transactions(); 
$tranStats = array();
foreach ($transactions as $transaction) {
	$date = date('Y-m-d', $transaction->created_at);
	if ($tranStats[$date]) {
		$tranStats[$date] += $transaction->amount; 

	} else {
		$tranStats[$date] = $transaction->amount; 
	}
}

$data['revenue'] = SonarGraph::mergeStatsWithDates($tranStats, $dateRange);
/* End Revenue graph */





?>