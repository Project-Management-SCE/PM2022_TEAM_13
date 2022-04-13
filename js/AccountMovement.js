

function buildTable2(data){
		
		data.sort(function (a, b) {
			return a.OPDate - b.OPDate;
			});
		var table = document.getElementById('myTable2')
		var count =0
	
		for (var i = 0; i < data.length; i++){
			
			if(data[i].collected==1){
				count+=parseFloat(data[i].amount)
			var row = `<tr>
							<td>${data[i].source}</td>
							<td style="color:red;">${data[i].amount}₪</td>
							<td>${data[i].date}</td>
					  </tr>`
					  
			var row2 = `<tr>
							<td>${data[i].source}</td>
							<td style="color:green;" >${data[i].amount}₪</td>	
							<td>${data[i].date}</td>
					  </tr>`		  
					  	  
			if(data[i].amount>0){table.innerHTML += row2}	
			else {table.innerHTML += row}
						  
				
			}

		}
		
		
		
		var row3 = `<tr>
							<td>${new Date().toDateString()} :עד לתאריך  </td>
							<td style="color:green;" >${count}₪</td>	
							<td>סה"כ</td>
					  </tr>`	
	table.innerHTML += row3
	
	} 

document.addEventListener("DOMContentLoaded", myFunction2);
function myFunction2() {

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



		// Creating and adding data to first row of the table
		let row_1 = document.createElement('tr');

		// let heading = document.createElement('th');
		
		// heading.innerHTML = '<button value="" class="m1"><</button>';
		// let heading2 = document.createElement('th');
		
		// heading2.innerHTML = '<button  value="" class="m1">></button>';


		let heading_1 = document.createElement('th');
		heading_1.innerHTML = "מקור תנועה";
		let heading_2 = document.createElement('th');
		heading_2.innerHTML = "סכום";
		let heading_3 = document.createElement('th');
		heading_3.innerHTML = "תאריך";

		
		row_1.appendChild(heading_1);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_3);
		table.appendChild(row_1);

		let tbody = document.createElement('tbody');
		tbody.id ="myTable2";

		table.appendChild(tbody);   

		buildTable2(data3);
		
		
        
    }
};
xmlhttp.open("GET", "accmov.php", true);
xmlhttp.send();

}

/*
function myFunction() {
$.ajax({
    url: "http://localhost/freelove/RaiseTable.php",
    method: "GET",
    success: function(data3) {
      console.log(data3);
	 
	
 let el = document.getElementById("mycanvas");
  el.parentNode.removeChild(el);
	
	   
let table = document.createElement('table');
table.id="myTableHead";
table.className ="table table-striped";

// Adding the entire table to the body tag
document.getElementById('wrap').appendChild(table);




// Creating and adding data to first row of the table
let row_1 = document.createElement('tr');

row_1.id ="Mrow";
row_1.className ="bg-info";

let heading_1 = document.createElement('th');
heading_1.innerHTML = "סוג גיוס";
let heading_2 = document.createElement('th');
heading_2.innerHTML = "סכום";
let heading_3 = document.createElement('th');
heading_3.innerHTML = "תאריך";

row_1.appendChild(heading_1);
row_1.appendChild(heading_2);
row_1.appendChild(heading_3);
table.appendChild(row_1);

let tbody = document.createElement('tbody');
tbody.id ="myTable";

table.appendChild(tbody);   

	  
	  
	 
	  
	  
    buildTable(data3);
	  },
    error: function(data3) {
      console.log(data3);
    }
  });
}

/*
function myFunction() {
 var myArray = [
	    {'Rid': '1', 'type': 'קופות צדקה', 'amount': '30', 'BuyPrice': '10', 'SellPrice': '6000', 'StartDate': '2022-02-28 18:26:11', 'EndDate':'2022-03-28 18:26:11'},
	     {'Rid': '2', 'type': 'ספרונים', 'amount': '200', 'BuyPrice': '2', 'SellPrice': '1000', 'StartDate': '2022-03-28 18:27:54', 'EndDate':'2022-04-28 18:27:54'}
	   
	]
	
	
	
	
}*/


/*

$("#mybtn1").click(function(){
  $.ajax({
    url: "http://localhost/freelove/RaiseTable.php",
    method: "GET",
    success: function(data3) {
      console.log(data3);
	  $("#mycanvas").remove();
	   $("#myTableHead").remove();
	   
	   
	   
	   $("#wrap").wrapInner($("<table />", {
  "id" : "myTableHead","class" : "table table-striped"
}));

	   $("#myTableHead").wrapInner( $("<tr />", {
  "class" : "bg-info",
  "id" : "Mrow"
}));

  $("#Mrow").wrapInner( $("<th>סוג גיוס</th>"));
  $("#Mrow").wrapInner( $("<th>סכום</th>"));
 
    $("#Mrow").wrapInner( $("<th>תאריך</th>"));

	   $("#myTableHead").wrapInner( $("<tbody />", {
  "id" : "myTable"
}));
	  
	  
	  
	 
	  
	  
    buildTable(data3);
	  },
    error: function(data3) {
      console.log(data3);
    }
  });
});
*/
		