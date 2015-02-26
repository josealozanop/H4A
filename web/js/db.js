function connect_DB(serviceName){
	return $.ajax({
                type: "GET",
                url: "./serviceController",
                data: {service : serviceName}
                /*success: function(msg){
					console.log(msg);
                },
				error : function(){
					console.log('ha habido un error');
				}*/
            }); // Ajax Call
}

