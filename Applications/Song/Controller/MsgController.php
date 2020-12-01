<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 2020/11/30
 * Time: 15:05
 */

namespace Controller;


class MsgController
{
    public static function pong($data)
    {
        echo $data.PHP_EOL;
    }

    public static function msg($data)
    {
        echo $data.PHP_EOL;
    }
}