<?php

// Stat is run only on the daily cron script.

$connection = SonarStatManager::dbConnect();

//helper function to calculate upgrade percentage
function upgradePercent($interval) {

    $res = SonarStatManager::dbQuery("SELECT COUNT(*) FROM user WHERE user.created > DATE_SUB(NOW(), INTERVAL $interval) AND isvalidated=1");
    list($totalValid) = mysql_fetch_row($res);

    $res = SonarStatManager::dbQuery("SELECT COUNT(*) FROM user WHERE user.created > DATE_SUB(NOW(), INTERVAL $interval) AND isvalidated=1 AND paid=1 AND spreedly_token !=''");
    list($totalPaid) = mysql_fetch_row($res);

    return $totalPaid ? ($totalValid / $totalPaid) : 0;    
}


//Percent upgraded after 3 days
$value = upgradePercent('3 DAY');
sonarStatManager::setDailyStatValue('conversion pct 3 days', $value);

//Percent upgraded after 7 days
$value = upgradePercent('7 DAY');
sonarStatManager::setDailyStatValue('conversion pct 7 days', $value);

//Percent upgraded after 14 days
$value = upgradePercent('14 DAY');
sonarStatManager::setDailyStatValue('conversion pct 14 days', $value);

//Percent upgraded after 30 days
$value = upgradePercent('30 DAY');
sonarStatManager::setDailyStatValue('conversion pct 30 days', $value);

//Percent upgraded after 3 months
$value = upgradePercent('3 MONTH');
sonarStatManager::setDailyStatValue('conversion pct 3 month', $value);


?>