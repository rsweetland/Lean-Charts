<?php

include_once './init.php';

function populateLogTable($numberOfEntries, $targetDate, $userId = 1, $event = 'fut scheduled')
{
    for ($i = 1; $i <= $numberOfEntries; $i++) {
        LeanCharts::log($event, $userId, 1, 'user', null, null, $targetDate);
    }
}

$events = array(
    'first time fut use: user record created',
    'fut scheduled',
    'edit: success',
    'sent: fut to sender',
    'validation completed'
);

for ($i = 0; $i < 250; $i++) {

    $day = rand(1,15);
    $targetDate = date("Y-m-d H:i:s", strtotime("-" . $day . " day"));

    $index = rand(0, count($events) - 1);
    $event = $events[$index];

    $userId = rand(1, 100);

    populateLogTable(1, $targetDate, $userId, $event);
}

$statManager = new LeanCharts_StatManager(LeanCharts::getDb());
$dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
$dailyCron->setCustomStatsPath('./stats');

for ($i = 0; $i < 15; $i++) {
    $statManager->populateDailyStats($i + 1);
    $dailyCron->execute($i + 1);
}