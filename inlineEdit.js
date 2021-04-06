console.log('betoltodott')

function showEdit(editableObj) {
	console.log('ok')
	$(editableObj).css("background", "#FFF");
}

function save(editableObj, column, id) {
	//console.log('column='+column)
	$(editableObj)
			.css("background", "#FFF url(loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "save-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&id=' + id,
		success : function(data) {
            //console.log('sikerult')
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}

