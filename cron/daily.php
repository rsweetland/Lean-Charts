<?php

include realpath(dirname(__FILE__) . '/../init.php');

$dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb());
$dailyCron->execute();