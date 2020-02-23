<?php

require_once(__DIR__ . '/../vendor/autoload.php');

require_once(__DIR__ . '/database/achievement.php');
require_once(__DIR__ . '/database/activity.php');
require_once(__DIR__ . '/database/auth.php');
require_once(__DIR__ . '/database/codenote.php');
require_once(__DIR__ . '/database/console.php');
require_once(__DIR__ . '/database/forum.php');
require_once(__DIR__ . '/database/friend.php');
require_once(__DIR__ . '/database/game.php');
require_once(__DIR__ . '/database/history.php');
require_once(__DIR__ . '/database/leaderboard.php');
require_once(__DIR__ . '/database/message.php');
require_once(__DIR__ . '/database/news.php');
require_once(__DIR__ . '/database/playlist.php');
require_once(__DIR__ . '/database/rating.php');
require_once(__DIR__ . '/database/release.php');
require_once(__DIR__ . '/database/rom.php');
require_once(__DIR__ . '/database/search.php');
require_once(__DIR__ . '/database/setrequest.php');
require_once(__DIR__ . '/database/static.php');
require_once(__DIR__ . '/database/subscription.php');
require_once(__DIR__ . '/database/ticket.php');
require_once(__DIR__ . '/database/user.php');

require_once(__DIR__ . '/render/achievement.php');
require_once(__DIR__ . '/render/activity.php');
require_once(__DIR__ . '/render/auth.php');
require_once(__DIR__ . '/render/chat.php');
require_once(__DIR__ . '/render/codenote.php');
require_once(__DIR__ . '/render/comment.php');
require_once(__DIR__ . '/render/content.php');
require_once(__DIR__ . '/render/error.php');
require_once(__DIR__ . '/render/facebook.php');
require_once(__DIR__ . '/render/forum.php');
require_once(__DIR__ . '/render/friend.php');
require_once(__DIR__ . '/render/game.php');
require_once(__DIR__ . '/render/google.php');
require_once(__DIR__ . '/render/layout.php');
require_once(__DIR__ . '/render/leaderboard.php');
require_once(__DIR__ . '/render/news.php');
require_once(__DIR__ . '/render/static.php');
require_once(__DIR__ . '/render/subscription.php');
require_once(__DIR__ . '/render/tooltip.php');
require_once(__DIR__ . '/render/twitch.php');
require_once(__DIR__ . '/render/user.php');

require_once(__DIR__ . '/util/api.php');
require_once(__DIR__ . '/util/array.php');
require_once(__DIR__ . '/util/bbcode.php');
require_once(__DIR__ . '/util/bit.php');
require_once(__DIR__ . '/util/cookie.php');
require_once(__DIR__ . '/util/database.php');
require_once(__DIR__ . '/util/date.php');
require_once(__DIR__ . '/util/debug.php');
require_once(__DIR__ . '/util/environment.php');
require_once(__DIR__ . '/util/facebook.php');
require_once(__DIR__ . '/util/image.php');
require_once(__DIR__ . '/util/log.php');
require_once(__DIR__ . '/util/mail.php');
require_once(__DIR__ . '/util/mobilebrowser.php');
require_once(__DIR__ . '/util/permissions.php');
require_once(__DIR__ . '/util/recaptcha.php');
require_once(__DIR__ . '/util/request.php');
require_once(__DIR__ . '/util/string.php');
require_once(__DIR__ . '/util/trigger.php');
require_once(__DIR__ . '/util/upload.php');
require_once(__DIR__ . '/util/utf8.php');

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

define("VERSION", "1.43.0");

try {
    $db = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'), getenv('DB_PORT'));
    if(!$db) {
        throw new Exception('Could not connect to database. Please try again later.');
    }
    mysqli_set_charset($db, 'latin1');
    mysqli_query($db, "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
} catch (Exception $exception) {
    if (getenv('APP_ENV') === 'local') {
        throw $exception;
    } else {
        echo 'Could not connect to database. Please try again later.';
        exit;
    }
}
