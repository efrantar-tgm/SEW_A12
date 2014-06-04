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
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<link href='../../style/bs_callouts.css' rel='stylesheet'>
		";

		echo"<div class='container'>";

		echo "
		<div>
		<h3>Meine Events</h3>
		<form action='../userCake/EventList.php' method='post'>
			<button type='submit' name='createEvent' class='btn btn-primary'>New Event</button>
		</form>
		</div>
		<br />";
		for($i = 0; $i < count($this->invited) ; $i++){
			echo '
			<div class="panel panel-info">
			<table class="table">
		  		<td>
				<a href="../userCake/Event.php?id='.$this->invited[$i]->getId().'">'.$this->invited[$i]->getName().'</a>
				</td>
			</table>
			</div>';
		}
	
		echo '
		<br />
		<h3>Events an denen ich teilnehme </h3>
		<br />
		';

		for($e = 0; $e < count($this->my_events) ; $e++){
			echo '
			<div class="panel panel-success">
			<table class="table">
		  		<td>
				<a href="../userCake/Event.php?id='.$this->my_events[$e]->getId().'">'.$this->my_events[$e]->getName().'</a>
			</table>
			</div>';
		}
		echo '</div>';
	}
}
?>
