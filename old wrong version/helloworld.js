var http = require('http');
var fs = require('fs');
//var Plotly = require('./plotly-2.9.0.min.js')

http.createServer(function (req, res) {
  fs.readFile('chart (2).html', function(err, data) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write(data);
    return res.end();
  });
}).listen(8080);


setInterval(console.log(parseInt(document.getElementById("slider").value)), 100);