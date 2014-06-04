<?php
require_once("../forms/BaseEventForm.php");

class StandardEventForm extends BaseEventForm {
	const INFO = "<h4 style='color: #5bc0de;'>Standard-Event</h4>
				  This is a Standard-Event. Please mark if you have or haven't got time for all date-options.";
	/**
	 * @see BaseEventForm
	 */
	protected function getInfoText() { return StandardEventForm::INFO; }
	
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
	
		if($this->event->getFixed()) {
			$this->disabled = "disabled";
		}
	}
	
	protected function loadPollOptions() {
		echo "<td><b>You</b></td>";
		for($i = 0;$i < count($this->options);$i++) {
			switch($this->options[$i]->getPollStatus($this->user)) {
				case DateOption::ACCEPT:
					$pressed_button = "pollOk";
					break;
				case DateOption::DECLINE:
					$pressed_button = "pollDecline";
					break;
				case DateOption::NONE:
					$pressed_button = "pollNone";
			}
		
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
}
?>