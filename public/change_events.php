<?php

include 'includes/header.php';

$changeEventManger = new LeanCharts_ChangeEventManager(LeanCharts::getDb());
$allChangeEvents = $changeEventManger->getAll();

?>

<div class="container">

    <div class="row">

        <div class="eight columns">
            <h3>LeanCharts</h3>
            <p>The individual change events occuring over time.</p>
        </div>

        <hr />
        
    </div>

    <div class="row graph-row">

        <div id="event-list" class="eight columns">

            <h4>List of Events</h4>

            <?php foreach ($allChangeEvents as $event): ?>

            <div class="change-event">
                <span><?php echo $event['date'] ?></span>
                <h5><?php echo $event['title'] ?></h5>
                <p><?php echo $event['description'] ?></p>
            </div>

            <?php endforeach; ?>

        </div>

        <div class="four columns">

            <h4>Add New Event</h4>

            <form action="" method="post">

                <label for="title">Title:</label>
                <input id="title" name="title" type="text" class="input-text" />
                
                <label for="date">Date:</label>
                <input id="date" name="date" type="text" class="input-text" />
                
                <label for="description">Description</label>
                <textarea rows="5" cols="25" name="description" id="description"></textarea>

                <input type="submit" class="small button" />

            </form>

        </div>

    </div><!-- End of a row -->

    <div class="row">
        <hr />
    </div>

</div>

<?php include 'includes/footer.php'; ?>