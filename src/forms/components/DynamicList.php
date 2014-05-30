<?php
	class DynamicList {
		var $list_id;
		var $res;
		
		public function __construct($list_id, $input_id, $res) {
			$this->list_id = $list_id;
			$this->input_id = $input_id;
			$this->res = $res;
		}	
		
		public function show() {
			
		}
		
		private function populateInputField() {
			
		}
		private function populateList() {
			echo "<ul class='list-group' id='$List_id'>";
			foreach($optionsMap as $key => $option) {
				echo
				"
				<li class='list-group-item'>
					<span style='float:right;'>
						<button class='btn btn-link' style='padding: 0;' type='submit' name='deleteOption' value='$key'>
							<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>
					</span>
				</li>
				";
			}
		}
		private function addJavascript() {
			echo 
			"
			function loadUsers() {
				var list = document.getElementById('$id');
				
				var firstname = document.getElementById('').value;
				var entry = document.createElement('li');
				entry.appendChild(document.createTextNode(firstname));
				list.appendChild(entry);
			}
			function addUser() {
			}
			
			function handleClick() {
				
			}
			";
		}
	}
?>