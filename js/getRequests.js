
function reqapp(id,group,amount) {
  if(id==" "){
    
    return;
	}
	else{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    
    }
  };
 
  xhttp.open("GET", "appRequests.php?id="+id+"&group="+group+"&amount="+amount, true);
  xhttp.send();
  }
  
}


function buildTable2(data){
		
		let table = document.getElementById('myTable')
		
		for (var i = 0; i < data.inv.length; i++){
			var am =data.inv[i].amount*(1+data.inv[i].gainper/100) 

			if(data.inv[i].pulled==1){
				row = ` 
				 		<td style="font-size:2vw" ><strong></strong>העברה בוצעה</td>
						<td style="font-size:2vw" ><strong></strong>${am}₪</td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Pname}-${data.inv[i].Aname}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 	`

			}else{
				row = ` 
				 		<td style="font-size:2vw" ><strong></strong><button value="${data.inv[i].id}" onclick="reqapp(this.value,${data.inv[i].group},${am})">אשר משיכה</button></td>
						<td style="font-size:2vw" ><strong></strong>${am}₪</td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Pname}-${data.inv[i].Aname}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 	`
			 

			}
			 	
			
		
					  table.innerHTML+=row
			
				
			}

			table = document.getElementById('myTable2')
			for (var i = 0; i < data.raise.length; i++){
			
			 if(data.raise[i].pulled==1){

			 	row = ` 
				 		<td style="font-size:2vw" ><strong></strong>העברה בוצעה</td>
						<td style="font-size:2vw" ><strong></strong>${data.raise[i].SellPrice}₪</td>
						<td style="font-size:2vw" ><strong>${data.raise[i].type}-${data.raise[i].CollectDate}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.raise[i].Aname}</strong></td>
			 	`

			 }

			 	else{

			 		row = ` 
				 		<td style="font-size:2vw" ><strong></strong><button value="${data.raise[i].id}" onclick="reqapp(this.value,${data.raise[i].group},${data.raise[i].SellPrice})">אשר משיכה</button></td>
						<td style="font-size:2vw" ><strong></strong>${data.raise[i].SellPrice}₪</td>
						<td style="font-size:2vw" ><strong>${data.raise[i].type}-${data.raise[i].CollectDate}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.raise[i].Aname}</strong></td>
			 	`

			 	}

			 	
			 
			
		
					  table.innerHTML+=row
			
				
			}
		}

		
		

	

document.addEventListener("DOMContentLoaded", getInvests);
function getInvests() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		console.log(data3)

		   
		let table = document.createElement('table');
		table.id="myTableHead";
		let table2 = document.createElement('table');
		table2.id="myTableHead2";

		let h1 = document.createElement('h1');
		h1.id = 'invh';
		h1.innerHTML+='בקשות משיכת משקיעים';


		let h2 = document.createElement('h1');
		h2.id = 'assh';
		h2.innerHTML+='בקשות משיכת עמותות';


		document.getElementById('main').appendChild(h1);

		document.getElementById('main').appendChild(table);

		document.getElementById('main').appendChild(h2);

		document.getElementById('main').appendChild(table2);
		

		let row_1 = document.createElement('tr');

		row_1.id ="Mrow_1";
		row_1.className ="bg-info";

		let row_2 = document.createElement('tr');

		row_2.id ="Mrow_2";
		row_2.className ="bg-info";

		let heading_1 = document.createElement('th');
		heading_1.innerHTML = "משקיע";//amut/invest
		let heading_2 = document.createElement('th');
		heading_2.innerHTML = "פרוייקט";//proj/raise
		let heading_3 = document.createElement('th');
		heading_3.innerHTML = "סכום להעברה";//amount
		let heading_4 = document.createElement('th');
		heading_4.innerHTML = "";//
		
		

		
		row_1.appendChild(heading_4);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_1);
		
		
		table.appendChild(row_1);

		let heading_12 = document.createElement('th');
		heading_12.innerHTML = "עמותה";//amut/invest
		let heading_22 = document.createElement('th');
		heading_22.innerHTML = "גיוס";//proj/raise
		let heading_32 = document.createElement('th');
		heading_32.innerHTML = "סכום להעברה";//amount
		let heading_42 = document.createElement('th');
		heading_42.innerHTML = "";//
		
		

		
		row_2.appendChild(heading_42);
		row_2.appendChild(heading_32);
		row_2.appendChild(heading_22);
		row_2.appendChild(heading_12);
		
		
		table2.appendChild(row_2);

		

		

		let tbody = document.createElement('tbody');
		tbody.id ="myTable";
		

		table.appendChild(tbody);  

		let tbody2 = document.createElement('tbody');
		tbody2.id ="myTable2";
		

		table2.appendChild(tbody2); 

		buildTable2(data3);
		
		
        
    }
};
xmlhttp.open("GET", "getRequests.php", true);
xmlhttp.send();

}

