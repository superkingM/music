Music
============
使用PHP workerman开发的在线同步点歌台，支持在线聊天和自由点歌

![image](https://github.com/superkingM/music/blob/main/Applications/Song/Web/pic/view.png)

使用控制器-》方法的形式去处理websocket客户端消息

使用
============
这里没有去使用redis，使用redis效果应该更好，不想麻烦就直接使用mysql数据库去处理了

导入song.sql,Song\Config\Db.php中进行配置数据库

在windows下直接双击start_for_win.bat

在linux下
>php start.php start

或守护进程

> php start.php start -d

特别鸣谢：
==============
- [🎵 PHP Swoole 开发的在线同步点歌台，支持自由点歌，切歌，调整排序，删除指定音乐以及基础权限分级](https://github.com/kasuganosoras/SyncMusic)
