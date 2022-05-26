function buildTable2(data){
		
		// data.sort(function (a, b) {
		// 	return new Date(b.date).getTime() - new Date(a.date).getTime();
		// 	});
		let table = document.getElementById('myTable')
		
		for (var i = 0; i < data.inv.length; i++){


			var val = data.inv[i].Pid
			var index = data.file.findIndex(function(item, i){
			  return item.project === val
			});
			

			if(data.inv[i].pulled==1){
				var row =`
			<td style="font-size:2vw" >בוצעה העברה לחשבון</td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong><a href="PAA_investor.php?q=${data.inv[i].Pid}">${data.inv[i].Aname}</a></strong></td>
			 `	

			}
			else if(data.inv[i].requested==1){
				var row =`
			<td style="font-size:2vw" >הוגשה בקשה למשיכה</td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong><a href="PAA_investor.php?q=${data.inv[i].Pid}">${data.inv[i].Aname}</a></strong></td>
			 `	

			}
			else if(data.inv[i].collected==1){
				var row =`
			<td style="font-size:2vw" ><a href="WithDrawRequest.php?q=${data.inv[i].id}">בקשת משיכה לחשבון</a></td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong><a href="PAA_investor.php?q=${data.inv[i].Pid}">${data.inv[i].Aname}</a></strong></td>
			 `	

			}

			else if(data.inv[i].payed==1){
					var row =`
			<td style="font-size:2vw" >שולם</td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong><a href="PAA_investor.php?q=${data.inv[i].Pid}">${data.inv[i].Aname}</a></strong></td>
			 `	

			}

			else if(data.inv[i].aprooved==1){
					var row =`
			<td style="font-size:2vw" >מחכה לתשלום</td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 `	

			}else if(data.inv[i].assigned==1){
				var row =`
			<td style="font-size:2vw" ><strong><button onclick="document.getElementById('id01').style.display='block';document.getElementById('Invid2').value='${data.inv[i].id}';document.getElementById('amount2').value='${data.inv[i].amount}';">אישור השקעה</button></strong></td>
			 <td style="font-size:2vw" ><strong><a href="downloadsinv.php?file_id=${data.file[index].id}">Download</a></strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].gainper}%</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 `	
			} 

			else{
					var row =`
			 <td style="font-size:2vw" ><strong></strong></td>
			 <td style="font-size:2vw" ><strong></strong></td>
			 <td style="font-size:2vw" ><strong>מחכה לאישור</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].amount}₪</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Pname}</strong></td>
			 <td style="font-size:2vw" ><strong>${data.inv[i].Aname}</strong></td>
			 `	

			}
				
			
		
					  table.innerHTML+=row
			}
		}

		
		
	
	

// document.addEventListener("DOMContentLoaded", getInvests());
function getInvests(id) {

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
		


		document.getElementById('MyPro').appendChild(table);


		

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
		heading_5.innerHTML = "קובץ הסכם";
		let heading_6 = document.createElement('th');
		heading_6.innerHTML = "";

		row_1.appendChild(heading_6);
		row_1.appendChild(heading_5);
		row_1.appendChild(heading_4);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_1);
		
		table.appendChild(row_1);

		

		

		let tbody = document.createElement('tbody');
		tbody.id ="myTable";
		

		table.appendChild(tbody);   

		buildTable2(data3);
		
		
        
    }
};
xmlhttp.open("GET", "getinvests.php?q="+id, true);
xmlhttp.send();

}

