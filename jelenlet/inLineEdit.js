function showEdit(editableObj) {
	console.log('ok-showEdit')
	$(editableObj).css("background", "#FFF");
}

initialValue=""//vissza kell tudni állítani az előző értékét a cellának ha hibasan lett módosítva

function initial(obj){
    initialValue=obj.innerHTML
}

function save(editableObj, column, id,datum) {
	console.log('az adatok:'+editableObj.innerHTML+' oszlop:'+column+' azonosito:'+ id+' datum:'+datum)
	if(ellenor(editableObj.innerHTML)){
		$.ajax({
			url : "szabadsag/save-edit.php",
			type : "POST",
			data : 'column=' + column + '&editval=' + editableObj.innerHTML
					+ '&id=' + id + '&datum=' + datum,
			success : function(data) {
				console.log('sikeres adatmódosítás:'+data)
				$(editableObj).css("background", "#FDFDFD");
			},
		error: function() {
		console.log('hiba:Ajaxnál')
		}         
		});
	}else{
		alert('hibas adat')
		editableObj.innerHTML=initialValue
		
	}
}



kategoriak=[]

function ellenor(value){
	console.log('ellenor:'+value)
	$.ajax({ type: "GET",   
         url: "jelenlet/kateg.php",   
         success : function(text){
			kategoriak=text
            //console.log(text);// a text egy objektum, a JS tömmbé kell alakítani:
			//let kateg_tomb=jQuery.makeArray(text);
			
         }
    });
	//reguláris kifejezés használata a megfelelő idő formátum ellenőrzésére
	let pattern= /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/
	//vagy idő csak a megfelelő formátumban(HH:MM) lehet vagy egy kategória kód
	if(!pattern.test(value)) 
		if(!kategoriak.includes(value))
			return false;
		else if(value.length==0 || value.match(/\d+/g)!=null || value.length>3)
			return false;
		else
			return true;
	else
		return true;
	}	
