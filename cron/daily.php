<?php

include realpath(dirname(__FILE__) . '/../init.php');

$dailyCron = new LeanCharts_Cron_Daily(LeanCharts::getDb()); 
/* 
Comment:
It seems we are passing the db sparrow object almost every time a class
is instantiated. Can we not abstract this into the class itself? What would
be the disadvantage of just instaiatin the db object in the consturctor?
*/
$dailyCron->setCustomStatsPath(dirname(__FILE__) . '/../stats');
/* 
Comment:
Let's not allow them to set a custom path for simplicity.
One less line. Convention over configuration.
*/

$dailyCron->execute();