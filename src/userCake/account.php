<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='content'>
<h1>Das Große Ganze</h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");

echo "
</div>
<div id='main'>
Hey, $loggedInUser->displayname. Das ist eine Beispielsseite. Dein Titel ist zurzeit: $loggedInUser->title.
Der Titel kann im Admin Panel geändert werden. 
Sie haben sich am " . date("M d, Y", $loggedInUser->signupTimeStamp()) . " registriert.
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
