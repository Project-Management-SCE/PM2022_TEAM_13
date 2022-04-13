

function buildTable3(data){
		
		
		var table = document.getElementById('myTable3')
		var count =0
	
		for (var i = 0; i < data.length; i++){
			count+=parseFloat(data[i].amount)
			var row = `<tr>
							<td><button onclick='loadDocs(this.value)' value="${data[i].id}" class="m1"> מחק עובד</button></td>
							<td>${data[i].Duties}</td>
							<td> ${data[i].Wphone} </td>
							<td>${data[i].Wemail}</td>
							<td>${data[i].Wname}</td>
					  </tr>`
					  
			table.innerHTML += row	
			
						  
			
		}
		
	
	} 

document.addEventListener("DOMContentLoaded", myFunction3);
function myFunction3() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		console.log(data3)
		
		el = document.getElementById("myTableHead3");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	
		
		
		   
		let table = document.createElement('table');
		table.id="myTableHead3";
		table.className ="table table-striped";

		// Adding the entire table to the body tag
		document.getElementById('wrap3').appendChild(table);




		// Creating and adding data to first row of the table
		let row_1 = document.createElement('tr');

		row_1.id ="Mrow3";
		row_1.className ="bg-info";
		let heading_11 = document.createElement('th');
		heading_11.innerHTML = "הסר עובד";
		let heading_1 = document.createElement('th');
		heading_1.innerHTML = "מספר נייד";
		let heading_2 = document.createElement('th');
		heading_2.innerHTML = "אימייל";
		let heading_3 = document.createElement('th');
		heading_3.innerHTML = "תפקיד";
		let heading_4 = document.createElement('th');
		heading_4.innerHTML = "שם עובד";
		
		row_1.appendChild(heading_11);
		row_1.appendChild(heading_1);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_4);
		table.appendChild(row_1);

		let tbody = document.createElement('tbody');
		tbody.id ="myTable3";

		table.appendChild(tbody);   

		buildTable3(data3);
		
		
        
    }
};
xmlhttp.open("GET", "getCrew.php", true);
xmlhttp.send();

}

