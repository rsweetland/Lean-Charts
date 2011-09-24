<?php

include realpath(dirname(__FILE__) . '/../init.php');

$dailyCron = new LeanCharts_Cron_Hourly(LeanCharts::getDb());
$dailyCron->execute();