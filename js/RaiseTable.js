

function buildTable(data){
		var table = document.getElementById('myTable')
		var x=[]
		for (var i = 0; i < data.length; i++){
			
			var to =data[i].amount*data[i].BuyPrice
			x.push({type:data[i].type, amount :-to , oDate: data[i].StartDate})
			x.push({type:data[i].type, amount :data[i].SellPrice , oDate: data[i].CollectDate})
			x.sort(function (a, b) {
			return a.oDate - b.oDate;
			});
			

		}
		
		var count =0
		for(var i=0;i<x.length;i++){
			count+=parseFloat(x[i].amount)
			var row = `<tr>
							<td>${x[i].oDate}</td>
							<td style="color:red;">${x[i].amount}₪</td>
							<td>${x[i].type}</td>
					  </tr>`
					  
			var row2 = `<tr>
							<td>${x[i].oDate}</td>
							<td style="color:green;" >${x[i].amount}₪</td>	
							<td>${x[i].type}</td>
					  </tr>`		  
					  	  
			if(x[i].amount>0){table.innerHTML += row2}	
			else {table.innerHTML += row}
						  
			
					  
						  
			/*if(data[i].EndDate>=new Date()){table.innerHTML += row
				table.innerHTML += row2}
			
			else {table.innerHTML += row}
*/
			
			
		}
		
		var row3 = `<tr>
							<td>${new Date().toDateString()} :עד לתאריך  </td>
							<td style="color:green;" >${count}₪</td>	
							<td>סה"כ</td>
					  </tr>`	
	table.innerHTML += row3
	
	} 


document.getElementById("mybtn1").addEventListener("click", myFunction);
function myFunction() {

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
		
		
        
    }
};
xmlhttp.open("GET", "RaiseTable.php", true);
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
		