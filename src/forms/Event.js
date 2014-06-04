function goToSettings() {
	document.location.href = "../userCake/EventSettings.php";
}

function fixDate(dateId) {
	$.ajax({                                      
	    url: "../userCake/Event.php",       
	    type: "POST",
	    datatype: "json",
	    data: { "action": "FIX_DATE",
	    		"option": dateId},
	    success: function(result) {
	    	location.reload();
	    }
	});
}

function postComment() {
	var content = document.getElementById("content");
	
	$.ajax({                                      
	    url: "../userCake/Event.php",       
	    type: "POST",
	    datatype: "json",
	    data: { "action": "POST_COMMENT",
	    		"content": content.value},
	    success: function(result) {
	    	location.reload();
	    }
	});
}

function handleRemoveComment(Id) {
	$.ajax({                                      
	    url: "../userCake/Event.php",       
	    type: "POST",
	    data: { "action": "REMOVE_COMMENT",
	    		"to_delete": Id},
	    success: function(result) {
	    	location.reload();
	    }
	});
}
