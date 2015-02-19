function getMyData(){
	return $.ajax({ 
                type: "GET",
                url: "serviceController",
                data: {service : 'getMyData'}
            }); 
}