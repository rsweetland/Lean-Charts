------------------------------
    Lean Charts / Sonar
------------------------------

Lean Charts is a light weight, open source event-based analytics framework
allowing developers to create highly customized metrics that analyze the 
relative success of web applications. Monitor the effects of your changes
on key metrics. Segment metrics by cohort.

...and yes, there are two names. It was first called Sonar (and referenced 
throughout the code as Sonar) Warning: the name could change again : ) 

------------------------------
        To Install 
------------------------------

1. Set up a database. Import data from tests/sample-data.sql if you want test data
2. Copy config-dist.php to config.php, modify settings accordingly.
4. Start logging events in your application by requiring the appropriate 
   classes (SimpleLog.class.php and SimpleLog_Receiveer.class.php) and 
   using the trigger SimpleLog::trigger('sale').
5. Set up a cron tab to run cron/hour.php every hour and day.php daily to 
   generate stat values (or run directly from the command line).

------------------------------
        How It Works
------------------------------

1. Logging
There is a simple logging class included. It all starts by logging events
throughout your application. Pass the userid associated with the event and 
"object id" (ex, what item they were working on when it happened, if any).

2. Automatic Dashboard
Automagically, a dashboard is populated. There is a stat for each unique
event that was logged. The graphs simply show the frequency of the event
over time. Behind the scenes, the application is doing this: 
    a. Queries log file to find unique events (populates the `sonar_stats` table)
    b. Counts the number of occurrences of a particular event over that period
    c. Populates value into the sonar_stat_val_hr or sonar_stat_val_day table

3. Alerts (TO-DO)
If a certain log event starts going haywire (ie, too many events / too few events), 
you will receive an alert via email. These two methods need to be finished: 
alertMax() and alertMin() in lib/SonarStatManager.class.php.

4. Custom Stats
Custom metrics are placed into this folder. These are automatically added to 
the dashboard. For Example: "Track the number of times a premium user who has
used the app at least 3 times triggers the 'referral' event."

5. Historical values for custom stats (TO-DO)
To do this, a helper function needed to simulate being in a certain moment in time. 
(Meta code for this exists as the method nextEntryDate() in 
lib/SonarStatManager.class.php ). When programming the custom stat, the creator
would use the output from that function to calculate historical values for that
stat. Through periodic runs of this custom stat, the historical data will 
eventually be populated by continuing to find the 'nextEntryDate' and populating
that until it reaches present time. Note: See 'script/catchupdaily.php' and 
'script/catchuphourly.php' files do a similar version of this.
See 'stats/example-historical-data.php' to see an example.

6. Change-Log (TO-DO)
See wireframe diagram. This consists of a simple form to add change-log events 
(ie, enhancements you make to the application) which are then plotted on the 
line graphs so you can view how changes affected your metrics.



------------------------------
        Copyright
------------------------------

Until an open source license is selected, all work contained herein is
copyrighted material and cannot be reproduced without owner's explicit 
consent. Email esweetland@gmail.com if you want to reproduce / etc.