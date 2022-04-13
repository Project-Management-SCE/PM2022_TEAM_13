
$( document ).ready(function() {
    
	 var data = { 
        };
        $.ajax({
          url: 'https://data.gov.il/api/3/action/datastore_search?resource_id=be5b7935-3922-45d4-9638-08871b17ec95&limit=5',
          data: data,
          dataType: 'jsonp',
          success: function(data) {
            alert('Total results found: ' + data.result.total)
          }
        });
	
});

