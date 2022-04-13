function loadDocs(str) {
  if(str==" "){
    
    return;
	}
	else{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert("crew member deleted please refresh the page")
    }
  };
 
  xhttp.open("GET", "deleteCrew.php?q="+str, true);
  xhttp.send();
  }
  
}