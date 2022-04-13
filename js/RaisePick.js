function RaisePick() {
  var stateId = document.getElementById('collected').value
	var Rform = document.getElementById('Rf')
	let diva = document.createElement('div');
    var row = `<div class="fcf-form-group" id ="SellDiv">
				<label class="fcf-label" for="SellPrice">סכום איסוף כולל</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="SellPrice" id="SellPrice" value="" autocomplete="off">
				</div>
			</div>	
			`
			if(stateId == 1){
				 diva.innerHTML += row
				 insertAfter(Rform,diva)
			}
			else {
				el = document.getElementById("SellDiv");
				if(typeof(el) != 'undefined' && el != null){
				el.parentNode.removeChild(el);
					} 
					 
				
			}
					  
					 
}

function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
/*<div class="fcf-form-group">
				<label class="fcf-label" for="SellPrice">(אופציונלי)סכום איסוף כולל</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="SellPrice" id="SellPrice" value="<?php echo escape(Input::get('SellPrice'));  ?>" autocomplete="off">
				</div>
			</div>
			
			
			
			
			<div class="fcf-form-group">
				<label class="fcf-label" for="CollectDate">תאריך איסוף</label>
				<div class="fcf-input-group">
					<input type="date" class="fcf-form-control" name="CollectDate" id="CollectDate" value="<?php echo escape(Input::get('CollectDate'));  ?>" autocomplete="off">
				</div>
			</div>*/