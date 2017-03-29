function longpoll(urlIn, dataIn, callBack , typeIn, maxDelay){
	/*	set default values for optional parameters	*/
	typeIn = typeof typeIn !== "undefined" ? typeIn: "POST";	
	maxDelay = maxDelay || 20000;
		
	var sendRequest = function(){
		$.ajax({
			url: urlIn, 
			data: dataIn,
			type: typeIn,
			success: funcSuccess,
			error: funcError
		});
	};
	var funcSuccess = function(response){
		//log the response for debugging
		console.log("request success: "+response);
		//call the callback function
		callBack(response);
		//recursively call sendRequest function
		sendRequest();
	};
	var funcError = function(response){
		//log response for debugging 
		console.log("request failed: "+response);
		//send request again after delay
		setTimeout(poll, delay);
	};
	sendRequest();
}