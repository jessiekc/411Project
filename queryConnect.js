var mysql = require('mysql');
var express=require('express');
var app =express();

var con = mysql.createConnection({
  host: "192.17.90.133",
  user: "momenttrip_yren",
  password: "qwer1234",
  database: "momenttrip_db"
  
});

con.connect(function(err) {
  if (err){
    console.log('error ??');
    return;
  }
  console.log("Connected!");
});


app.get('/',function(req, resp){
    //about mysql
    con.query("SELECT * FROM Flight_info",function(error, rows, fields){
       //callback
       if(error){
            console.log(error);
            return;
        }
        console.log('SUCESS!\n');
        console.log(rows[0]);
    });
})



app.listen(1337);


// con.query('SELECT * FROM Flight_info', function(err, results) {
//   if(err){
//     console.log(err);
//     return;
//   }
//   console.log(results);
// });

// con.query('INSERT INTO User VALUES ("aaa@illinois.edu","12345","Urbana","Pangzi")',function(err,results){
//   if(err){
//     console.log(err);
//     return;
//   }
//   console.log(results);
// });