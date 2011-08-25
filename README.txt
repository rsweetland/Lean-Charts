

------------------------------
    Lean Charts / Sonar
------------------------------

...yes, there are two names. It was first called Sonar (and referenced 
throughout the code as Sonar) Warning: the name could change again : ) 


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

3. Alerts (TO-DO. Half-done currently)
If a certain log event starts going haywire (ie, too many events / too few events), 
you will receive an alert.

3. Custom Stats
Powerful options lie in the "stats" folder...or * will * lie in there when
you build them. Custom metrics are placed into this folder. 
These will then be automatically added to this dashboard. Example: Track
"the number of times a premium user who has used the app at least 3 times 
triggers the 'referral' event."

4. Change-Log (TO-DO)
As you make changes to your software, note them in the change-log. These changes
will show on every graph so that you can see how your change affected your 
metrics.

5. Calculation of past values (TO-DO)
Enter custom stats by accepting a "start" and "end" parameter, and the application
will automatically generate historical data from your calculations. (Note:
all queries should access data from the log table for this to be most likely 
to work..but hey, you can try anything). The "script/catchupdaily.php" and 
"script/catchuphourly.php" files do a similar version of this.


------------------------------
        Copyright
------------------------------

Until an open source license is selected, all work contained herein is
copyrighted material and cannot be reproduced without owner's explicit 
consent. Email esweetland@gmail.com if you want to reproduce / etc.