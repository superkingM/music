<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 2020/11/30
 * Time: 15:05
 */

namespace Controller;


use Conlink\Song;
use GatewayWorker\Lib\Db;
use GatewayWorker\Lib\Gateway;

class MsgController
{
    /**
     * 心跳
     * @param $client_id
     * @param $data
     */
    public static function pong($client_id, $data)
    {
        echo $data . PHP_EOL;
    }

    /**
     * 发送聊天消息
     * @param $client_id
     * @param $data
     * @throws \Exception
     */
    public static function msg($client_id, $data)
    {
        $name = self::getNick($client_id);
        if ($data == '切歌') {
            self::changeSong($client_id);
        }
        $jsonData = json_encode(['type' => 'msg', 'data' => $name . ':' . $data], JSON_UNESCAPED_UNICODE);
        Gateway::sendToAll($jsonData);
    }

    /**
     * 设置昵称
     * @param $client_id
     * @param $data
     */
    public static function nick($client_id, $data)
    {
        Gateway::setSession($client_id, ['name' => $data]);
        Song::onlineList();
    }

    /**
     * 点歌
     * @param $client_id
     * @param $data
     * @return void
     * @throws \Exception
     */
    public static function picksong($client_id, $data)
    {
        $db = Db::instance('sdb');
        $song = $db->row("SELECT * FROM `songs` WHERE name like '%{$data}%' ");
        if ($song !== false) {
            $songList = $db->row("SELECT * FROM `song_list` WHERE name='{$song['name']}'");
            if ($songList === false) {
                $db->insert('song_list')
                    ->cols([
                        'name' => $song['name'],
                        'url' => $song['url'],
                        'lrc' => $song['lrc'],
                        'song_id' => $song['song_id']
                    ])
                    ->query();
            } else {
                Gateway::sendToClient($client_id, '{"type":"tips","data":"点歌失败列表已经存在"}');
            }
        } else {
            Gateway::sendToClient($client_id, '{"type":"tips","data":"此歌曲不存在，目前只有默认歌曲有：飞鸟和蝉、江南、曹操、小跳蛙"}');
        }
        Song::songList();
    }

    /**
     * 获取用户昵称
     */
    private static function getNick($client_id)
    {
        $name = Gateway::getSession($client_id);
        if ($name && count($name) > 0) {
            $name = $name['name'];
        } else {
            $name = $client_id;
        }
        return $name;
    }

    /**
     * 切歌
     */
    private static function changeSong($client_id)
    {
        $online = Gateway::getAllClientIdCount();
        $db = Db::instance('sdb');
        $current = $db->select('*')->from('current')->row();
        $change = $db->select('*')->from('change_song')->where("client_id='{$client_id}'")->row();
        if (!$change) {
            $db->insert('change_song')->cols(['current_id' => $current['id'], 'client_id' => $client_id])->query();
        }
        $changeList = $db->select('*')->from('change_song')->where("current_id={$current['id']}")->query();
        $count = count($changeList) * 3;
        if ($count > $online) {
            $db->update('current')->cols(['end' => time()])->where("id={$current['id']}")->query();
            $db->delete('change_song')->where("current_id={$current['id']}")->query();
        }

    }
}