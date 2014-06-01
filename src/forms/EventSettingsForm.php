<?php
/**
 * This is the GUI for displaying event settings.
 * @author Elias Frantar
 * @version 30.5.2014
 */
class EventSettingsForm {
	const TITLE = "Event Settings | ";

	var $event;
	var $user;

	/**
     * Creates the new form for the given event and user, which submits to the given php-file.
     * @param Event the event to display info from
     * @param MyUser the user visiting this page
     * @param String the full path to the php-file to call on submit
     */
	public function __construct($event, $user) {
		$_SESSION['event_id'] = $event->getId();
		
		$this->event = $event;
		$this->user = $user;
	}
	
	/**
     * Displays the GUI.
     */
	public function show() {
		$this->doIncludes();
		$this->openHtml(EventForm::TITLE.$this->event->getName());

		echo 
		"
		<div class='row'>
  		<h2>Event Settings</h2>
		</div>
		"; // display header with event name
		
		$this->loadRenameOption();
		$this->prepareDateOptions();
		$this->prepareUsers();
		$this->loadDeleteOption();

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
						<input type='text' class='form-control' id='eventName' value='".$this->event->getName()."' />
					</div>
					<div class='col-md-1'>
						<button type='button' class='btn btn-default' onClick='handleRenameEvent()'>
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
	private function prepareDateOptions() {
			echo 
			"
			<div class='form-group'>
				<div class='page-header'>
  				<h4>Date Options</h4>
				</div>
				<div class='col-md-4 row'>
					<ul class='list-group' id='optionsList'>
    					<div class='input-group'>
      						<input type='datetime-local' class='form-control' id='option'>
				      			<span class='input-group-btn'>
				        			<button class='btn btn-default' type='button' onClick='handleAddOptionEvent()'>Add</button>
				      			</span>
				    	</div>
					</ul>
				</div>
			</div>
			";
	}

	/**
	 * Displays the invited users control panel.
	 */
	private function prepareUsers() {
			echo 
			"
			<div class='form-group'>
				<div class='page-header'>
  				<h4>Users</h4>
				</div>
				<div class='col-md-4 row'>
					<ul class='list-group' id='userList'>
						<div class='input-group'>
      						<input type='text' class='form-control' id='username'>
				      			<span class='input-group-btn'>
				        			<button class='btn btn-default' type='button' onClick='handleAddUserEvent()'>Add</button>
				      			</span>
				    	</div>
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
			<button type='button' class='btn btn-danger' id='deleteEvent' onClick='handleDeleteEvent()'>
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
		<body onLoad='handleLoadEvent()'>
			<div class='container'>
				<form class='form-horizontal'>
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
		<script type='text/javascript' src='../forms/EventSettings.js'></script>
		";
	}	
}
?>