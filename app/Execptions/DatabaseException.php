<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 22:16
 */

namespace Annatar\Exceptions;


class DatabaseException extends \Exception
{
    public function __construct(array $errors) {
        echo '<pre>';
        echo '<span style="font-size: 3rem"> ERROR code:  </span><span style="colr:red">' . $errors[0] . '</span><br />\n';
        echo '<span style="font-size: 3rem"> ERROR info:  </span><span style="colr:red">' . $errors[2] . '</span><br />\n';
        echo '</pre>';
    }
}