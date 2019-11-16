const express = require('express');
const app = express();
const port = process.env.PORT || 5000
const http = require('http');
const home = require('./public/home.js');


// tell it to use the public directory as one where static files live
app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

// set up a rule that says requests to "/math" should be handled by the
// handleMath function below
app.get('/', function (req, res){
	res.send('Hello World');
});

app.get('/calculateprice', setRate);

// start the server listening
app.listen(port, function() {
  console.log('Node app is running on port', port);
});


function setRate(request, response){
	var weight = parseFloat(request.query.weight);
	var type = request.query.mail_type;

	calculateRate(response, weight, type);
}

function calculateRate(response, weight, type){
	var price = 0;
	if(type == 'stamped'){
		if(weight <= 1){	
			price = 0.55;
		}else if(weight > 1 && weight <= 2){
			price = 0.70;
		}else if(weight > 2 && weight <= 3){
			price = 0.85;
		}else if(weight > 3 && weight <= 3.5){
			price = 1.00;
		}
	}else if(type == 'metered'){
		if(weight <= 1){	
			price = 0.50;
		}else if(weight > 1 && weight <= 2){
			price = 0.65;
		}else if(weight > 2 && weight <= 3){
			price = 0.80;
		}else if(weight > 3 && weight <= 3.5){
			price = 0.95;
		}
	}else if(type == 'envelopes'){
		price = 1.00;
		var i = 1;
		for(i = 2; i <= Math.ceil(weight); i++){
			price += 0.15;
		}
	}else{
		if(weight <= 4){
			price = 3.66;
		}else if(weight > 4 && weight <= 8){
			price = 4.39;
		}else if(weight > 9 && weight <= 12){
			price = 5.19;
		}else{
			price = 5.71;
		}
	}
	
	var p = price.toFixed(2);
	const params = {totalPrice: p, weight:weight};

	response.render('pages/price', params);
}
