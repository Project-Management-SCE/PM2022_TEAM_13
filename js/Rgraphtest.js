function date_str(d){
	
var date = d.getDate();
var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
var year = d.getFullYear();
    
var dateStr = date + "/" + month + "/" + year;
	
return 	[date,month,year];
}

function getDates (startDate, endDate) {
  const dates = []
  let currentDate = startDate
  const addDays = function (days) {
	 
    const date = new Date(this.valueOf())
    date.setDate(date.getDate() + days)
    return date
  }
  while (currentDate <= endDate) {
    dates.push(currentDate)
    currentDate = addDays.call(currentDate, 20)
  }
  return dates
}



document.getElementById("mybtn").addEventListener("click", myFunction);
function myFunction() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);
		
		var type = [];
	  var gain = [];
	  var range = [];
	  var dates =[];
	  var gains = [];
	  range=getDates(new Date("2022-02-25"), new Date("2022-05-29"));
	  
	
	 for (var j in range){
		 j=new Date(j);
		 var d=date_str(j);
		 j=Date.UTC(d[0],d[1],d[2]);
		 
	 }
	  
	   
	  var culgain=0;
      for(var i in data) {
        
        /*type.push("raise type: "+data[i].type);
		gain.push( 100*data[i].amount*(data[i].SellPrice-data[i].BuyPrice) );
		dates.push(new Date(data[i].EndDate));*/
		gains.push({x:data[i].type,y:data[i].SellPrice- (data[i].amount* data[i].BuyPrice)})
		
      }
	  console.log(dates);
	  console.log(gain);
	  
	  /*var x;
	  for(let i=0;i<data.length;i++) {	 
			for (var j in range){
			
			if(dates[i]<range[j]){culgain+=gain[i];gain[i]=0; }
				x=culgain;
				gains.push({value:x,x:range[j]});		
			}
			
		}
		*/
		
		
		var chartdata = {
        labels: type,
        datasets : [
          {
            label: 'רווחים לפי סוג גיוס',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: gains
          }
        ]
      };
	
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
		
		
let table = document.createElement('canvas');
		table.id="mycanvas";

		// Adding the entire table to the body tag
		document.getElementById('wrap').appendChild(table);
		


var ctx = document.getElementById("mycanvas");

var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
		options:{maintainAspectRatio: false}
      });		
		
		
		
		   }
};
xmlhttp.open("GET", "raisegraph.php", true);
xmlhttp.send();
}