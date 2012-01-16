<?php

include 'includes/header.php';

$statManager = new LeanCharts_StatManager(LeanCharts::getDb());
$changeEventManger = new LeanCharts_ChangeEventManager(LeanCharts::getDb());

?>

<div class="container">

    <div class="row">
        <div class="twelve columns">
            <h3>[Sample Custom Stat View]</h3>
            <p>You can easily put together specific graphs to into a custom view 
              such as this. View source to see these examples.</p>
        </div>
        <hr />
    </div>
  </div>

  <div class="row graph-row">
        <div class="twelve columns">
              <div class="row">
                  <div class="six columns">

                        <div class="row graph-row">
                        <?php
                        $stat = $statManager->getByName('first time fut use: user record created');
                        $data = $statManager->getStatValues($stat['stat_id']);
                        $changeEvents = $changeEventManger->getEventsWithinDataRange($data);
                        $graph = new LeanCharts_Graph_Highcharts($stat, $data, $changeEvents);
                        ?>
              
                                  <h5><?php echo $stat['name'] ?></h5>
                                  <?php echo $graph->render(); ?>
                          </div>

                        <div class="row graph-row">
                          <?php
                              $stat = $statManager->getByName('validation completed');
                              $data = $statManager->getStatValues($stat['stat_id']);
                              $changeEvents = $changeEventManger->getEventsWithinDataRange($data);
                              $graph = new LeanCharts_Graph_Highcharts($stat, $data, $changeEvents);
                          ?>
                                  <h5><?php echo $stat['name'] ?></h5>
                                  <?php echo $graph->render(); ?>
                          </div>

                        <div class="row graph-row">
                          <?php
                              $stat = $statManager->getByName('2 week funnel: step 1 - percent of new users that validate');
                              $data = $statManager->getStatValues($stat['stat_id']);
                              $changeEvents = $changeEventManger->getEventsWithinDataRange($data);
                              $graph = new LeanCharts_Graph_Highcharts($stat, $data, $changeEvents);
                          ?>
                                  <h5><?php echo $stat['name'] ?></h5>
                                  <?php echo $graph->render(); ?>
                          </div>
                    </div>
                    
                    <div class="four columns">
                      <h4>About this page</h4>
                      <p>This page is a custom-stat page. It is just an HTML page with 
                        helper methods for showing graphs. Nothing more, nothing less.
                        Create a custom page to show the results of a specific data
                        experiment, the effectiveness of a new feature, to keep an 
                        audit-trail on major changes, to make custom dashboards for 
                        specific purposes and for just data exploration fun</p>
                    </div>
              </div>
            </div>
      </div>
</div>

<?php include 'includes/footer.php'; ?>