# instaPhpProxy
This small program helps you to display your instagramm feed. It caches your feed in JSON format, so you do not make too much request to graph.instagram.com, it helps your site to hide your insta access token from visitors, and it has a tool for refreshing your long-lived insta access token. (which expires in 60 days).
## Install
Clone this repository to a server, run `composer update` to install dependencies, and create an `.env` file based on the `.env.example`.
## Env file
`INSTA_ACCES_TOKEN`: Your long-lived access token. More details [here](https://developers.facebook.com/docs/instagram-basic-display-api/guides/long-lived-access-tokens#get-a-long-lived-token).
`INSTA_USER_ID`: The user id of the insta account, you want to display.
`ALLOW_ORIGIN`: Your Frontend what will display these posts. If you don't mind, write in a `*`.
## Refresh your token
To refresh your token visit the refresh.php file from a browser, or set a CRON job to do so for you regularly (I set it to weekly). A free cron job service: https://cron-job.org.

## Other
You can find some more information in the code as comments.


Any feedback or contribution is appreciated.
