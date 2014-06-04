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
	public function __construct($event, $user) {
		$this->event = $event;
		$this->user = $user;
		$this->role = $this->event->getRole($this->user);
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

		switch($this->role) {
			case Event::ORGANIZER:
				$this->displayAdminOptions();
				break;
			case Event::PARTICIPANT:
				$this->displayParticipantOptions();
				break;
		}

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
		$disabled = "";
		if($this->event->getFixed()) {
			$disabled = "disabled";
		}
		echo 
		"
		<div>
			<button type='button' class='btn btn-default' onClick='goToSettings()' $disabled>
				Settings
				<span class='glyphicon glyphicon-cog'></span>
			</button>
		</div>
		";
	}
	private function displayParticipantOptions() {
		$disabled = "";
		if($this->event->getFixed()) {
			$disabled = "disabled";
		}
		echo
		"
		<div>
			<button type='submit' class='btn btn-default' name='save' $disabled>
				Save
				<span class='glyphicon glyphicon-save'></span>
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
				<table class='table' id='table'>
			";

			/* build date-option headers */
			$options = DateOptionQuery::create()
				-> filterByEvent($this->event)
				-> orderByDate()
				-> find();
			
			echo "<colgroup>";
			for($i = 0;$i < count($options) + 1;$i++) {
				if($i != 0 && $options[$i - 1]->getFixed()) {
     				echo "<col style='background: f9f9f9;' />";
				}
				else {
					echo "<col />";
				}
			}
   			echo "</colgroup>";
   					
			echo "<thead><th></th>";
			foreach($options as $option) {
				echo "<th style='text-align:center'>";
				
				if($this->role == Event::ORGANIZER) {
					$disabled = "";
					if($this->event->getFixed()) {
						$disabled = "disabled";
					}

					echo
					"
					<button type='button' class='btn btn-default' $disabled onClick='fixDate(".$option->getId().")'>"
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
			$usernames = InvitationQuery::create()
				-> filterByEvent($this->event)
				-> orderByUsername()
				-> select(array('username'))
				-> find();

			echo "<tbody>";
			foreach($usernames as $username) {
				if(($username != $this->user->getName() || ($this->event->getFixed() && $this->role == Event::PARTICIPANT)) 
				   && $this->event->getRole(MyUser::findByName($username)) != Event::ORGANIZER) { // do not show yourself in the table
					
					if($username == $this->user->getName()) {
						echo "<tr><td><b>You</b></td>";
					}
					else {
						echo "<tr><td>$username</td>";
					}
					
					foreach($options as $option) {
						if($option instanceof StandardOption) {
							$choices = $option->getChoices();
							
							if(!is_null($choices) && key_exists($username, $choices)) {
								if($choices[$username]) {
									$glyphicon = 'glyphicon-ok';
									$color = '47a446';
								}
								else {
									$glyphicon = 'glyphicon-remove';
									$color = 'd2322d';
								}
								echo "<td align='center'><span class='glyphicon $glyphicon' style='color: $color;'></span></td>";
							}
							else {
								echo "<td></td>";
									
							}
						}
					}
					echo "<tr>";
				}
			}
			if($this->role == Event::PARTICIPANT && !$this->event->getFixed()) {
				echo "<td><b>You</b></td>";
				if($this->event instanceof StandardEvent) {
					for($i = 0;$i < count($options);$i++) {
						
						$choices = $options[$i]->getChoices();
						if(!is_null($choices) && key_exists($this->user->getName(), $choices)) {
							if($choices[$this->user->getName()]) {
								$pressed_button = "pollOk";
							}
							else {
								$pressed_button = "pollDecline";
							}
						}
						else { $pressed_button = "pollNone"; }
						
						echo
						"
						<td align='center'>
							<div class='btn-group' data-toggle='buttons'>
							    <label class='btn btn-default' id='pollOk$i'>
							    	<input type='radio' name='poll$i' value='OK'>
									<span class='glyphicon glyphicon-ok' style='color: 47a446;'></span>	
								</label>
								<label class='btn btn-default' id='pollDecline$i'>
							    	<input type='radio' name='poll$i' value='DECLINE'>
									<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>	
								</label>
							</div>
						</td>
						<script type='text/javascript'>
							$('#$pressed_button".$i."').addClass('active');
						</script>
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
							    <input type='radio' name='poll$i' value='OK' onClick='handle>
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
	private function loadBootstrap() {
		echo 
		"
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<link href='../../style/bs_callouts.css' rel='stylesheet'>
		<script type='text/javascript' src='../forms/jquery_core.js'></script>
		<script type='text/javascript' src='../bootstrap/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='../forms/Event.js'></script>
		";
	}	
}
?>
