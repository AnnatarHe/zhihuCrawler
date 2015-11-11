/**
 * Created by Annatar on 2015/11/11.
 */
'use strict';

let cheerio = require('cheerio');

// 部分长句子的中文会被转义成html实体，所以要调用这个
var Entities = require('html-entities').AllHtmlEntities;

exports.analysisData = function(html, username) {
    let entities = new Entities();
    let $ = cheerio.load(html);
    let afterData = {};

    let gender = (function(){
        if ($('.gender').find('.icon').hasClass('icon-profile-male') ){
            return 'male';
        }else if( $('.gender').find('.icon').hasClass('icon-profile-female') ) {
            return 'female';
        }
    })();

    let bio = (function () {
        return $('.title-section').find('.bio').html() != null ?
            entities.decode($('.title-section').find('.bio').html()) :
            '';
    })();

    let attr = dom =>  {
        return $(`.${dom}`).attr('title') ?
            $(`.${dom}`).attr('title') :
            '';
    };

    let content = (function () {
        return $('.description.unfold-item').find('.content').html() != null ?
            entities.decode($('.description.unfold-item').find('.content').html()) :
            '';
    })();

    afterData.username = username;
    afterData.nickname = entities.decode( $('.title-section').find('.name').html() );
    afterData.bio = bio;
    afterData.location = attr('location');
    afterData.business = attr('business');
    afterData.gender = gender;
    afterData.education = attr('education');
    afterData.education_extra = attr('education-extra');
    afterData.content = content;
    afterData.agrees = $('.zm-profile-header-user-agree').find('strong').html();
    afterData.thanks = $('.zm-profile-header-user-thanks').find('strong').html();
    afterData.following = $('.zm-profile-side-following.zg-clear').children('a').eq(0).find('strong').html();
    afterData.followers = $('.zm-profile-side-following.zg-clear').children('a').eq(1).find('strong').html();

    return afterData;
};