<?php

include 'index.php';

$myarray = array("event1","event2","event3","event4","event5");
$invited = array("event6","event7","event8","event9","event10");

	$asdf = new events($myarray, $invited);
	$asdf->show();
?>