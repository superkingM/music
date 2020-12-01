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
            $song = new \getID3();
            $path = getcwd() . '\\Applications\\Song\\Web\\' . $getSong['url'];
            $songAtt = $song->analyze($path);
            $end = ceil($songAtt['playtime_seconds']);
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
        }else{
            $currentSong['current'] =time()-$currentSong['start'];
        }
        $currentSong['type'] ='music';
        return $currentSong;
    }
}