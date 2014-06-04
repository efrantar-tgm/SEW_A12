<?php
/**
 * This is the GUI for displaying event details. (for both 'STANDARD' and 'ONEONE')
 * @author Elias Frantar
 * @version 30.5.2014
 */	
abstract class BaseEventForm {
	const TITLE = "Event | ";

	/**
	 * Returns the info-text for this specific event type.
	 * @return String the info-text for this specific event type
	 */
	protected abstract function getInfoText();
	
	var $event;
	var $user;
	var $role;

	var $disabled = "";
	
	var $options;
	
	/**
     * Displays the GUI.
     */
	public function show() {
		$this->doIncludes();
		$this->openHtml(EventForm::TITLE.$this->event->getName());

		echo "<h2>".$this->event->getName()."</h2>";
	
		$this->displayNote($this->getInfoText());		

		$this->displayBaseTable();

		switch($this->role) {
			case Event::ORGANIZER:
				$this->displayAdminOptions();
				break;
			case Event::PARTICIPANT:
				$this->displayParticipantOptions();
				break;
		}
		
		$this->comments();

		$this->closeHtml();
	}

	/**
	 * Displays the notes for the user at the top.
	 * @param $title the title of the note
	 * @param $text the text of the note
	 */
	private function displayNote($text) {
		echo "<div class='bs-callout bs-callout-info'>$text</div>";
	}

	/**
	 * Displays the admin-options ('FixDate' and 'Settings')
	 */
	private function displayAdminOptions() {
		echo 
		"
		<div>
			<button type='button' class='btn btn-default' onClick='goToSettings()' ".$this->disabled.">
				Settings
				<span class='glyphicon glyphicon-cog'></span>
			</button>
		</div>
		";
	}
	private function displayParticipantOptions() {
		echo
		"
		<div>
			<button type='submit' class='btn btn-default' name='save' $this->disabled>
				Save
				<span class='glyphicon glyphicon-save'></span>
			</button>
		</div>
		";
	}

	/**
	 * Displays the table with the user polls.
	 */
	private function displayBaseTable() {
			echo 
			"
			<p>
				<table class='table' id='table'>
			";

			/* build date-option headers */
			$this->options = DateOptionQuery::create()
				-> filterByEvent($this->event)
				-> orderByDate()
				-> find();
			
			/* set the background of the fixed columns to grey */
			echo "<colgroup>";
			for($i = 0;$i < count($this->options) + 1;$i++) {
				if($i != 0 && $this->options[$i - 1]->getFixed()) {
     				echo "<col style='background: f9f9f9;' />";
				}
				else {
					echo "<col />";
				}
			}
   			echo "</colgroup>";
   					
   			/* build the table head considering the fix options for the admin */
			echo "<thead><th></th>";
			foreach($this->options as $option) {
				echo "<th style='text-align:center'>";
				
				if($this->role == Event::ORGANIZER) {
					echo
					"
					<button type='button' class='btn btn-default' onClick='fixDate(".$option->getId().")'  $this->disabled>"
						.$option->getDate().
					"</button>
					";
				}
				else {
					echo $option->getDate();
				}
				echo "</th>";
			}
			echo "</thead>";

			/* add the users to the table */
			$users = MyUserQuery::create()->findPks(
				InvitationQuery::create()
				-> filterByEvent($this->event)
				-> orderByUsername()
				-> select(array("username"))
				-> find()
				);
			
			echo "<tbody>";
			foreach($users as $user) {
				if(($user->getName() != $this->user->getName() || ($this->event->getFixed() && $this->role == Event::PARTICIPANT)) // only show yourself when the event is fixd
				   && $this->event->getRole($user) != Event::ORGANIZER) { // never show the admin in the table
					
					if($user->getName() == $this->user->getName()) { // display yourself as "You"
						echo "<tr><td><b>You</b></td>";
					}
					else {
						echo "<tr><td>".$user->getName()."</td>";
					}
					
					/* display all pollings from the user */
					foreach($this->options as $option) {
						$glyphicon = "";
						$color = "000000";
						switch($option->getPollStatus($user)) {
							case DateOption::ACCEPT:
								$glyphicon = 'glyphicon-ok';
								$color = '47a446';
								break;
							case DateOption::DECLINE:
								$glyphicon = 'glyphicon-remove';
								$color = 'd2322d';
								break;
							default:
								$glyphicon = 'glyphicon-remove';
								$color = 'transparent';
								break;
						}
						echo "<td align='center'><span class='glyphicon $glyphicon' style='color: $color;'></span></td>";
					}
					echo "<tr>";
				}
			}
			if($this->role == Event::PARTICIPANT && !$this->event->getFixed()) {
				$this->loadPollOptions();
			}
			echo "</tbody>";

			echo 
			"
			</p>
			</table>
			";
	}
	
	/**
	 * Loads the poll options for the specific event type.
	 */
	protected abstract function loadPollOptions();
	
	/**
	 * Opens all HTML-tags.
	 * @param $title the title of the page
	 */
	private function openHtml($title) {
		echo 
		"
		<html>
		<head>
			<title>$title</title>
		</head>
		<body>
			<div class='container'>
				<form action='../userCake/Event.php' method='POST'>
		";
	}
	/**
	 * Closes all HTML-tags.
	 */
	private function closeHtml() {
		echo 
		"
			</form>
			</div>
		</body>
		</html>
		";
	}

	/**
	 * Includes all necessary bootstrap-stylesheets.
	 */
	private function doIncludes() {
		echo 
		"
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<link href='../../style/bs_callouts.css' rel='stylesheet'>
		<script type='text/javascript' src='../forms/jquery_core.js'></script>
		<script type='text/javascript' src='../bootstrap/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='../forms/Event.js'></script>
		";
	}

	/**
	 *Includes all comments
	 */
	private function comments() {
		include 'CommentForm.php';
	}
}
?>
