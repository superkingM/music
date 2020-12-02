<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 2020/12/1
 * Time: 14:45
 */

namespace Conlink;


use GatewayWorker\Lib\Db;
use GatewayWorker\Lib\Gateway;

class Song
{

    /**
     * 客户端连接初始化
     * @return array
     * @throws \Exception
     */
    public static function open()
    {
        $db = Db::instance('sdb');
        $currentSong = $db->select('*')->from('current')->row();
        if (!$currentSong) {
            $getSong = $db->select('*')->from('songs')->row();
            $end = self::getSongTime($getSong['url']);
            $currentSong = [
                'name' => $getSong['name'],
                'url' => $getSong['url'],
                'lrc' => $getSong['lrc'],
                'start' => time(),
                'status' => 1,
                'current' => 0,
                'end' => time() + $end
            ];
            $db->insert('current')->cols($currentSong)->query();
        } else {
            $currentSong['current'] = time() - $currentSong['start'];
        }
        $currentSong['type'] = 'music';
        return $currentSong;
    }

    /**
     * 定时器检测当前歌曲播放进度
     * @return array|bool
     * @throws \Exception
     */
    public static function taskSong()
    {
        $db = Db::instance('sdb');
        $currentSong = $db->select('*')->from('current')->row();
        $songList = $db->select('*')->from('song_list')->row();
        if ($currentSong) {
            $time = $currentSong['end'] - time();
            if ($time < 0) {
                $db->delete('current')->where("id={$currentSong['id']}")->query();
                if ($songList) {
                    $end = self::getSongTime($songList['url']);
                    $currentSong = [
                        'name' => $songList['name'],
                        'url' => $songList['url'],
                        'lrc' => $songList['lrc'],
                        'start' => time(),
                        'status' => 1,
                        'current' => 0,
                        'end' => time() + $end
                    ];
                    $db->insert('current')->cols($currentSong)->query();
                    $currentSong['type'] = 'music';
                    $db->delete('song_list')->where("id={$songList['id']}")->query();
                } else {
                    $currentSong = self::open();
                }
                return $currentSong;
            }
        }
        return false;
    }

    /**
     * 在线人数检测
     * @throws \Exception
     */
    public static function onlineCount()
    {
        $online = Gateway::getAllClientIdCount();
        if ($online > 0) {
            $data = json_encode(['type' => 'online', 'data' => $online], JSON_UNESCAPED_UNICODE);
            Gateway::sendToAll($data);
        }
    }

    /**
     * 在线列表
     * @throws \Exception
     */
    public static function onlineList()
    {
        $idList = Gateway::getAllClientIdList();
        $list = [];
        foreach ($idList as $item) {
            $getSession = Gateway::getSession($item);
            if (!$getSession || count($getSession) < 1) {
                $list = array_merge($list, [$item]);
            } else {
                $list = array_merge($list, [$getSession['name']]);
            }
        }

        $list = implode('<br>', $list);
        $data = json_encode(['type' => 'userlist', 'data' => $list], JSON_UNESCAPED_UNICODE);
        Gateway::sendToAll($data);
    }

    public static function songList()
    {
        $db = Db::instance('sdb');
        $songList = $db->select('*')->from('song_list')->query();
        $str = '';
        if (count($songList) > 0) {
            foreach ($songList as $song) {
                $str = $str . '<br>' . $song['name'];
            }
        }
        $data = json_encode(['type' => 'songlist', 'data' => $str], JSON_UNESCAPED_UNICODE);
        Gateway::sendToAll($data);
    }

    /**
     * 获取歌曲时间长度
     * @param $path
     * @return float|int
     * @throws \getid3_exception
     */
    private static function getSongTime($path)
    {
        $song = new \getID3();
        $path = getcwd() . '/Applications/Song/Web/' . $path;

        $songAtt = $song->analyze($path);

        if (isset($songAtt['error'])) {
            return 300;
        }
        $end = ceil($songAtt['playtime_seconds']);
        return $end;

    }
}