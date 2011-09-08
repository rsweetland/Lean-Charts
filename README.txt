------------------------------
    Lean Charts / Sonar
------------------------------

...yes, there are two names. It was first called Sonar (and referenced 
throughout the code as Sonar) Warning: the name could change again : ) 

------------------------------
        To Install 
------------------------------

1. Set up a database
2. Copy config-dist.php to config.php, modify settings accordingly.
3. Import sample data if you want (tests/sample-data.sql)
4. Or just start logging events in your application.
5. Set up a cron tab to run cron/hour.php every hour and day.php daily
Or just run them from the command line to view additional output.

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
over time.

3. Alerts (TO-DO)
If a certain log event starts going haywire (ie, too many events / too few events), 
you will receive an alert via email. These two methods need to be finished: 
alertMax() and alertMin() in lib/SonarStatManager.class.php.

3. Custom Stats
Custom metrics are placed into this folder. These are automatically added to 
the dashboard. For Example: "Track the number of times a premium user who has
used the app at least 3 times triggers the 'referral' event."

4. Historical values for custom stats (TO-DO)
To do this, a helper function needed to simulate being in a certain moment in time. 
(Meta code for this exists as the method nextEntryDate() in 
lib/SonarStatManager.class.php ). When programming the custom stat, the creator
would use the output from that function to calculate historical values for that
stat. Through periodic runs of this custom stat, the historical data will 
eventually be populated by continuing to find the 'nextEntryDate' and populating
that until it reaches present time. Note: See 'script/catchupdaily.php' and 
'script/catchuphourly.php' files do a similar version of this.
See 'stats/example-historical-data.php' to see an example.

5. Change-Log (TO-DO)
See wireframe diagram. This consists of a simple form to add change-log events 
(ie, enhancements you make to the application) which are then plotted on the 
line graphs so you can view how changes affected your metrics.



------------------------------
        Copyright
------------------------------

Until an open source license is selected, all work contained herein is
copyrighted material and cannot be reproduced without owner's explicit 
consent. Email esweetland@gmail.com if you want to reproduce / etc.