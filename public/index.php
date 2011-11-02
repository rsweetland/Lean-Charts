<?php

include 'includes/header.php';

$statManager = new LeanCharts_StatManager(LeanCharts::getDb());
$stats = $statManager->getAllWeighted();

?>

<div class="container">

    <div class="row">

        <div class="eight columns">
            <h3>LeanCharts Dashboard</h3>
            <p>The dashboard shows all of the events your a logging, plotted over time</p>
        </div>

        <hr />
        
    </div>

    <?php

    $count = 1;

    foreach ($stats as $stat):

        $data = $statManager->getStatValues($stat['stat_id']);
        $graph = new LeanCharts_Graph_Highcharts($stat, $data);

    ?>

    <?php if ($count % 2 == 1): ?>
    <div class="row graph-row">
    <?php endif; ?>

        <div class="six columns">

            <h5><?php echo $stat['name'] ?></h5>
            <?php echo $graph->render(); ?>

        </div>

    <?php if ($count % 2 == 0 && $count != 0): ?>
    </div><!-- End of a row -->
    <?php endif; ?>

    <?php $count++; endforeach; ?>

    <div class="row">
        <hr />
    </div>

</div>

<?php include 'includes/footer.php'; ?>