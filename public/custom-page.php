<?php  include('../init.php');  

/*
    This is an example of a custom stats page that a user could create. 
*/

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Graphs</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?= BASE_URL ?>public/js/highcharts.js'></script>    
</head>
<body>

<h1>Custom Stats View Page</h1>
<p>A user can easily make custom stat viewing pages using the helper methods
    provided, custom stats (created in the 'stats' folder) and good ol' HTML</p>

<div style="width: 500px; align: center">
<?php

    //examples of how to manually render graphs

    $days = (int) (array_key_exists('days', $_GET)) ? $_GET['days'] : 60;
    $interval = 'daily';
    
    $futSched = new SonarStat('fut scheduled');
    print $futSched->renderGraph($interval, $days);

    $futs = new SonarStat('sent: fut to sender');
    print $futs->renderGraph($interval, $days);

    $futs = new SonarStat('validation completed');
    print $futs->renderGraph($interval, $days);

?>
</div>


</body>
</html>