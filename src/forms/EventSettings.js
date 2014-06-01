/**
 * This file includes the functions referenced in the event-settings-GUI.
 * @author Elias Frantar
 * @version 1.6.2014
 */

/**
 * Handles loadling the user- and the options-list.
 * Should be called after loading the base-HTML-page.
 */
function handleLoadEvent() {
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    datatype: "json",
	    data: { "action": "GET_OPTIONS"},
	    success: function(result) {
	    	loadOptionsList(result);
	    }
	});
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    datatype: "json",
	    data: { "action": "GET_USERS"},
	    success: function(result) {
	    	loadUserList(result);
	    }
	});
}

/**
 * Handles renaming the event.
 * Should be called 'onClick' of the 'Rename'-button.
 */
function handleRenameEvent() {
	var eventName = document.getElementById("eventName");
	
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    datatype: "text",
	    data: { "action": "RENAME",
	    		"newName": eventName.value},
	    success: function(result) {
	    	eventName.value = result;
	    }
	});
}

/**
 * Handles adding a date-option to the event.
 * Should be called 'onClick' of the 'AddOption'-button.
 */
function handleAddOptionEvent() {
	var option = document.getElementById('option');
	
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    data: { "action": "ADD_OPTION",
	    		"newOption": option.value},
	    success: function(result) {
	    	loadOptionsList(result);
	    }
	});
}
/**
 * Handles removing a date-option from the event.
 * Should be called 'onClick' of the 'Delete'-buttons in the options-list.
 * @param optionId the id of the option to remove
 */
function handleRemoveOptionEvent(optionId) {
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    data: { "action": "REMOVE_OPTION",
	    		"option": optionId},
	    success: function(result) {
	    	loadOptionsList(result);
	    }
	});
}

/**
 * Handles inviting a new user to the event.
 * Should be called 'onClick' of the 'AddUser'-button.
 */
function handleAddUserEvent() {
	var user = document.getElementById('username');
	
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    data: { "action": "ADD_USER",
	    		"newUser": user.value},
	    success: function(result) {
	    	loadUserList(result);
	    	user.value = "";
	    }
	});
}
/**
 * Handles disinviting a user from the event.
 * Should be called 'onClick' of the 'Delete'-buttons in the user-list.
 * @param userName the name of the user to delete
 */
function handleRemoveUserEvent(userName) {
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    data: { "action": "REMOVE_USER",
	    		"username": userName},
	    success: function(result) {
	    	loadUserList(result);
	    }
	});
}

/**
 * Handles deleting the event.
 * Should be called 'onClick' of the 'Delete'-button.
 */
function handleDeleteEvent() {
	$.ajax({                                      
	    url: "../userCake/EventSettings.php",       
	    type: "POST",
	    data: { "action": "DELETE_EVENT"},
	    success: function(result) {
	    	document.location.href = "../userCake/EventList.php";
	    }
	});
}

/**
 * Loads the options-list.
 * @param result the data received from an AJAX-response, which should now be added to the list
 */
function loadOptionsList(result) {
	$("#optionsList").children().slice(1).detach(); // we don't want to remove the input-field

	$.each($.parseJSON(result), function(i, val) {
		var element = 	"<li class='list-group-item'>" 
							+ val["date"] + 
							"<span style='float: right;'>" +
								"<button class='btn btn-link' style='padding: 0;' type='button' onClick='handleRemoveOptionEvent(" + val["id"] + ")'>" +
								"<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>" +
							"</span>" +
						"</li>";
		
		$("#optionsList").append(element);
	});
}
/**
 * Loads the user-list.
 * @param result the data received from an AJAX-response, which should now be added to the list
 */
function loadUserList(result) {
	$("#userList").children().slice(1).detach(); // we don't want to remove the input-field

	$.each($.parseJSON(result), function(i, val) {
		var element = 	"<li class='list-group-item'>" 
							+ val + 
							"<span style='float: right;'>" +
								"<button class='btn btn-link' style='padding: 0;' type='button' onClick='handleRemoveUserEvent(\"" + val + "\")'>" +
								"<span class='glyphicon glyphicon-remove' style='color: d2322d;'></span>" +
							"</span>" +
						"</li>";
		
		$("#userList").append(element);
	});
}