/**
 * Created by Annatar on 2015/11/10.
 */

'use strict';
let mysql = require('./mysqlConfig').connection;
let config = require('./config').crawler_config;
let crawler = require('./crawler');

let limitSize = config.limit;
let timesSize = config.times;

let currentId = 0;
let currentTimes = 0;

/**
 * 回掉地狱
 * @param fromId
 */
let pushUsernames = fromId => {
    let arr = [];
    let sql = `SELECT username FROM users where id > ${fromId} LIMIT ${limitSize}`;
    let stat = mysql.query(sql);
    stat.on('result', row => {
            crawler.crawlerToGetDetail(row.username);
        });
    stat.on('end', () => {
        currentId += limitSize;
        currentTimes++;
        console.log('go one times');
        if (currentId <= timesSize) {
            pushUsernames(currentId);
        }else {
            console.log('normalize end without error');
        }
    });
};

(function () {
    pushUsernames(currentId);
})();


