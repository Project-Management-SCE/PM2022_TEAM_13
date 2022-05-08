

function buildTable2(data){
		
		data.sort(function (a, b) {
			return new Date(b.date).getTime() - new Date(a.date).getTime();
			});
		var table = document.getElementById('myTable2')
		var count =0
	
		for (var i = 0; i < data.length; i++){
			
			if(data[i].collected==1){
				count+=parseFloat(data[i].amount)
			var row = `<tr>
							<td>${data[i].source}</td>
							<td>${data[i].date}</td>
							<td style="color:red;">${data[i].amount}₪</td>
					  </tr>`
					  
			var row2 = `<tr>
							<td>${data[i].source}</td>
							<td>${data[i].date}</td>
							<td style="color:green;" >+${data[i].amount}₪</td>	
					  </tr>`		  
					  	  
			if(data[i].amount>0){table.innerHTML += row2}	
			else {table.innerHTML += row}
						  
				
			}

		}
		let diva = document.createElement('tr');
		
		el = document.getElementById("myTable2");

		if(count>0){
			var row3 = `
							<td style="color:white;"></td>
								
							<td style="color:white;"></td>
							<td style="color:green;font-size:2vw" ><strong>${count}₪</strong></td>
							
							
					  `	
			diva.innerHTML += row3

		}else{
			var row3 = `
							<td style="color:white;"></td>
							
							<td style="color:white;"></td>
							<td style="color:red;font-size:2vw" ><strong>${count}₪</strong></td>	
							
							
					  `	
			diva.innerHTML += row3

		}
		el.insertBefore(diva, el.children[0]);
		
		
	
	} 

// document.addEventListener("DOMContentLoaded", myFunction23());
function myFunction23(str) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		console.log(data3)
		
		el = document.getElementById("myTableHead2");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	
		
		
		   
		let table = document.createElement('table');
		table.id="myTableHead2";
		
		// Adding the entire table to the body tag
		document.getElementById('wrap2').appendChild(table);



		let tbody = document.createElement('tbody');
		tbody.id ="myTable2";

		table.appendChild(tbody);   

		buildTable2(data3);
		
		
        
    }
};
xmlhttp.open("GET", "accmov.php?q="+str, true);
xmlhttp.send();

}

