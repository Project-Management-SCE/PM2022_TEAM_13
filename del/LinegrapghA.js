// Returns an array of dates between the two dates

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

$("#mybtn2").click(function(){
  $.ajax({
    url: "http://localhost/freelove/raisegraph.php",
    method: "GET",
    success: function(data2) {
      console.log(data2);
     var type = [];
	  var gain = [];
	  var range = [];
	  var dates =[];
	  var gains = [];
	  var gains2=[];
	  range=getDates(new Date(data2[data2.length-1].TargetStart), new Date(data2[data2.length-1].TargetEnd))
	  
	console.log(data2[data2.length-1].TargetStart);
	console.log(data2[data2.length-1].TargetEnd);
	/* for (var j in range){
		 j=new Date(j);
		 var d=date_str(j);
		 j=Date.UTC(d[0],d[1],d[2]);
		 
	 }*/
	  
	   console.log(range);
	  
      for(var i in data2) {
        
        type.push("raise type: "+data2[i].type);
		gain.push( data2[i].SellPrice- (data2[i].amount* data2[i].BuyPrice) );
		dates.push(new Date(data2[i].EndDate));
		
		
      }
	  console.log(dates);
	  console.log(gain);
	  
	  
	  var x= [];
	  for(let i=0;i<data2.length;i++) {	 
			for (var j in range){
				if(range[j]>=dates[i]){x.push({d:range[j],g:gain[i]});break;}
		}
	  }
	  
	  for (var j in range){
		//  if(range[3]<range[j])break;
		  var culgain=0;
		for(var i in x) {	 
			if(range[j]>=x[i].d)culgain+=x[i].g;
		}
		
		gains.push({x:range[j] , y:culgain});
		
	  }
	  
		for (var j in gains){
			if(gains[3].x<gains[j].x)break;
			gains2.push({x:gains[j].x,y:gains[j].y});
			
		}
		
		var he=data2[data2.length-1].Aname+': רווחי גיוסים צפויים';
		
		var he2=data2[data2.length-1].Aname+':רווחי גיוסים';
		console.log(gains2);
		
		
		const data = {
        
        datasets: [{
            label: he,
            data: gains,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
			tension: 0.1,
            borderWidth: 1
        },
		{
            label: he2,
            data: gains2,
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
		labels:range,
		type: 'line',
		data,
		options :{
			scales : {
				x : {
					type : 'time' ,
					time : {
						unit : 'month'
					}
				},
				y :{
			    //max:data2[data2.length-1].Target,
                //beginAtZero: true
				suggestedMin: 0,
                suggestedMax: data2[data2.length-1].Target
				}
			}
		}
		
		
	};
	
$("#mycanvas").remove();

$("#wrap").wrapInner( $("<canvas />", {
  "id" : "mycanvas"
}));
var ctx = $("#mycanvas");
const myChart = new Chart(ctx,config);
   
	  },
    error: function(data) {
      console.log(data);
    }
  });
});






