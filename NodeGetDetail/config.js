/**
 * Created by Annatar on 2015/11/10.
 */
'use strict';

const MYSQL_CONFIG = {
    host     : 'localhost',
    user     : 'root',
    password : 'adminhele',
    database : 'zhihu',
    charset  : 'utf8'
};

const CRAWLER_CONFIG = {
    limit: 2
};

let detailUrl = '/people/excited-vczh';

exports.mysql_config = MYSQL_CONFIG;
exports.crawler_config = CRAWLER_CONFIG;