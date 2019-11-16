//index.js
const express = require('express')
const app = express()
const path = require('path')
const router = express.Router()
const port = process.env.PORT || 8888


app.set('views', __dirname + '/views');
// set the view engine to ejs
app.set('view engine', 'ejs');

app.use(express.static("public"))

//app.get('/', (req, res) => res.sendFile(path.join(__dirname+'/public/form.html')))

app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname+'/public/form.html'));
});

app.get('/getRate', function(req, res) {
        res.render('pages/getRate');
    });

app.listen(port, () => console.log(`Running on port ${port}!`))

//Model
let mail = "stamped";
let weight = 1;
console.log("1");
    function stampedRates(weight) {
        console.log("4")
        var price;
        if(weight < 1){
        console.log("5")
        price = 0.55;}
        else if(weight < 2)
        price = 0.70;
        else if(weight < 3)
        price = 0.85;
        else if(weight < 42.875 && weight > 3)
        price = 1.00;
        else {
            console.log("Weight is too heavy for metered envelopes.")
        }
        return price;
    }

    function meteredRates(weight) {
        var price;
        if(weight < 1)
        price = 0.50;
        else if(weight < 2)
        price = 0.65;
        else if(weight < 3)
        price = 0.80;
        else if(weight < 42.875 && weight > 3)
        price = 0.95;
        else {
            console.log("Weight is too heavy for metered envelopes.")
        }
        return price;
    }
    function flatsRates(weight) {
        var price;
        if(weight < 1)
        price = 1.00
        else if(weight < 2)
        price = 1.15
        else if(weight < 3)
        price = 1.30
        else if(weight < 4)
        price = 1.45
        else if(weight < 5)
        price = 1.60
        else if(weight < 6)
        price = 1.75
        else if(weight < 7)
        price = 1.90
        else if(weight < 8)
        price = 2.05
        else if(weight < 9)
        price = 2.20
        else if(weight < 10)
        price = 2.35
        else if(weight < 11)
        price = 2.50
        else if(weight < 12)
        price = 2.65
        else if(weight < 13)
        price = 2.80
        else {
            console.log("Weight is too heavy for packages")
        }
    return price;
        
    }

    function packageRates(weight) {
        var price;
        if(weight < 4)
        price = 3.66
        else if(weight < 8)
        price = 4.39
        else if(weight < 12)
        price = 5.19
        else if(weight < 13)
        price = 5.71
        else {
            console.log("Weight is too heavy for packages")
        }
        return price;
    }

    function calculatRate(mail, weight) {
        let rate;
        console.log("2")
        if (mail == "stamped") {
            console.log("3")
            rate = stampedRates(weight);
        }
        else if (mail == "metered") {
            rate = meteredRates(weight);
        }
        else if (mail == "flats") {
            rate = flatsRates(weight);
        }
        else if (mail == "package") {
            rate = packageRates(weight);
        }    
        else {
            console.log("error")
        }
        document.getElementById("result").innerHTML = rate; 
    }
