<link href="../../style/style.css" rel="stylesheet" type="text/css" />
<?php

class EventListForm {

	var $my_events;
	var $invited;

	public function __construct($my_events, $invited) {
		$this->my_events = $my_events;
		$this->invited = $invited;
	}

	public function show(){
	
		echo "<div class='header'> Meine Events </div>
				<br />
			 ";
			 
		for($e = 0; $e < count($this->my_events) ; $e++){
			echo '<table width="50%">
				  	<td class="zelle">
						<div class="event" style="color: #584A84;">'.$this->my_events[$e].'</div>
					</td>
					</table>
			
					<hr color="#AAAAAA" width="50%" align="left"/>
				';
		}
	
		echo '<br /><hr color="#000000" size="1px"/><br />

	
		<div class="header"> Events an denen ich teilnehme </div>
		<br />
		';
	
		for($i = 0; $i < count($this->invited) ; $i++){
			echo '<table width="50%" border="1px" bordercolor="#FFFFFF">
				  	<td class="zelle">
						<div class="event" style="color: #54A34A;">'.$this->invited[$i].'</div>
					</td>
					</table>
			
					<hr color="#AAAAAA" width="50%" align="left"/>
				';
		}
	}
}
?>
