console.log('betoltodott')
document.getElementById("honap").addEventListener("change",read)
function read(){
    let datum=this.value
    console.log(datum)
    let xhr=new XMLHttpRequest();	
	xhr.open('GET','jelenlet/read.php?datum='+datum,true);
	xhr.addEventListener('readystatechange',()=>{
		if(xhr.readyState==4 && xhr.status==200)
			show(xhr)
	})	
	xhr.send();
	
}

function show(xhr){
	document.getElementById('output').innerHTML="<tbody>"+xhr.responseText+"</tbody>";
 
}                              

document.getElementById("feltolt").addEventListener("click",feltolt)

function feltolt(){
    let nincs=document.getElementById('output').innerHTML.indexOf('Nincs');
    console.log(nincs+"-nincs")
    if(nincs>=0){
        let datum=document.getElementById('honap').value
        if(datum.length==0)
            document.getElementById('output').innerHTML="nincs dátum választva!!!"
        else{
            let xhr=new XMLHttpRequest();	
            xhr.open('GET','jelenlet/read.php?ujdatum='+datum,true);
            xhr.addEventListener('readystatechange',()=>{
                if(xhr.readyState==4 && xhr.status==200)
                    show(xhr)
            })	
            xhr.send();
        }
    }
}
//törlés:
document.getElementById("torol").addEventListener("click",torol)

function torol(){
        let datum=document.getElementById('honap').value
        if(datum.length==0)
            document.getElementById('output').innerHTML="nincs dátum választva!!!"
        else{
            let xhr=new XMLHttpRequest();	
            xhr.open('GET','jelenlet/torol.php?datum='+datum,true);
            xhr.addEventListener('readystatechange',()=>{
                if(xhr.readyState==4 && xhr.status==200)
                    document.getElementById('output').innerHTML=xhr.responseText
            })	
            xhr.send();
        }
    
}