<?php
namespace Annatar;

use Annatar\Factory\Boot;

class Run
{
    static public function getUsers() {
        Boot::usersGetController()->addUsers();
    }

    static public function getDetail() {
        Boot::detailInfoGetController()->getDetails();
    }
}