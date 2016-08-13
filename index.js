var express = require('express');
var db = require('./db.js');
var bodyParser = require('body-parser');
var app = express();
var session = require('express-session');
var mongoStore = require('connect-mongo')(session);

var isProduction = false;

app.set('port', (process.env.PORT || 8000));

app.use(session({
  store: new mongoStore({
    mongooseConnection: db.connection,
    ttl: 3 * 24 * 60 * 60
  }),
  resave: true,
  saveUninitialized: false,
  secret : 'ilikeapple'
}));

app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({
    extended: true
}));

app.use(bodyParser.json());

app.get('/', function(req, res) {
  res.render('index', { isProduction: isProduction });
});

app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});
