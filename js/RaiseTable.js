

function buildTable(data){
		var table = document.getElementById('myTable')
		var x=[]
		for (var i = 0; i < data.length-1; i++){
			
			var to =data[i].amount*data[i].BuyPrice
			x.push({type:data[i].type, amount :-to , oDate: data[i].StartDate})
			x.push({type:data[i].type, amount :data[i].SellPrice , oDate: data[i].CollectDate})
			
			

		}
		x.sort(function (a, b) {
			return new Date(b.oDate).getTime() - new Date(a.oDate).getTime();
			});
		
		var count =0
		for(var i=0;i<x.length;i++){
			count+=parseFloat(x[i].amount)
			var row = `<tr>
							<td>${x[i].type}</td>
							<td>${x[i].oDate}</td>
							<td style="color:red;">${x[i].amount}₪</td>
							
					  </tr>`
					  
			var row2 = `<tr>
							<td>${x[i].type}</td>
							<td>${x[i].oDate}</td>
							<td style="color:green;" >+${x[i].amount}₪</td>	
							
					  </tr>`		  
					  	  
			if(x[i].amount>0){table.innerHTML += row2}	
			else {table.innerHTML += row}
						  
			
					  
		
			
			
		}
		let diva = document.createElement('tr');
		
		el = document.getElementById("myTable");

		let perc = parseInt((count/data[data.length-1].Target)*100);
		if(count>0){
			var row3 = `
							<td ><strong>מיעד של  :${data[data.length-1].Target}₪</strong></td>
							<td style="color:green;font-size:2vw;"><strong style="right:2vw;position:relative;">${perc}%</strong><div><progress style="width:10vw" value="${perc}" max="100"></progress></div></td>
							<td style="color:green;font-size:2vw" ><strong>${count}₪</strong></td>
							
					  `	
			diva.innerHTML += row3

		}else{
			var row3 = `
							<td><strong>מיעד של  :${data[data.length-1].Target}₪</strong></td>
							<td style="color:red;font-size:2vw"><strong style="right:2vw;position:relative;>0%</strong><div><progress style="width:10vw" value="${perc}" max="100"></progress></div></td>
							<td style="color:red;font-size:2vw" ><strong>${count}/${data[data.length-1].Target}₪</strong></td>	
							
							
					  `	
			diva.innerHTML += row3

		}
		el.insertBefore(diva, el.children[0]);
	
	
	} 


// document.getElementById("mybtn1").addEventListener("click", myFunction);
function myFunction2(str) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		
		let el = document.getElementById("mycanvas");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 
		
		el = document.getElementById("myTableHead");
		//If it isn't "undefined" and it isn't "null", then it exists.
    if(typeof(el) != 'undefined' && el != null){
        el.parentNode.removeChild(el);
    } 	
		
		console.log(data3)
		   
		let table = document.createElement('table');
		table.id="myTableHead";
		table.className ="table table-striped";

		// Adding the entire table to the body tag
		document.getElementById('wrap').appendChild(table);




		
		let tbody = document.createElement('tbody');
		tbody.id ="myTable";

		table.appendChild(tbody);   

		buildTable(data3);
		
		
        
    }
};
xmlhttp.open("GET", "RaiseTable.php?q="+str, true);
xmlhttp.send();

}

