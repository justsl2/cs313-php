var http = require('http');
var url = require('url');

http.createServer(onRequest).listen(8888);

function onRequest(request, response) {
    var reqpath = url.parse(request.url, true);
    var filename = '.' + reqpath.pathname;
    if (reqpath.pathname === '/home') {
        response.writeHead(200, { 'Content-Type': 'text/html' });
        response.write('<h1>Welcome to the Home Page</h1>');
        console.log("home")
        response.end();
    } else if (reqpath.pathname === '/getData') {
        response.writeHead(200, { 'Content-Type': 'application/json' });
        var string = { "name": "Justin", "class": "cs313" };
        var json = JSON.stringify(string);
        response.write(json);
        console.log("getData")
        response.end();
    } else {
        response.writeHead(404, { "Content-Type": "text/html" });
        response.end();
    }    
    
}
console.log("Server is listening on port 8888")