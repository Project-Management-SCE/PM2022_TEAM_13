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
    currentDate = addDays.call(currentDate, 5)
  }
  return dates
}

class linedata {
	 constructor(data) {
		this.h1=data[0].first_name+ ' '+data[0].last_name +':רווחי השקעות';
		this.h2=data[0].first_name+ ' '+data[0].last_name +':רווחי השקעות צפויים';
		this.data=data;
		this.type = [];//pname
		this.gain = [];//amount*gainper
		this.range = [];
		this.dates = [];
		this.collected = [];
		this.Culgain=[];
		this.estCulgain=[];
		this.gain2 = [];
		this.dates2=[];
		
	  }

	  
	  setRange(){

	  	  for(var i in this.data){
		  	
		  	if(this.data[i].payed==1){
		  		this.dates.push(getDates(new Date(this.data[i].date),new Date(this.data[i].Pend)))
		  		this.gain.push({amount: this.data[i].amount, Ret:((this.data[i].gainper/100)+1)*this.data[i].amount })

				if(this.data[i].collected==1){
					this.dates2.push(getDates(new Date(this.data[i].date),new Date(this.data[i].collectdate)))
					this.gain2.push({amount: this.data[i].amount, Ret:((this.data[i].gainper/100)+1)*this.data[i].amount })
				}
		  	}
		  	
			
		  }
		var size 
		
		var incr
		for(var i in this.dates){
			size = this.dates[i].length
			
			incr = (parseInt(this.gain[i].amount) + parseInt(this.gain[i].Ret))/(size-1)
			console.log(incr)
			for(var j in this.dates[i] ){
				if(j == 0){
					this.estCulgain.push({x:this.dates[i][j] , y:incr,inv : i ,st:1 , en : 0 , stAm:parseInt(this.gain[i].amount)})
				}
				else if (j==this.dates[i].length-1)	{
					this.estCulgain.push({x:this.dates[i][j] , y:incr,inv : i ,st:0 , en : 1 , stAm:parseInt(this.gain[i].amount)})
				}
				else{
						this.estCulgain.push({x:this.dates[i][j] , y:incr,inv : i ,st:0 , en : 0 , stAm:parseInt(this.gain[i].amount)})
				}
					
				
				

			}
		}
		this.estCulgain.sort(function (a, b) {
			return new Date(a.x).getTime() - new Date(b.x).getTime();
			});

		for(var i in this.dates2){
			size = this.dates2[i].length
			
			incr = (parseInt(this.gain2[i].amount) + parseInt(this.gain2[i].Ret))/(size-1)
			for(var j in this.dates2[i] ){
				if(j == 0){
					this.Culgain.push({x:this.dates2[i][j] , y:incr,inv : i ,st:1 , en : 0 , stAm:parseInt(this.gain2[i].amount)})
				}
				else if (j==this.dates[i].length-1)	{
					this.Culgain.push({x:this.dates2[i][j] , y:incr,inv : i ,st:0 , en : 1 , stAm:parseInt(this.gain2[i].amount)})
				}
				else{
						this.Culgain.push({x:this.dates2[i][j] , y:incr,inv : i ,st:0 , en : 0 , stAm:parseInt(this.gain2[i].amount)})
				}
					
				

			}
		}

		this.Culgain.sort(function (a, b) {
			return new Date(a.x).getTime() - new Date(b.x).getTime();
			});
		console.log(this.estCulgain)
		  console.log(this.Culgain)
	  }

	  
	  setEstCulgain(){
	  	var amount = 0
	  	var temp = []
		  for(var i in this.estCulgain){
		  		if(this.estCulgain[i].st==1){
		  			amount -=this.estCulgain[i].stAm
		  			
		  		}
		  		else {
					amount+= this.estCulgain[i].y
		  		}
		  	temp.push({x:this.estCulgain[i].x , y:amount})
		  	

		  }
		  this.estCulgain = temp
		   
	  }
	  setCulgain(){
	  	
	  	var amount = 0
	  	var temp = []
		  for(var i in this.Culgain){
		  		if(this.Culgain[i].st==1){
		  			amount -=this.Culgain[i].stAm
		  			
		  		}
		  		else {
					amount+= this.Culgain[i].y
		  		}

		  		temp.push({x:this.Culgain[i].x , y:amount})
		  		

		  }
		  this.Culgain = temp
		   
	  }
	  getRange(){
		  return this.range;
	  }
	  getGain(){
		  return this.gain;
	  }
	  getCulgain(){
		  return this.Culgain;
	  }
	  getEstCulgain(){
		  return this.estCulgain;
	  }
	  getH1(){
		  return this.h1;
	  }
	  getH2(){
		  return this.h2;
	  }
	  
	  
	 
	  
	init(){
		this.setRange();
		this.setCulgain();
		this.setEstCulgain();}
	
}

function myFunction1(id) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data2 = JSON.parse(this.responseText);
		let Mydata = new linedata(data2);
		Mydata.init();
		
		const data = {
        
        datasets: [{
            label: Mydata.getH1(),
            data:Mydata.getCulgain(),
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
			tension: 0.1,
            borderWidth: 1
        },
		{
            label: Mydata.getH2(),
            data:Mydata.getEstCulgain(),
            backgroundColor: "rgba(211, 72, 54, 0.75)",
            borderColor: "rgba(211, 72, 54, 1)",
            pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
            pointHoverBorderColor: "rgba(211, 72, 54, 1)",
			tension: 0.3,
			
            borderWidth: 3
        }
		
		
		]
    };
	
	const config = {
		labels:Mydata.getEstCulgain().x,
		type: 'line',
		data,
		options :{
			
     maintainAspectRatio: false,responsive: true,
			
			scales : {
				x : {
					suggestedMin:Mydata.getEstCulgain()[0].x,
					type : 'time' ,
					
					 ticks: {
			autoSkip: true,
			maxTicksLimit:10
			}
				},
				y :{
				suggestedMin: 0
				}
			}
		}
		
		
	};
	
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


		
let table = document.createElement('canvas');
		table.id="mycanvas";

		// Adding the entire table to the body tag
		document.getElementById('wrap').appendChild(table);
		


var ctx = document.getElementById("mycanvas");
const myChart = new Chart(ctx,config);
		
		
		
		
		   }
};
xmlhttp.open("GET", "InvestTable.php?q="+id, true);
xmlhttp.send();
}
