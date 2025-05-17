## Code Transparency
As we all know, this project is 100% open-source. This means all the codes must be transparent.
<br>
**Note:** The following codes has all the personal information removed that the public should not see.

### External Trigger (Every 3 minutes)
The code used by the primary trigger for the Github Workflow.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/main-3min.php](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/main-3min.php)

### Backup Trigger (Every 10 minutes)
The code used by the backup trigger for the Github Workflow.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-10min.php](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-10min.php)

### Backup Trigger (Every 15 minutes)
The code used by the backup trigger for the Github Workflow.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-15min.php](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-15min.php)

### Backup Trigger (Every 1 hour)
The code used by the backup trigger for the Github Workflow.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-1hr.php](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/backup-1hr.php)

### .htaccess File (Security)
Just to prevent unwanted triggers of the workflows.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/security/htaccess.txt](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/security/htaccess.txt)

### .htpasswd File (Security)
Just to prevent unwanted triggers of the workflows.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/security/htpasswd.txt](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/security/htpasswd.txt)

### vercel.json
Used for Vercel to map the PHP file.
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/vercel.json](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/vercel.json)

### api/index.php 
The file used in Vercel to trigger the Github Workflow.
[https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/api/index.php](https://github.com/thedoggybrad/easylist-mirror/blob/main/ct-triggers/api/index.php)

## Syncing Schedule Methods
To prevent this unofficial mirror's possible unreliability, I set up some solutions for it to become more reliable. <br>
1.) PHP script on Vercel via cron-job.org (Main)<br>
A scheduled cron job on cron-job.org that runs every 2 minutes and it runs a PHP script hosted on Vercel. The said script will trigger the Github Action workflow via the Personal Access Token.<br><br>
2.) PHP script on X10 hosting via cron-job.org (Backup)<br>
A scheduled cron job on cron-job.org that runs every 5 minutes and it runs a PHP script hosted on X10 Hosting (x14 server). The said script will check if there is no commit on this repository in the last 5 minutes or so. If there's no commit for that timeframe it probably means that the main solution is down and it will trigger the Github Action workflow via the Personal Access Token.<br><br>
3.) PHP script on X10 hosting via cron-job.org (Backup)<br>
A scheduled cron job on cron-job.org that runs every 10 minutes and it runs a PHP script hosted on X10 Hosting (x11 server). The said script will check if there is no commit on this repository in the last 10 minutes or so. If there's no commit for that timeframe it probably means that the main solution is down and it will trigger the Github Action workflow via the Personal Access Token.<br><br>
4.) PHP script on X10 hosting via Native Cronjob (Backup)<br>
A scheduled cron job on X10 Hosting's native cronjobs that runs every 17 minutes and it runs a PHP script hosted on X10 Hosting (x11 server). The said script will check if there is no commit on this repository in the last 17 minutes or so. If there's no commit for that timeframe it probably means that cron-job.org is down and it will trigger the Github Action workflow via the Personal Access Token.<br><br>
5.) PHP script on X10 hosting via Native Cronjob (Backup)<br>
A scheduled cron job on X10 Hosting's native cronjobs that runs every 30 minutes and it runs a PHP script hosted on X10 Hosting (x14 server). The said script will check if there is no commit on this repository in the last 30 minutes or so. If there's no commit for that timeframe it probably means that cron-job.org is down and it will trigger the Github Action workflow via the Personal Access Token.
