<?

/* 

This is an example of a custom stat. The "user interface" for
creating a custom stat is this directory. 

In order to create a new custom-calculated stat: 

1. Add a file as shown in this example below
2. Reference it in the "script/cron/hourly.php"  and/or 
"script/cron/daily.php"  to get called hourly or daily cron runs. 
It could be called in one or the other or both – some stats
you don't need hour-by-hour updates on, some you do.

There is a specific syntax for adding the stat value, and some helper methods
to make it easier to calculate stats. Other than that, this is 
free-form stat calculation. Pull from 3rd party data sources, other databases, 
whever your statistical imagination will take you.

See below for a simple calculated stat...
*/


$daysAgo = 1; //run from yesterday


/*
USER COHORT
A user cohort can optionally be stated. Very handy for tracking behavior
of a specific user type. Here, we are limiting to those that signed up within 
a certain date range.  This is then used in the helper method below.
*/
$userCohort = "SELECT uid FROM log WHERE date BETWEEN '2011-05-01' AND '2011-06-11' AND event = 'first time fut use: user record created'";

/* 
CALCULATE
Let's say we want to know what percentage new users actually validate their
account out of those that signed up in this date range. 

The 'countUsersWithEvent' heper method will give us the number of users that
have that logged that event (limited to only the users in our cohort)
*/ 
$countNewUsers = countUsersWithEvent('first time fut use: user record created', 1, $userCohort);
$countValidUsers = countUsersWithEvent('validation completed', 1, $userCohort); 
$percentage = $countValidUsers  / $countNewUsers * 100;

/* Add the daily value */
sonarStatManager::setDailyStatValue('2 week funnel: step 1 – percent of new users that validate', $percentage, $daysAgo);


?>