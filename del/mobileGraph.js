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

anychart.onDocumentReady(function () {

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
	/*for (var j in range){
		 j=new Date(j);
		 var d=date_str(j);
		 j=Date.UTC(d[0],d[1],d[2]);
		 
	 }*/
	  
	   console.log(range);
	  
      for(var i in data2) {
        
        type.push("raise type: "+data2[i].type);
		gain.push( data2[i].amount*(data2[i].SellPrice-data2[i].BuyPrice) );
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
		culgain*=100;
		gains.push({value:culgain , x:range[j]});
		
	  }
	  
		for (var j in gains){
			if(gains[3].x<gains[j].x)break;
			gains2.push({value:gains[j].y,x:gains[j].x});
			
		}
		
		var he=data2[data2.length-1].Aname+': רווחי גיוסים צפויים';
		
		var he2=data2[data2.length-1].Aname+':רווחי גיוסים';
		console.log(gains2);
		
		// chart type
  var chart = anychart.line();

  // chart title
  chart.title("רווחי גיוס");

  // create custom logarithmic scale
  var logScale = anychart.scales.log();
  logScale.minimum(1);

  // apply custom scale to y scale
  chart.yScale(anychart.scales.linear());

  // create custom Date Time scale
  var dateTimeScale = anychart.scales.dateTime();
  var dateTimeTicks = dateTimeScale.ticks();
  dateTimeTicks.interval(0, 1);

  // apply Date Time scale
  chart.xScale(dateTimeScale);
  
 
  var series = chart.line(gains);

  // adjust tooltips
  var tooltip = series.tooltip();
  tooltip.format(function () {
    var value = (this.value).toFixed(0);
    var date = new Date(this.x);
    var options = {year: "numeric", month: "numeric", day: "numeric"};
    var transformedDate =  date.toLocaleDateString("en-US", options);

    return "Value: " + value + " שקלים.\n" + transformedDate ;
  });

  // adjust axis labels
  var labels = chart.xAxis().labels();
  labels.hAlign("center");
  labels.width(60);
  labels.format(function(value){
    var date = new Date(value["tickValue"]);
    var options = {
      year: "numeric",
      month: "short"
    };
    return date.toLocaleDateString("en-UK", options);
  });

  // set container and draw chart
  $("#mycanvas").remove();
  chart.container("wrap");
  chart.draw();
		
	  },
    error: function(data) {
      console.log(data);
    }
  });


  
});