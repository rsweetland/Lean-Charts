<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Graphs</title>

<script type='text/javascript' src='<?= BASE_URL ?> . js/highcharts.js'></script>    

<style type="text/css" media="screen">
    .user_list td {
        padding: 10px;
    }
</style>

</head>



<?php

    $days = (int) (array_key_exists('days', $_GET)) ? $_GET['days'] : 60;
    $interval = 'daily';
    
    $upgrades = new SonarStat('upgraded to premium');
    print $upgrades->renderGraph($interval, $days);

    $futSched = new SonarStat('fut scheduled');
    print $futSched->renderGraph($interval, $days);

    $futs = new SonarStat('sent: fut to sender');
    print $futs->renderGraph($interval, $days);

    $futs = new SonarStat('validation completed');
    print $futs->renderGraph($interval, $days);

?>