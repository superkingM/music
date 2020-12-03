<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */

//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static function onWorkerStart($worker)
    {
        if ($worker->name == "SongBusinessWorker") {
            //歌曲播放进度检测
            \Workerman\Timer::add(1, function () {
                $song = \Conlink\Song::taskSong();
                if ($song) {
                    $song = json_encode($song, JSON_UNESCAPED_UNICODE);
                    Gateway::sendToAll($song);
                    \Conlink\Song::songList();
                }

            });
            //删除过期切歌记录
            \Workerman\Timer::add(5, function () {
                \Conlink\Song::deleteSong();
            });
            //检测在线，无人在线暂停
            \Workerman\Timer::add(1,function (){
               \Conlink\Song::pauseSong();
            });
        }
    }


    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        \Conlink\Song::pauseSong();//在初始化歌曲之前更新歌曲状态
        $currentSong = \Conlink\Song::open();
        $music = json_encode($currentSong, JSON_UNESCAPED_UNICODE);
        Gateway::sendToClient($client_id, $music);
        \Conlink\Song::onlineCount();
        \Conlink\Song::onlineList();
        \Conlink\Song::songList();
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
        $msg = json_decode($message, true);
        $msgContro = "Controller\\MsgController::{$msg['type']}";
        // 向所有人发送 
//        Gateway::sendToAll("$client_id said $message\r\n");
        if (is_callable($msgContro)) {
            call_user_func_array($msgContro, [$client_id, $msg['data']]);
        }

    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        \Conlink\Song::onlineCount();
        \Conlink\Song::onlineList();
        \Conlink\Song::deleteUserSong($client_id);
    }
}
