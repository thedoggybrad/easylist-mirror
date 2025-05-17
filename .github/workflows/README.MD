## Code Transparency
As we all know, this project is 100% open-source. This means all the codes must be transparent.
<br>
**Note:** The following codes has all the personal information removed that the public should not see.
### Github Workflow
The code used for the Github Actions workflow and it is the vital file of the entire operations of the syncing process.<br>
[https://github.com/thedoggybrad/easylist-mirror/blob/main/.github/workflows/updater.yml](https://github.com/thedoggybrad/easylist-mirror/blob/main/.github/workflows/updater.yml)

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
