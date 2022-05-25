function buildTable2(data){
		
		// data.sort(function (a, b) {
		// 	return new Date(b.date).getTime() - new Date(a.date).getTime();
		// 	});
		let table = document.getElementById('myTable')
		
		for (var i = 0; i < data.inv.length; i++){
			if(data.inv[i].aprooved==0){

				var row =`
			 <td style="font-size:2vw" ><strong><button style="margin:2vw" onclick="document.getElementById('id02').style.display='block';document.getElementById('Invid2').value=this.value;document.getElementById('Pid2').value=${data.inv[i].Pid}"value="${data.inv[i].id}">סרב</button>
			 <button style="margin:2vw" onclick="document.getElementById('id01').style.display='block';document.getElementById('Invid').value=this.value;document.getElementById('Pid').value=${data.inv[i].Pid}" value="${data.inv[i].id}">אשר והזן השקעה</button></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 `	

			
				
			
		
					  table.innerHTML+=row
			}else if(data.inv[i].payed==0){
				var row =`
			 <td style="font-size:2vw" ><strong><button onclick="document.getElementById('id03').style.display='block';document.getElementById('Invid3').value=this.value;document.getElementById('amount3').value=${data.inv[i].amount};document.getElementById('investor3').value='${data.inv[i].investor}'" value="${data.inv[i].id}">צור תשלום</button></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].investor}</strong></td>
			 `	

			
				
			
		
					  table.innerHTML+=row

			}else if(data.inv[i].payed==1){
				var row =`
			 <td style="font-size:2vw" ><strong>שולם</strong></td>
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
		heading_4.innerHTML = "";
		let heading_5 = document.createElement('th');
		heading_5.innerHTML = "משקיע";
		

		
		row_1.appendChild(heading_4);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_1);
		row_1.appendChild(heading_5);
		
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

