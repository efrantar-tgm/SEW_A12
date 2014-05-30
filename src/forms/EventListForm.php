<link href="../../style/style.css" rel="stylesheet" type="text/css" />
<?php

/**
 * Lists all events fetched from the database
 *
 * @author jakobsaxinger
 * @version 23-05-2014 (dd:mm:yyyy)
 */
class EventListForm {

	var $my_events;
	var $invited;

	/*
	 * Constructor
	 *
	 * @param event
	 * @param event
	 */
	public function __construct($my_events, $invited) {
		$this->my_events = $my_events;
		$this->invited = $invited;
	}
	
	/*
	 * Shows all fetched Events
	 */
	public function show(){
		echo "			
			<form action='../userCake/EventList.php' method='post'>
    		<input type='submit' name='createEvent' value='New Event'>
			</form>
			";

		echo "<div class='header'> Meine Events 
			</div><br />
			 ";
			 
		for($i = 0; $i < count($this->invited) ; $i++){
			echo '<table width="50%" border="1px" bordercolor="#FFFFFF">
				  	<td class="zelle">
						<a class="event" style="color: #54A34A;" href="../userCake/Event.php?id='.$this->invited[$i]->getId().'">'
							.$this->invited[$i]->getName().'
						</a>
						</td>
						</table>
			
						<hr color="#AAAAAA" width="50%" align="left"/>
				   ';
		}
	
		echo '<br /><hr color="#000000" size="1px"/><br />

	
		<div class="header"> Events an denen ich teilnehme </div>
		<br />
		';

		for($e = 0; $e < count($this->my_events) ; $e++){
			echo '<table width="50%">
				  	<td class="zelle">
						<a class="event" style="color: #584A84;" href="../userCake/Event.php?id='.$this->my_events[$e]->getId().'">'
							.$this->my_events[$e]->getName().'
						</a>
						</td>
						</table>
			
						<hr color="#AAAAAA" width="50%" align="left"/>
					 ';
		}
	}
}
?>
