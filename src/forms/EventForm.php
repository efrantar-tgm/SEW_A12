<?php
/**
 * This is the GUI for displaying event details. (for both 'STANDARD' and 'ONEONE')
 * @author Elias Frantar
 * @version 30.5.2014
 */	
class EventForm {
	const TITLE = "Event | ";

	const STANDARD_TEXT = "This is a Standard-Event. Please mark if you have or haven't got time for all date-options.";
	const ONEONE_TEXT = "This is a OneOne-Event, so only on person per date. So pick the free one, which suits best for you.";

	var $event;
	var $user;
	var $role;

	var $submit;

	/**
     * Creates the new form for the given event and user, which submits to the given php-file.
     * @param Event the event to display info from
     * @param MyUser the user visiting this page
     * @param String the full path to the php-file to call on submit
     */
	public function __construct($event, $user, $submit) {
		$this->event = $event;
		$this->user = $user;
		$this->role = $this->event->getRole($this->user);

		$this->submit = $submit;
	}
	
	/**
     * Displays the GUI.
     */
	public function show() {
		$this->loadBootstrap();

		$this->openHtml(EventForm::TITLE.$this->event->getName());

		echo "<h2>".$this->event->getName()."</h2>";
	
		if($this->event instanceof StandardEvent) {
			$title = 'StandardEvent';		
			$text = EventForm::STANDARD_TEXT;
		}
		if($this->event instanceof OneOneEvent) {
			$title = 'OneOneEvent';
			$text = EventForm::ONEONE_TEXT;
		}
		$this->displayNote($title, $text);		

		$this->displayTable();

		if($this->role == Event::ORGANIZER) {
			$this->displayAdminOptions();
		}

		$this->displayBackButton();

		$this->closeHtml();
	}

	/**
	 * Displays the notes for the user at the top.
	 * @param $title the title of the note
	 * @param $text the text of the note
	 */
	private function displayNote($title, $text) {
		echo 
		"
		<div class='bs-callout bs-callout-info'>
			<h4 style='color: #5bc0de;'>$title</h4>
			$text
		</div>
		";
	}

	/**
	 * Displays the admin-options ('FixDate' and 'Settings')
	 */
	private function displayAdminOptions() {
		echo 
		"
		<div>
			<button type='submit' class='btn btn-primary' name='foxDate'>
				Fix Date
				<span class='glyphicon glyphicon-lock'></span>
			</button>
			<button type='submit' class='btn btn-default' name='editEvent'>
				Settings
				<span class='glyphicon glyphicon-cog'></span>
			</button>
		</div>
		";
	}

	/**
	 * Displays the table with the user polls.
	 */
	private function displayTable() {
			echo 
			"
			<p>
				<table class='table'>
			";

			/* build date-option headers */
			$options = DateOptionQuery::create()
				-> filterByEvent($this->event)
				-> orderByDate()
				-> find();
			
			echo "<thead><th></th>";
			foreach($options as $option)
				echo "<th style='text-align:center'>".$option->getDate()."</th>";
			echo "</thead>";

			/* add the users to the table */
			$usernames = InvitationQuery::create()
				-> filterByEvent($this->event)
				-> orderByUsername()
				-> select(array('username'))
				-> find();

			echo "<tbody>";
			foreach($usernames as $username) {
				if($username != $this->user->getName()) { // do not show yourself in the table
					echo "<tr><td>$username</td>";
					
					for($i = 0;$i < count($options);$i++) {// just dummy-fill the table at the moment
						if(rand(0, 1)) {		
							$glyphicon = 'glyphicon-ok';
							$color = '47a446';				
						}
						else {
							$glyphicon = 'glyphicon-remove';
							$color = 'd2322d';		
						}
						echo "<td align='center'><span class='glyphicon $glyphicon' style='color: $color;'></span></td>";
					}
					echo "<tr>";
				}
			}
			if($this->role == Event::PARTICIPANT) {
				echo "<td><b>You</b></td>";
				if($this->event instanceof StandardEvent) {
					for($i = 0;$i < count($options);$i++) {
						echo
						"
						<td align='center'>
							<div class='btn-group' data-toggle='buttons'>
							  <label class='btn btn-default'>
							    <input type='radio' name='poll$i' value='NONE'>
							    <span class='glyphicon glyphicon-minus' style='color: transparent;'></span>	
							  </label>
							  <label class='btn btn-default'>
							    <input type='radio'  name='poll$i' value='OK'>
								<span class='glyphicon glyphicon-ok' style='color: 47a446;'></span>	
							  </label>
							  <label class='btn btn-default'>
							    <input type='radio' name='poll$i' value='DECLINE'>
								<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>	
							  </label>
							</div>
						</td>
						";
					}
				}
				if($this->event instanceof OneOneEvent) {
					for($i = 0;$i < count($options);$i++) {
						echo
						"
						<td align='center'>
							<div class='btn-group' data-toggle='buttons'>
							  <label class='btn btn-default'>
							    <input type='radio' name='poll$i' value='OK'>
								<span class='glyphicon glyphicon-ok' style='color: 47a446;'></span>	
							  </label>
							</div>
						</td>
						";
					}
					echo "</div>";
				}
			}
			echo "</tbody>";

			echo 
			"
			</p>
			</table>
			";
	}

	/**
	 * Displays the 'Back'-button at the end of the page.
	 */
	private function displayBackButton() {
		echo
		"
		<br><br>
		<div class='form-group'>
			<button class='btn btn-primary btn-block btn-lg' type='submit' name='back'>
				Back
			</button>
		</div>
		";
	}
	
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
				<form action='$this->submit' method='post'>
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
	private function loadBootstrap() {
		echo 
		"
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<link href='../../style/bs_callouts.css' rel='stylesheet'>
		<script type='text/javascript' src='../forms/jquery_core.js'></script>
		<script type='text/javascript' src='../bootstrap/js/bootstrap.min.js'></script>
		";
	}	
}
?>
