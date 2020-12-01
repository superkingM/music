<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 2020/12/1
 * Time: 14:45
 */

namespace Conlink;


use GatewayWorker\Lib\Db;

class Song
{


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
                }else{
                    $currentSong = self::open();
                }
                return $currentSong;
            }
        }
        return false;
    }

    private static function getSongTime($path)
    {
        $song = new \getID3();
        $path = getcwd() . '\\Applications\\Song\\Web\\' . $path;
        $songAtt = $song->analyze($path);
        $end = ceil($songAtt['playtime_seconds']);
        return $end;
    }
}