
document.addEventListener("DOMContentLoaded", myFunction4);
function myFunction4() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		console.log(data3)
			el = document.getElementById("diva1");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	
		
		// <p><strong><a href="downloads.php?file_id=${data3.file[i].id}">הורד קובץ פרוייקט</a></strong></p>
		
		for(var i = 0 ; i<data3.proj.length;  i++){
			if(i%3==0){
				var diva = document.createElement('div');
				diva.className ="row";
				diva.id = "diva1";
				var pro = document.getElementById('Raises2');

			}
			if(data3.proj[i].hasinv==0 ){
				
				var index = data3.file.indexOf(data3.proj[i].id)
				var cards = `<div class="column">
    						 <div class="card">
      						 <h3 style = "color : CornflowerBlue;">${data3.proj[i].Pname}</h3>
      						  <p><strong>עמותה: ${data3.proj[i].Aname}</strong></p>
     						 <p><strong>סכום יעד : ${data3.proj[i].Target}</strong></p>
      						 <p><strong>תאריך תחילת פרוייקט : ${data3.proj[i].Pstart}</strong></p>
      						 <p><strong>תאריך סיום משוער : ${data3.proj[i].Pend}</strong></p>
      						 <p><a href="investAsk.php?pid=${data3.proj[i].id}"><strong>הגש בקשה להשקעה</strong></a></p>
    						 </div>
  							 </div>`
				diva.innerHTML += cards
				pro.appendChild(diva);
				
			}else{
				var cards = `<div class="column">
    						 <div class="card">
      						 <h3 style = "color : CornflowerBlue;">${data3.proj[i].Pname}</h3>
      						 <p><strong>עמותה: ${data3.proj[i].Aname}</strong></p>
     						 <p><strong>סכום יעד : ${data3.proj[i].Target}</strong></p>
      						 <p><strong>תאריך תחילת פרוייקט : ${data3.proj[i].Pstart}</strong></p>
      						 <p><strong>תאריך סיום משוער : ${data3.proj[i].Pend}</strong></p>
      						 <p><strong> ${data3.proj[i].investor}  : מושקע ע"י </strong></a></p>
    						 </div>
  							 </div>`
				diva.innerHTML += cards
				pro.appendChild(diva);

			}
			
				
		 }
		     

        
    }
};
xmlhttp.open("GET", "getAllProjects.php", true);
xmlhttp.send();

}

function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


function investAsk (pid) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
				
		 }
		     

        
    
};
xmlhttp.open("GET", "investAsk.php?pid="+pid, true);
xmlhttp.send();

}
