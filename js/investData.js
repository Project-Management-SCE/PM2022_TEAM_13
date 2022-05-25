function buildTable2(data){
		
		let table = document.getElementById('myTable')
		
		for (var i = 0; i < data.inv.length; i++){
			var val = data.inv[i].Pid
			var index = data.file.findIndex(function(item, i){
			  return item.project === val
			});
			if(data.inv[i].aprooved==1){
				if(data.inv[i].collected==0){
			 	row = ` 
				 		<td style="font-size:2vw" ><strong></strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></td>
				 		<td style="font-size:2vw" ><strong><button onclick="document.getElementById('id02').style.display='block';document.getElementById('Invid2').value=this.value;" value = "${data.inv[i].id}">הזן החזרת השקעה</button></strong></td>
						<td style="font-size:2vw" ><strong></strong>${data.inv[i].gainper}%</td>
						<td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 	`
			 }else{
			 		let gain =data.inv[i].amount*(data.inv[i].gainper/100 +1)
			 	row = ` 
				 		<td style="font-size:2vw" ><strong></strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></td>
						<td style="font-size:2vw" ><strong>${gain}₪</strong></td>
						<td style="font-size:2vw" ><strong></strong>${data.inv[i].gainper}%</td>
						<td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
						<td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
						 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 	`

			 }
				

			
				
			
		
					  table.innerHTML+=row
			
				}else{
					var row =`
			<td style="font-size:2vw" ><strong></strong>מחכה לאישור</td>		
			 <td style="font-size:2vw" ><strong></strong>מחכה לאישור</td>
			 <td style="font-size:2vw" ><strong></strong>מחכה לאישור</td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 `	

			
				
			
		
					  table.innerHTML+=row
			

				}	
			}
		}

		
		

	

document.addEventListener("DOMContentLoaded", getInvests);
function getInvests() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		console.log(data3)
		

		el = document.getElementById("myTableHead");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	

		   
		let table = document.createElement('table');
		table.id="myTableHead";
		


		document.getElementById('main').appendChild(table);


		

		let row_1 = document.createElement('tr');

		row_1.id ="Mrow_1";
		row_1.className ="bg-info";

		let heading_1 = document.createElement('th');
		heading_1.innerHTML = "עמותה";
		let heading_2 = document.createElement('th');
		heading_2.innerHTML = "פרוייקט";
		let heading_3 = document.createElement('th');
		heading_3.innerHTML = "סכום השקעה";
		let heading_4 = document.createElement('th');
		heading_4.innerHTML = "אחוז רווח";
		let heading_5 = document.createElement('th');
		heading_5.innerHTML = "קובץ השקעה";
		let heading_6 = document.createElement('th');
		heading_6.innerHTML = "החזר השקעה";
		let heading_7 = document.createElement('th');
		heading_7.innerHTML = "משקיע";
		

		row_1.appendChild(heading_5);
		row_1.appendChild(heading_6);
		row_1.appendChild(heading_4);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_1);
		row_1.appendChild(heading_7);
		
		table.appendChild(row_1);

		

		

		let tbody = document.createElement('tbody');
		tbody.id ="myTable";
		

		table.appendChild(tbody);   

		buildTable2(data3);
		
		
        
    }
};
xmlhttp.open("GET", "getinvestsData.php", true);
xmlhttp.send();

}

