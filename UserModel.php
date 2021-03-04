<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 20:33
 */

namespace emcode\phpmvc;


use emcode\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getFullName();
}