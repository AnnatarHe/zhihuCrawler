/**
 * Created by Annatar on 2015/11/11.
 */

'use strict';

let http = require('http');

let mysql = require('./mysqlConfig');

let analysis = require('./analysis');

exports.crawlerToGetDetail = function (usernmae) {

    let options = {
        hostname: 'www.zhihu.com',
        port: 80,
        path: `/people/${usernmae}`,
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Upgrade-Insecure-Requests': '1',
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36'
        }
    };

    let req = http.request(options, function(res) {
        let html = '';
        // 404就退出，进入下一个循环
        if (res.statusCode == 404) return false;
        res.setEncoding('utf8');
        res.on('data', chunk => html += chunk);
        res.on('end', function() {
            let data = analysis.analysisData(html, usernmae);
            mysql.insertInfo(data);
        })
    });

    req.on('error', e => {
        console.log('problem with request: ' + e.message);
    });

// write data to request body
    req.write('');
    req.end();
}
