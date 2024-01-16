Music
============
使用PHP workerman开发的在线同步点歌台，支持在线聊天和自由点歌

![image](https://github.com/superkingM/music/blob/main/Applications/Song/Web/pic/view.png)

使用控制器-》方法的形式去处理websocket客户端消息

功能特性
============

- [x] 支持在线点歌
- [x] 支持多人实时聊天
- [x] 支持投票切掉当前音乐
- [x] 无需登录，任何人都可以点歌

使用
============
导入song.sql,Song\Config\Db.php中进行配置数据库

在windows下直接双击start_for_win.bat

在linux下
> php start.php start

或守护进程

> php start.php start -d

- 因为点歌的接口已经失效，无法从网络获取到歌曲，目前默认的歌曲有：飞鸟和蝉、江南、曹操、小跳蛙，要想支持其他歌曲需要自己添加歌曲到数据库和对应MP3文件到对应文件夹

迭代历史
============
- 2024-01-16
    - 修复因点歌接口失效而无法点歌