

function buildTable(data){
		var table = document.getElementById('myTable4')
		
		x= []
		for(var i = 0;i<data.pay.length;i++){

			x.push({amount:data.pay[i].amount , date : data.pay[i].date , Aname : "",Pname : "תשלום"})
		}

		for(var i=0;i<data.inv.length;i++){
			x.push({amount:data.inv[i].amount , date : data.inv[i].date , Aname :  data.inv[i].Aname,Pname : data.inv[i].Pname})

		}

		x.sort(function (a, b) {
			return new Date(b.date).getTime() - new Date(a.date).getTime();
			});
		var count =0
		for(var i=0;i<x.length;i++){
			
			
				var row = `<tr>
							<td>${x[i].Aname}</td>
							<td>${x[i].Pname}</td>
							<td>${x[i].date}</td>
							<td style="color:red;">${x[i].amount}₪</td>
							
					  </tr>`
					  
			var row2 = `<tr>
							<td>${x[i].Aname}</td>
							<td>${x[i].Pname}</td>
							<td>${x[i].date}</td>
							<td style="color:green;" >+${x[i].amount}₪</td>	
							
					  </tr>`		  
					  	  
			
				if(x[i].amount>0){
					count+=parseFloat(x[i].amount)
					table.innerHTML += row2

				}
			else {
					count+=parseFloat(x[i].amount)
					table.innerHTML += row}
			}
			
		
		let diva = document.createElement('tr');
		
		el = document.getElementById("myTable4");

		
		
			var row3 = `
							<td ></td>
							
							<td style="color:grey;font-size:2vw" ><strong>${count}₪</strong></td>
							<td style="color:grey;font-size:2vw"><strong>:עו"ש</strong></td>
							
					  `	
			diva.innerHTML += row3

		el.insertBefore(diva, el.children[0]);
	
	
	} 


// document.getElementById("mybtn1").addEventListener("click", myFunction2);
function myFunction2(id) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		let el = document.getElementById("mycanvas");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 
		
		el = document.getElementById("myTableHead4");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	
		
		console.log(data3)
		   
		let table = document.createElement('table');
		table.id="myTableHead4";
		table.className ="table table-striped";

		// Adding the entire table to the body tag
		document.getElementById('wrap').appendChild(table);




		
		let tbody = document.createElement('tbody');
		tbody.id ="myTable4";

		table.appendChild(tbody);   

		buildTable(data3);
		
		
        
    }
};
xmlhttp.open("GET", "InvestMovement.php?q="+id, true);
xmlhttp.send();

}

