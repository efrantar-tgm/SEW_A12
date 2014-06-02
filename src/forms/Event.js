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