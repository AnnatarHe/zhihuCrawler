<?php
namespace Annatar;

use Annatar\Factory\Boot;

class Run
{
    static public function getUsers()
    {
        Boot::usersGetController()->addUsers();
    }

    /**
     * 用了swoole的多线程模块，跑起多线程看看效率吧
     */
    static public function getDetail()
    {
        for ($i = 0; $i < 3; $i++) {
            (new \swoole_process(['Annatar\Run', 'getDetailAction']))->start();
        }

        echo 'the process is running, please wait';

    }

    static public function getDetailAction()
    {
        Boot::detailInfoGetController()->getDetails();
    }
}