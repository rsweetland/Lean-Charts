<?

/*
TO-DO:
----------------
This is an example of how the system SHOULD work after the new development is done 
to enable the generation of historical information. 

Note: Due to the time and calculation required for generating the historical 
data, this would be run via a cron script, each time taking a selection of 
stats to generate. 

----------------
*/

$historicalStart = "2011-01-01 00:00:00"; //how far to go back? 
$now = nextEntryDate('2 week funnel: step 1 – percent of new users that validate', '$historicalStart', 'hourly');
// Because the next entry date returns the next blank period, we can assume that "now" is that moment when that 
// stat was entered. This simplifies things for complex operations.
// For example, "On this day 3 months ago, what percentage of users were activated within 2 weeks of signing up?")
// See below for how this would be done...

$userCohort = "SELECT uid FROM log WHERE date > DATE_SUB($now['timestamp'], INTERVAL 14 DAY) AND event = 'signed up'";

//How many new users: 
$countNewUsers = countUsersWithEvent('signed up', 1, $userCohort, $now['timestamp']); //how many users had the event 'signed up'
$countFiveUses = countUsersWithEvent('application use', 5, $userCohort, $now['timestamp']); //how many users had the event 'application use' at least 5 times
//Note: The 4th parameter here ("Now") is not yet implemented in the 'countUsersWithEvents' method.
$percent = $countFiveUses / $countUsersWithEvent * 100;
sonarStatManager::setDailyStatValue('2 week new user activation - 5 application uses', $value, $now['periodsAgo']);

?>