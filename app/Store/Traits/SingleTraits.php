<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 11:28
 */

namespace Annatar\Store\Traits;

use Annatar\Factory\Boot;
trait SingleTraits
{
    /**
     * @var \Annatar\TheInterfaces\DatabaseInterface
     */
    protected $db = null;

    static protected $instance = null;

    static public function getInstence() {

        if(is_null(static::$instance)){
            static::$instance = new self();
        }
        return static::$instance;
    }

    protected function __construct() {
        $this->db = Boot::DB();
    }
}