<?php
/**
 * This is the GUI for displaying event settings.
 * @author Elias Frantar
 * @version 30.5.2014
 */
class EventSettingsForm {
	const TITLE = "Event Settings | ";
	const DATE_FORMAT = 'Y-m-d H:i';

	var $event;
	var $user;

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

		$this->submit = $submit;
	}
	
	/**
     * Displays the GUI.
     */
	public function show() {
		$this->loadBootstrap();
		$this->openHtml(EventForm::TITLE.$this->event->getName());

		echo 
		"
		<div class='row'>
  		<h2>Event Settings</h2>
		</div>
		"; // display header with event name
		
		$this->loadRenameOption();
		$this->loadDateOptions();
		$this->loadUsers();
		$this->loadDeleteOption();

		echo
		"
		<br><br>
		<div class='form-group'>
			<button class='btn btn-primary btn-block btn-lg' type='submit' name='back'>
				Back
			</button>
		</div>
		";

		$this->closeHtml();
	}

	/**
	 * Displays the 'Rename'-option.
	 */
	private function loadRenameOption() {
			echo 
			"
			<div class='form-group'>
				<div class='page-header'>
  				<h4>Event Name</h4>
				</div>
				<div class='row'>
					<div class='col-md-3'>
						<input type='text' class='form-control' name='eventName' id='eventName' value='".$this->event->getName()."' />
					</div>
					<div class='col-md-1'>
						<button type='submit' class='btn btn-default' name='editName'>
							Rename			
						</button>	
					</div>
				</div>
			</div>
			";
	}
	
	/**
	 * Displays the date-option control panel.
	 */
	private function loadDateOptions() {
			echo 
			"
			<div class='form-group'>
				<div class='page-header'>
  				<h4>Date Options</h4>
				</div>
				<div class='col-md-4 row'>
					<ul class='list-group' id='dateOptionsList'>
			";
			
			$options = DateOptionQuery::create()
				-> filterByEvent($this->event)
				-> orderByDate()
				-> find();

			echo
			"
    	<div class='input-group'>
      	<input type='datetime-local' class='form-control' id='option' name='dateOption' placeholder='".EventSettingsForm::DATE_FORMAT."'>
      	<span class='input-group-btn'>
        	<button class='btn btn-default' type='submit' name='addOption'>Add</button>
      	</span>
    	</div>
  		";
			foreach($options as $option) {
				echo
				"
				<li class='list-group-item'>"
					.$option->getDate()."
					<span style='float:right;'>
						<button class='btn btn-link' style='padding: 0;' type='submit' name='deleteOption' value='".$option->getId()."'>
							<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>
					</span>
				</li>
				";			
			}			

			echo
			"
					</ul>
				</div>
			</div>
			";
	}

	/**
	 * Displays the invited users control panel.
	 */
	private function loadUsers() {
			echo 
			"
			<div class='form-group'>
				<div class='page-header'>
  				<h4>Users</h4>
				</div>
				<div class='col-md-4 row'>
					<ul class='list-group'>
			";
			
			$usernames = InvitationQuery::create()
				-> filterByEvent($this->event)
				-> orderByUsername()
				-> select(array('username'))
				-> find();

			echo
			"
			<div class='input-group'>
      	<input type='text' class='form-control' name='username'>
      	<span class='input-group-btn'>
        	<button class='btn btn-default' type='submit' name='addUser'>Add</button>
      	</span>
    	</div>
			";
			foreach($usernames as $username) {
				if($username != $this->user->getName()) { // don't show yourself
					echo
					"
					<li class='list-group-item'>
						$username
						<span style='float:right;'>
							<button class='btn btn-link' style='padding: 0;' type='submit' name='deleteUser' value='$username'>
								<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>
						</span>
					</li>
					";	
				}		
			}			

			echo
			"
					</ul>
				</div>
			</div>
			";
	}

	/**
	 * Displays the 'Delete'-option
	 */
	private function loadDeleteOption() {
		echo
		"
		<div class='form-group'>
			<div class='page-header'>
  			<h4>Delete Event</h4>
			</div>
			<button type='submit' class='btn btn-danger' name='deleteEvent' id='deleteEvent'>
				Delete
				<span class='glyphicon glyphicon-trash'></span>
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
				<form class='form-horizontal' action='$this->submit' method='post'>
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
		";
	}	
}
?>
