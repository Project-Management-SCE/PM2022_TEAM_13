
function getRaises(id) {

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data3 = JSON.parse(this.responseText);
		console.log(data3)
	var Rform = document.getElementById('first')
	let diva = document.createElement('div');
	diva.className ="fcf-form-group";
	diva.id ="second";


    var row = `<label class="fcf-label" for="Rid">גיוס</label>
				<div class="fcf-input-group">
    			<select onchange="insertSellPrice()" name="Rid" id="Rid" class="fcf-form-control" >
						<option id="firstOpt" value="a">בחר גיוס</option>
				</select>
				</div>
				`
			el = document.getElementById("Rid");
				//If it isn't "undefined" and it isn't "null", then it exists.
		    if(typeof(el) != 'undefined' && el != null){
		        el.parentNode.removeChild(el);
		        el = document.getElementById("second");
		        el.parentNode.removeChild(el);
		    } 
		    el = document.getElementById("Aid");
		    if(el.value=="a"){
		    	el = document.getElementById("second");
		    	if(typeof(el) != 'undefined' && el != null){
		    		 el.parentNode.removeChild(el);	
		    	}
		    	el = document.getElementById("third");
		    	if(typeof(el) != 'undefined' && el != null){
		    		 el.parentNode.removeChild(el);	
		    	}
		       
		    }else{

			diva.innerHTML += row
			insertAfter(Rform,diva)

		var firstOpt = document.getElementById('firstOpt')
		 for(var i = 0 ; i<data3.length ; i++){

				let opt = document.createElement('option');
				var option = `<option  value="${data3[i].id}">${data3[i].id}: ${data3[i].type} : מ${data3[i].StartDate} עד ${data3[i].CollectDate}</option> `
				opt.innerHTML += option
				insertAfter(firstOpt,opt)
		 }
		    } 
		    


    
			
				
			
		
		
        
    }
    

};
xmlhttp.open("GET", "getRaiseFromAmuta.php?id="+id, true);
xmlhttp.send();

}

function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function insertSellPrice(){

	let diva = document.createElement('div');
	diva.className ="fcf-form-group";
	diva.id ="third";
	var Rform = document.getElementById('second')

    var row = `<label class="fcf-label" for="SellPrice">סכום איסוף כללי</label>
				<div class="fcf-input-group">
    			<input type="text" class="fcf-form-control" name="SellPrice" id="SellPrice" value="" autocomplete="off">
				</div>
				`
			el = document.getElementById("SellPrice");
				//If it isn't "undefined" and it isn't "null", then it exists.
		    if(typeof(el) != 'undefined' && el != null){
		        el.parentNode.removeChild(el);
		        el = document.getElementById("third");
		        el.parentNode.removeChild(el);
		    } 
		    el = document.getElementById("Rid");
		    if(el.value=="a"){
		    	el = document.getElementById("third");
		    	if(typeof(el) != 'undefined' && el != null){
		    		 el.parentNode.removeChild(el);
		    	}
		       
		    } 
		    else{
		    	diva.innerHTML += row
			insertAfter(Rform,diva)
		    }

			


}