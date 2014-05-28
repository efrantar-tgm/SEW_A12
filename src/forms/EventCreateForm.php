<?php
/**
 * This is the GUI for creating events.
 * @author Elias Frantar
 * @version 27.5.2014
 */	
class EventCreateForm {
	var $submit;

	/**
   * Creates the new form, which submits to the given php-file.
   * @param String the full path to the php-file to call on submit
   */
	public function __construct($submit) {
		$this->submit = $submit;
	}
	
	/**
   * Displays the GUI.
   */
	public function show() {
		echo 
		"
		<link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<html>
		<body>
			<div class='container'>
				<form action='$this->submit' method='post'>
					<div class='form-group'>
						<h2>Event erstellen</h2>
					</div>

					<div class='form-group'>
    				<label for='eventName'>Name</label>
      			<input type='text' class='form-control' id='eventName' name='eventName' placeholder='Event Name'>
  				</div>

					<div class='form-group'>
						<div class='radio'>
							<label>
								<input type='radio' name='eventtype' value='standardEvent' checked>
								Standard Event
							</label>
						</div>
						<div class='radio'>
							<label>
								<input type='radio' name='eventtype' value='oneoneEvent'>
								OneOne Event
							</label>
						</div>
					</div>
					
					<div class='form-group'>
      			<button type='submit' class='btn btn-primary' name='createEvent'>Create Event</button>
  				</div>
				</form>
			</div>
		</body>
		</html>
		";
	}	
}
?>
