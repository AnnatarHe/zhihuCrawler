/**
 * Created by Annatar on 2015/11/10.
 */

'use strict';

let http = require('http');
let redis = require('redis').createClient();
let mysql = require('./mysqlConfig');

redis.on("error", function (err) {
    console.log("Error " + err);
});


