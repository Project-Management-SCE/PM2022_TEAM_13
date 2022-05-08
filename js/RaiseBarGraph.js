
class bardata {
	 constructor(data) {
		this.h1=data[0].Aname+':רווחים לפי סוג גיוס';
		this.data=data;
		this.type = [];
		this.gain = [];
		this.collected = [];
		this.gains =[];
		
		
	  }
	  
	  
	  setType(){
		   for(var i=1;i<this.data.length;i++){
			   this.type.push(this.data[i].type);
		   }
	  }
	  setGain(){
		 
		   for(var i=1;i<this.data.length ;i++){
					this.gain.push( this.data[i].SellPrice- (this.data[i].amount* this.data[i].BuyPrice));
		   }
	  }
	  
	  setCollected(){
		   for(var i=1;i<this.data.length ;i++){
			   this.collected.push(this.data[i].collected);
		   }
	  }
	  setGains(){
		   for(var i=0;i<this.gain.length ;i++){
			   if(this.collected[i]==1)
					this.gains.push({x:this.type[i],y:this.gain[i]});
		   }
	  }

	  getGain(){
		  return this.gain;
	  }
	  getGains(){
		  return this.gains;
	  }
	  getH1(){
		  return this.h1;
	  }
	  
	  getType(){
		  return this.type;
	  }
	  
	init(){
		
		this.setType();
		this.setCollected();
		this.setGain();
		this.setGains();
	}
	
}


// document.getElementById("mybtn").addEventListener("click", myFunction);
function myFunction9(str) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
		data = JSON.parse(this.responseText);
		
		let Mydata = new bardata(data);
		Mydata.init();
		
		var chartdata = {
        labels: Mydata.getType(),
        datasets : [
          {
            label:Mydata.getH1() ,
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: Mydata.getGains()
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
xmlhttp.open("GET", "raisegraphNew.php?q="+str, true);
xmlhttp.send();
}