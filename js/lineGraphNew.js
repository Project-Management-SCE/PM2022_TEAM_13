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
    currentDate = addDays.call(currentDate, 15)
  }
  return dates
}

class linedata {
	 constructor(data) {
		this.h1=data[0].Aname+': רווחי גיוסים';
		this.h2=data[0].Aname+': רווחי גיוסים צפויים';
		this.start=data[0].TargetStart;
		this.end=data[0].TargetEnd;
		this.target=data[0].Target;
		this.data=data;
		this.type = [];
		this.gain = [];
		this.range = [];
		this.dates = [];
		this.collected = [];
		this.Culgain=[];
		this.estCulgain=[];
		
	  }
	  
	  setRange(){
		  this.range.push(this.start);
		  for(var i in this.dates){
			  this.range.push(this.dates[i]);
		  }
		  this.range.push(this.end);
	  }
	  setType(){
		   for(var i=1;i<this.data.length ;i++){
			   this.type.push("raise type: "+this.data[i].type);
		   }
	  }
	  setGain(){
		   for(var i=1;i<this.data.length ;i++){
				this.gain.push( this.data[i].SellPrice- (this.data[i].amount* this.data[i].BuyPrice));
		   }
		   
	  }
	  setDates(){
		   for(var i=1;i<this.data.length ;i++){
			   this.dates.push({d:new Date(this.data[i].CollectDate),v:this.gain[i-1],c:this.collected[i-1]});
		   }
		   this.dates.sort(function (a, b) {
			return a.d - b.d;
			});
		   
	  }
	  setCollected(){
		   for(var i=1;i<this.data.length ;i++){
			   this.collected.push(this.data[i].collected);
		   }
	  }
	  
	  setCulgain(){
		  var sum=0;
		  let x = getDates(new Date(this.start),new Date(this.dates[0].d));
		
		  for(var i in x){
			  this.Culgain.push({x:x[i],y:sum});
		  }
		  
		  for(var i=0;i<this.dates.length ;i++){
			  if(this.dates[i].c==1){
				  sum+=this.dates[i].v;
				 this.Culgain.push({x:this.dates[i].d,y:sum}); 
			  }
			  
		  }
		  
	  }
	  setEstCulgain(){
		  var sum=0;
		  let x = getDates(new Date(this.start),new Date(this.dates[0].d));
		  
		  for(var i in x){
			  this.estCulgain.push({x:x[i],y:sum});
		  }
		   console.log(this.dates);
		  for(var i=0;i<this.dates.length ;i++){
				 sum+=this.dates[i].v;
				 this.estCulgain.push({x:this.dates[i].d,y:sum}); 
			  
			  
		  }
		  
		  
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
	  getstart(){
		  return this.start;
	  }
	  getend(){
		  return this.end;
	  }
	  getTarget(){
		  return this.target;
	  }
	  getCollected(){
		  return this.collected;
	  }
	  
	init(){
		this.setCollected();
		this.setGain();
		this.setDates();
		this.setRange();
		this.setType();
		this.setCulgain();
		this.setEstCulgain();}
	
}

document.getElementById("mybtn2").addEventListener("click", myFunction);
function myFunction() {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data2 = JSON.parse(this.responseText);
		let Mydata = new linedata(data2);
		Mydata.init();
		console.log(Mydata.getGain());
		console.log(Mydata.getCollected());
		
		const data = {
        
        datasets: [{
            label: Mydata.getH2(),
            data: Mydata.getEstCulgain(),
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
			tension: 0.1,
            borderWidth: 1
        },
		{
            label: Mydata.getH1(),
            data: Mydata.getCulgain(),
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
		labels:Mydata.getRange(),
		type: 'line',
		data,
		options :{
			
     maintainAspectRatio: false,responsive: true,
			
			scales : {
				x : {
					suggestedMin:Mydata.getstart(),
                suggestedMax: Mydata.getend(),
					type : 'time' ,
					
					 ticks: {
			autoSkip: true,
			maxTicksLimit:12
			}
				},
				y :{
				suggestedMin: 0,
                suggestedMax: Mydata.getTarget()
				}
			}
		}
		
		
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
const myChart = new Chart(ctx,config);
		
		
		
		
		   }
};
xmlhttp.open("GET", "raisegraphNew.php", true);
xmlhttp.send();
}