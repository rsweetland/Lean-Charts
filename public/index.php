<? include('../init.php');  

/*

Corresponds with "Dashboard" in the wireframes. 

*/

?><!DOCTYPE html>
<head>


<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type='text/javascript' src='<?= BASE_URL ?>public/js/highcharts.js'></script> 


<style type="text/css">
	.smallbox { width: 1000px; margin: 5px; height: 500px;}
	.smallbox > h4 {font-size: 13px; line-height: 1em; font-weight: bold; padding: 0; margin: 0;}
	.smallbox > ul {font-size: 9px; line-height: 1.5em; list-style: none; padding: 0; margin: 0;}
	.smallbox > p {font-size: 9px; line-height: 1.5em; padding: 0; margin: 0;}
	.smallbox > .alert {font: arial 13px bold;  color: white; background-color: red; padding: 3px;}
	.graph_data { width: 110px; float: left; font-size: 10; margin-top: 100px; text-align: right;}
</style>
</head>
<body>
<h1>Dashboard</h1>
<p>The dashboard shows all of the events your a logging, plotted over time</p>
<p>Users can generate their own custom stats in the 'stats' folder. See this
    <a href="<?= BASE_URL?>public/custom-page.php">Example Page</a></p></p>
<?php 

$stats = SonarStatManager::getStatList();

foreach($stats as $stat):
	$graph = new SonarStat($stat['event']); 
    $hourlyValues = $graph->getStatValues('hourly', 12);
	$weight = $graph->getWeight();
?>

	<div class="smallbox">
        <div style="float: left">
	    <?= $graph->renderGraph('daily', 60, 'medium') ?>
	    </div>

        <div class="graph_data">
    	<p><strong>Past 12 hours: </strong><br />
        	<? foreach($hourlyValues as $date=>$value): ?>
        		<br /><?= date('g a', strtotime($date)) ?>:  <strong><?= $value ?></strong>
        	<? endforeach; ?></p>
            
            <br />
            <p><a href="<?= BASE_URL ?>admin/stats?stat=<?= urlencode($stat['event']) ?>&action=promote">Promote</a> | 
            <a href="<?= BASE_URL ?>admin/stats?stat=<?= urlencode($stat['event']) ?>&action=demote">Demote</a> 
            (Weight: <?= $weight ?>)</p>

        </div>

                
	</div>

<?php 
endforeach;
?>
</body>
</html>