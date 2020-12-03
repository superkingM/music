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
     */
    public static function picksong($client_id, $data)
    {
        $name = self::getNick($client_id);
        $songNameHttp = "https://cdn.zerodream.net/netease/api.php?source=netease&types=search&name={$data}&count=10&pages=1";
        $songId = file_get_contents($songNameHttp);
        $songId = json_decode($songId, true);
        $songName = $songId[0]['name'];
        $songId = $songId[0]['id'];

        $db = Db::instance('sdb');
        $song = $db->select('*')->from('songs')->where("song_id={$songId}")->row();
        $songList = $db->select('*')->from('song_list')->where("song_id={$songId}")->row();
        if (!$song) {
            $songIdHttp = 'https://cdn.zerodream.net/netease/api.php?source=netease&types=url&id=' . $songId;
            $songUrl = json_decode(file_get_contents($songIdHttp), true)['url'];
            $filepath = getcwd() . '/Applications/Song/Web/song/' . $songName . '.mp3';
            $songData = file_get_contents($songUrl);
            file_put_contents($filepath, $songData);
            $songLrcHttp = 'https://music.163.com/api/song/lyric?os=pc&lv=-1&id=' . $songId;
            $songLrc = json_decode(file_get_contents($songLrcHttp), true);
            $songLrc = isset($songLrc['lrc']['lyric']) ? $songLrc['lrc']['lyric'] : '';
            $db->insert('songs')->cols(['name' => $songName, 'url' => 'song/' . $songName . '.mp3', 'lrc' => $songLrc, 'song_id' => $songId])->query();
            if (!$songList) {
                $db->insert('song_list')->cols(['name' => $songName, 'url' => 'song/' . $songName . '.mp3', 'lrc' => $songLrc, 'song_id' => $songId])->query();
            }
        } else {
            if (!$songList) {
                $db->insert('song_list')->cols(['name' => $song['name'], 'url' => $song['url'], 'lrc' => $song['lrc'], 'song_id' => $song['song_id']])->query();
            } else {
                Gateway::sendToClient($client_id, '{"type":"tips","data":"点歌失败列表已经存在"}');
            }
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