/**
 * Created by Annatar on 2015/11/10.
 */
'use strict';
let mysql = require('mysql');

let MysqlConfig = require('./config').mysql_config;
let connection = mysql.createConnection(MysqlConfig);

exports.insertInfo = function (data) {
    let sql = 'INSERT IGNORE INTO informations SET ?';
    connection.query(sql, data, (err, res) => {
        if (err) console.log(`error at mysql insert detail ${err}`);
        return true;
    });
};

exports.connection = connection;