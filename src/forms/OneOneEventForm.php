<?php
require_once("../forms/BaseEventForm.php");

class OneOneEventForm extends BaseEventForm {
	const INFO = "<h4 style='color: #5bc0de;'>OneOne-Event</h4>
				  This is a OneOne-Event, so only on person per date. So pick the free one, which suits best for you.";
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
			$option = $this->options[$i];
			$selected_radio= "";
			if($option->getPollStatus($this->user) == DateOption::ACCEPT) {
				$selected_radio = "poll";
			}
		
			$disabled = "";
			if($option->pollFinished($this->event) && $option->getUsername() != $this->user->getName()) {
				$disabled = "disabled";	
			}
			
			$numberOfOptions = count($this->options);
			echo
			"
			<td align='center'>
				<input type='radio' name='poll' id='poll$i' value='".$option->getId()."')' $disabled>
			</td>
			<script type='text/javascript'>
				$('#$selected_radio".$i."').prop('checked', true);
			</script>
			";
		}
	}
}
?>