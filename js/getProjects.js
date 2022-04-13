
document.addEventListener("DOMContentLoaded", myFunction4);
function myFunction4() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		console.log(data3)
		
		
		
		for(var i = 0 ; i<data3.length ; i++){
			if(i%3==0){
				var diva = document.createElement('div');
				diva.className ="row";
				var pro = document.getElementById('MyPro');

			}
			var cards = `<div class="column">
			
    						 <div class="card">
      						 <h3 style = "color : CornflowerBlue;">${data3[i].Pname}</h3>
     						 <p><strong>סכום יעד : ${data3[i].Target}</strong></p>
      						 <p><strong>תאריך תחילת פרוייקט : ${data3[i].Pstart}</strong></p>
      						 <p><strong>תאריך סיום משוער : ${data3[i].Pend}</strong></p>
    						 </div>
  							 </div>`
				diva.innerHTML += cards
				pro.appendChild(diva);
				
		 }
		     
		    
        
    }
};
xmlhttp.open("GET", "getProjects.php", true);
xmlhttp.send();

}

function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


