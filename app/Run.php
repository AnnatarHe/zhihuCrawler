<?php
namespace Annatar;

use Annatar\Factory\Boot;

class Run
{
    static public function getUsers(): null
    {
        Boot::usersGetController()->addUsers();
    }

    /**
     * 用了swoole的多线程模块，跑起多线程看看效率吧
     *
     * 出了点儿问题，暂时还是走单线程吧。至少能拿到数据
     */
    static public function getDetail(): null
    {
//        for ($i = 0; $i < 3; $i++) {
//            (new \swoole_process(['Annatar\Run', 'getDetailAction']))->start();
//        }
        static::getDetailAction();

        echo 'the process is running, please wait';

    }

    static public function getDetailAction(): null
    {
        Boot::detailInfoGetController()->getDetails();
    }
}