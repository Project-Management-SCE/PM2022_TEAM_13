const data = {
        
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };
	
	const config = {
		type: 'line',
		data,
		options :{
			scales : {
				x : {
					type : 'time' ,
					time : {
						unit : 'day'
					}
				},
				y :{
                beginAtZero: true
				}
			}
		}
		
		
	};
var ctx = $("#mycanvas2");
const myChart = new Chart(ctx,config);

	  
	  
/*for(let i=0;i<data.length;i++) {	 
			for (var j in range){
			if(dates[i]>=j){culgain+=gain[i]; break;}	
			}

		gains.push({x:j ,y:culgain});	
		}
	  
	  
      var chartdata = {
		datasets: [
          {
            label: "gain",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            data: gains
          }
        ]
      };	  
	  
	  */