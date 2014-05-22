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
<h2>1.00</h2>
<div id='left-nav'>";
include("left-nav.php");

echo "
</div>
<div id='main'>
<p>Vielen Dank für Ihr vertrauen in uns.</p>
<p>Copyright (c) 2014</p>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem 
ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata 
sanctus est Lorem ipsum dolor sit amet.RE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.</p>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
