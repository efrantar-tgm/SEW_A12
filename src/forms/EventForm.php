<?php
/**
 * This is the GUI for creating events.
 * @author Elias Frantar
 * @version 27.5.2014
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
   * Creates the new form, which submits to the given php-file.
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

		$this->closeHtml();
	}

	private function displayNote($title, $text) {
		echo 
		"
		<div class='bs-callout bs-callout-info'>
			<h4 style='color: #5bc0de;'>$title</h4>
			$text
		</div>
		";
	}

	private function displayAdminOptions() {
		echo 
		"
		<div>
			<button type='submit' class='btn btn-primary' name='foxDate'>
				Fix Date
				<span class='glyphicon glyphicon-lock'></span>
			</button>
			<button type='submit' class='btn btn-default' name='inviteUsers'>
				Invite Users
			</button>
			<button type='submit' class='btn btn-danger'	name='deleteEvent'>
				Delete
				<span class='glyphicon glyphicon-trash'></span>
			</button>
		</div>
		";
	}

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
				-> select(array('date'))
				-> find();
			
			echo "<thead><th></th>";
			if($this->role == Event::ORGANIZER) {
				echo 
				"
				<th style='text-align:center; vertical-align:middle'>
					<button type='submit' class='btn btn-default' name='manageDates'>
						<span class='glyphicon glyphicon-edit'></span>
					</button>
				</th>
				";			
			}
			foreach($options as $option)
				echo "<th style='text-align:center'>$option</th>";
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
					echo "<tr>";							
					if($this->role == Event::ORGANIZER) {
							echo 
							"
							<td>
								<button type='submit' class='btn btn-default'	name='deleteUser' value='".$this->user->getName()."'>
									<span class='glyphicon glyphicon-trash'></span>
								</button>
							</td>
							";
						}				
	
					echo "<td>$username</td>";
					
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
			if($this->role == Event::ORGANIZER) {
				echo 
				"
				<td></td>
				<td style='text-align:center; vertical-align:middle'>
					<button type='submit' class='btn btn-default'	name='deleteEvent'>
						<span class='glyphicon glyphicon-plus'></span>
					</button>
				</td>
				";
				for($i = 0;$i < count($options) + 1;$i++)
					echo "<td></td>";
			}
			echo "</tbody>";

			echo 
			"
			</p>
			</table>
			";
	}
	
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
	private function closeHtml() {
		echo 
		"
			</form>
			</div>
		</body>
		</html>
		";
	}

	private function loadBootstrap() {
		echo 
		"
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<link href='../../style/bs_callouts.css' rel='stylesheet'>";
	}	
}
?>
