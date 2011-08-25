<?


$daysAgo = 1; //run from yesterday

//Limit everything here to users that have signed up in the past two weeks.
// for testing: $userCohort = "SELECT uid FROM log WHERE date BETWEEN '2011-05-01' AND '2011-06-11' AND event = 'first time fut use: user record created'";
$userCohort = "SELECT uid FROM log WHERE date > DATE_SUB(NOW(), INTERVAL 14 DAY) AND event = 'first time fut use: user record created'";

// 2 week funnel: step 1 – percent of new users that validate
$countNewUsers = countUsersWithEvent('first time fut use: user record created', 1, $userCohort);
$countValidUsers = countUsersWithEvent('validation completed', 1, $userCohort); 
$value = pct($countValidUsers, $countNewUsers);
sonarStatManager::setDailyStatValue('2 week funnel: step 1 – percent of new users that validate', $value, $daysAgo);

// 2 week funnel: step 2 – percent of valid that schedule one more fut
$countTwoFutUsers = countUsersWithEvent('fut scheduled', 2, $userCohort);
$value =  pct($countTwoFutUsers, $countValidUsers);
sonarStatManager::setDailyStatValue('2 week funnel: step 2 – percent of valid that schedule one more fut', $value, $daysAgo);

// 2 week funnel: step 3 – percent that graduate from 2 futs to 5 futs
$countFiveFutUsers = countUsersWithEvent('fut scheduled', 5, $userCohort);
$value = pct($countFiveFutUsers, $countTwoFutUsers);
sonarStatManager::setDailyStatValue('2 week funnel: step 3 – percent that graduate from 2 futs to 5 futs', $value, $daysAgo);

// 2 week funnel: step 4 – percent that graduate from 5 futs to 10 futs
$countTenFutUsers = countUsersWithEvent('fut scheduled', 10, $userCohort);
$pct = pct($countTenFutUsers, $countFiveFutUsers);
sonarStatManager::setDailyStatValue('2 week funnel: step 4 – percent that graduate from 5 futs to 10 futs', $value, $daysAgo);

// 2 week funnel: step 5 – percent that graduate from 5 futs to 10 futs
$countUpgraded = countUsersWithEvent('upgraded to premium', 1, $userCohort);
$pct = pct($countUpgraded, $countTwoFutUsers);
sonarStatManager::setDailyStatValue('2 week funnel: step 5 – percent of users who upgrade from sending 2 futs', $value, $daysAgo);


/* Sql for testsing this stat: 
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 194; 
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 193;     
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 191;     
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 190;     
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 188;     
    insert into log set event = 'first time fut user: user record created', date = '2011-05-04 14:20:00', uid = 189;     

    insert into log set event = 'validation completed', date = '2011-05-04 14:20:00', uid = 194; 
    insert into log set event = 'validation completed', date = '2011-05-04 14:20:00', uid = 193; 
    insert into log set event = 'validation completed', date = '2011-05-04 14:20:00', uid = 191;    
    insert into log set event = 'validation completed', date = '2011-05-04 14:20:00', uid = 190;      

    (10x)
    insert into log set event = 'fut scheduled', date = '2011-05-04 14:20:00', uid = 194; 

    (5x)
    insert into log set event = 'fut scheduled', date = '2011-05-04 14:20:00', uid = 193; 

    (2x)
    insert into log set event = 'fut scheduled', date = '2011-05-04 14:20:00', uid = 191; 

    (1x)
    insert into log set event = 'fut scheduled', date = '2011-05-04 14:20:00', uid = 190; 
    
    
    insert into log set event = 'upgraded to premium', date = '2011-05-04 14:20:00', uid = 194; 
    
    to view data: 
    SELECT  log.uid, event FROM log 
        INNER JOIN (SELECT uid FROM log WHERE date BETWEEN '2011-03-01' AND '2011-06-11' AND event = 'first time fut use: user record created') 
        AS target_users
     ON target_users.uid = log.uid

*/
?>