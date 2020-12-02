/*
Navicat MySQL Data Transfer

Source Server         : yyy
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : song

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2020-12-02 16:34:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for current
-- ----------------------------
DROP TABLE IF EXISTS `current`;
CREATE TABLE `current` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `lrc` text,
  `start` bigint(20) DEFAULT NULL,
  `end` bigint(20) DEFAULT NULL,
  `current` int(10) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of current
-- ----------------------------
INSERT INTO `current` VALUES ('104', '飞鸟和蝉', 'song/飞鸟和蝉.mp3', '[00:29.739]来得及\n[00:32.769]我们只剩回忆\n[00:35.860]窗外风景有你的印记\n[00:42.531]晚风来的只留有遗憾\n[00:45.806]也不让它去宠爱\n[00:49.593]用一句话 没必要再为难\n[00:56.113]在这里\n[00:59.158]不过是场宿命\n[01:03.667]留不住的才用力抗拒\n[01:08.834]手心长出纠缠的曲线\n[01:12.030]情动以后不过一天\n[01:14.986]盛放的蔷薇 贪恋只是气味\n[01:21.120]你悄悄地飞远\n[01:23.793]我的心太卑浅\n[01:27.428]回不去的昨天\n[01:30.027]变成一道碎片\n[01:33.887]海岸线 映出我们之间回忆光点\n[01:42.424]海之角 不再遥远\n[01:47.172]你悄悄地飞远\n[01:51.186]我对你太亏欠\n[01:53.249]回不去的夏天\n[01:56.563]我对你的思念\n[02:00.298]海岸线 映出我们之间回忆碎片\n[02:08.719]海之角 不再遥远\n[02:13.910]想念\n[02:28.222]在这里\n[02:31.566]不过是场宿命\n[02:34.015]留不住的才用力抗拒\n[02:40.719]手心长出纠缠的曲线                                              情动以后不过一天\n[02:46.827]盛放的蔷薇 贪恋只是气味\n[02:47.450]情动以后不过一天\n[02:53.741]你悄悄地飞远\n[02:57.318]我的心太卑浅\n[02:58.915]回不去的昨天\n[03:02.604]变成一道碎片\n[03:05.954]海岸线 映出我们之间回忆光点\n[03:14.245]海之角 不再遥远\n[03:19.203]你悄悄地飞远\n[03:22.154]我对你太亏欠\n[03:25.440]回不去的夏天\n[03:28.512]我对你的思念\n[03:32.347]海岸线 映出我们之间回忆碎片\n[03:40.572]海之角 不再遥远\n[03:46.056]想念\n[03:49.294]你悄悄地飞远\n[03:52.840]我的心太卑浅\n[03:55.131]回不去的昨天\n[03:58.033]变成一道碎片\n[04:01.748]海岸线 映出我们之间回忆光点\n[04:09.777]海之角 不再遥远\n[04:15.020]你悄悄地飞远\n[04:17.974]我对你太亏欠\n[04:22.434]回不去的夏天\n[04:24.297]我对你的思念\n[04:28.157]海岸线 映出我们之间回忆碎片\n[04:35.672]海之角 不再遥远\n[04:41.913]想念\n', '1606896877', '1606897177', '0', '1');

-- ----------------------------
-- Table structure for songs
-- ----------------------------
DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `lrc` text,
  `song_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of songs
-- ----------------------------
INSERT INTO `songs` VALUES ('2', '体面', 'song/11.mp3', '[ti:体面]	\r\n[ar:于文文]	\r\n[al:电影《前任3：再见前任》插曲]	\r\n[by:果果1314]	\r\n\r\n[00:00.00]于文文 - 体面\r\n[00:02.00]电影《前任3：再见前任》插曲\r\n[00:04.00]作词：唐恬\r\n[00:06.00]作曲：于文文\r\n[00:08.00]演唱：于文文\r\n[00:10.00]编曲：郑楠\r\n[00:12.00]和声&和声设计：于文文\r\n[00:14.00]]歌词编辑：果果\r\n[00:16.00]QQ:765708831\r\n[00:18.00]爱歌词网：www.22lrc.com\r\n[00:20.00]\r\n[00:23.00]别堆砌怀念让剧情变得狗血\r\n[00:34.03]深爱了多年又何必毁了经典\r\n[00:42.92]都已成年不拖不欠\r\n[00:48.67]浪费时间是我情愿\r\n[00:54.28]像谢幕的演员\r\n[00:57.79]眼看着灯光熄灭\r\n[01:05.43]来不及再轰轰烈烈\r\n[01:11.15]就保留告别的尊严\r\n[01:16.79]我爱你不后悔\r\n[01:20.36]也尊重故事结尾\r\n[01:28.13]分手应该体面\r\n[01:31.39]谁都不要说抱歉\r\n[01:35.06]何来亏欠\r\n[01:37.23]我敢给就敢心碎\r\n[01:40.83]镜头前面是\r\n[01:42.99]从前的我们在喝彩\r\n[01:47.15]流着泪声嘶力竭\r\n[01:50.83]离开也很体面\r\n[01:53.86]才没辜负这些年\r\n[01:57.62]爱得热烈\r\n[01:59.51]认真付出的画面\r\n[02:03.33]别让执念毁掉了昨天\r\n[02:07.99]我爱过你利落干脆\r\n[02:12.48]\r\n[02:35.42]最熟悉的街主角却换了人演\r\n[02:46.95]我哭到哽咽\r\n[02:48.99]心再痛就当破茧\r\n[02:55.73]来不及再轰轰烈烈\r\n[03:01.35]就保留告别的尊严\r\n[03:06.99]我爱你不后悔\r\n[03:10.92]也尊重故事结尾\r\n[03:18.39]分手应该体面\r\n[03:21.52]谁都不要说抱歉\r\n[03:25.31]何来亏欠\r\n[03:27.12]我敢给就敢心碎\r\n[03:30.88]镜头前面是\r\n[03:33.13]从前的我们在喝彩\r\n[03:36.83]流着泪声嘶力竭\r\n[03:41.01]离开也很体面\r\n[03:43.92]才没辜负这些年爱得热烈\r\n[03:49.79]认真付出的画面\r\n[03:53.54]别让执念毁掉了昨天\r\n[03:58.26]我爱过你利落干脆\r\n[04:04.20]再见不负遇见\r\n[04:11.08]\r\n[10:00.00]LRC歌词下载：www.22lrc.com \r\n', null);
INSERT INTO `songs` VALUES ('3', '飞鸟和蝉', 'song/飞鸟和蝉.mp3', '[00:29.739]来得及\n[00:32.769]我们只剩回忆\n[00:35.860]窗外风景有你的印记\n[00:42.531]晚风来的只留有遗憾\n[00:45.806]也不让它去宠爱\n[00:49.593]用一句话 没必要再为难\n[00:56.113]在这里\n[00:59.158]不过是场宿命\n[01:03.667]留不住的才用力抗拒\n[01:08.834]手心长出纠缠的曲线\n[01:12.030]情动以后不过一天\n[01:14.986]盛放的蔷薇 贪恋只是气味\n[01:21.120]你悄悄地飞远\n[01:23.793]我的心太卑浅\n[01:27.428]回不去的昨天\n[01:30.027]变成一道碎片\n[01:33.887]海岸线 映出我们之间回忆光点\n[01:42.424]海之角 不再遥远\n[01:47.172]你悄悄地飞远\n[01:51.186]我对你太亏欠\n[01:53.249]回不去的夏天\n[01:56.563]我对你的思念\n[02:00.298]海岸线 映出我们之间回忆碎片\n[02:08.719]海之角 不再遥远\n[02:13.910]想念\n[02:28.222]在这里\n[02:31.566]不过是场宿命\n[02:34.015]留不住的才用力抗拒\n[02:40.719]手心长出纠缠的曲线                                              情动以后不过一天\n[02:46.827]盛放的蔷薇 贪恋只是气味\n[02:47.450]情动以后不过一天\n[02:53.741]你悄悄地飞远\n[02:57.318]我的心太卑浅\n[02:58.915]回不去的昨天\n[03:02.604]变成一道碎片\n[03:05.954]海岸线 映出我们之间回忆光点\n[03:14.245]海之角 不再遥远\n[03:19.203]你悄悄地飞远\n[03:22.154]我对你太亏欠\n[03:25.440]回不去的夏天\n[03:28.512]我对你的思念\n[03:32.347]海岸线 映出我们之间回忆碎片\n[03:40.572]海之角 不再遥远\n[03:46.056]想念\n[03:49.294]你悄悄地飞远\n[03:52.840]我的心太卑浅\n[03:55.131]回不去的昨天\n[03:58.033]变成一道碎片\n[04:01.748]海岸线 映出我们之间回忆光点\n[04:09.777]海之角 不再遥远\n[04:15.020]你悄悄地飞远\n[04:17.974]我对你太亏欠\n[04:22.434]回不去的夏天\n[04:24.297]我对你的思念\n[04:28.157]海岸线 映出我们之间回忆碎片\n[04:35.672]海之角 不再遥远\n[04:41.913]想念\n', '1474660964');
INSERT INTO `songs` VALUES ('4', '忘川彼岸（DJ完整版）', 'song/忘川彼岸（DJ完整版）.mp3', '[00:00.336]常泽浩 - 忘川彼岸（DJ完整版）\n[00:01.052]作曲：常泽浩\n[00:01.506]作词：常泽浩\n[00:01.826]编曲：李景豪\n[00:02.345]红色彼岸花\n[00:04.218]漫天飞舞飘洒\n[00:06.141]抚平心中焦虑的伤疤\n[00:09.852]漫天蝶舞飞沙\n[00:11.694]繁星乘风融洽\n[00:13.586]怎能奈何你却了无牵挂\n[00:17.504]红色彼岸花\n[00:19.277]漫天飞舞飘洒\n[00:21.102]抚平心中焦虑的伤疤\n[00:24.872]漫天蝶舞飞沙\n[00:26.740]繁星乘风融洽\n[00:28.580]怎能奈何你却了无牵挂\n[00:32.354]红色彼岸花\n[00:34.218]漫天飞舞飘洒\n[00:36.036]抚平心中焦虑的伤疤\n[00:39.844]漫天蝶舞飞沙\n[00:41.696]繁星乘风融洽\n[00:43.588]怎能奈何你却了无牵挂\n[00:47.522]红色彼岸花\n[00:49.238]漫天飞舞飘洒\n[00:51.094]抚平心中焦虑的伤疤\n[00:54.853]漫天蝶舞飞沙\n[00:56.719]繁星乘风融洽\n[00:58.602]怎能奈何你却了无牵挂\n[01:02.374]红色彼岸花\n[01:04.278]漫天飞舞飘洒\n[01:06.086]抚平心中焦虑的伤疤\n[01:09.940]漫天蝶舞飞沙\n[01:11.737]繁星乘风融洽\n[01:13.642]怎能奈何你却了无牵挂\n[01:18.564]红色彼岸花\n[01:20.300]漫天飞舞飘洒\n[01:22.204]抚平心中焦虑的伤疤\n[01:25.897]漫天蝶舞飞沙\n[01:27.735]繁星乘风融洽\n[01:29.620]怎能奈何你却了无牵挂\n[01:33.397]红色彼岸花\n[01:35.281]漫天飞舞飘洒\n[01:37.101]抚平心中焦虑的伤疤\n[01:40.877]漫天蝶舞飞沙\n[01:42.744]繁星乘风融洽\n[01:44.645]怎能奈何你却了无牵挂\n', '1486112063');

-- ----------------------------
-- Table structure for song_list
-- ----------------------------
DROP TABLE IF EXISTS `song_list`;
CREATE TABLE `song_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `lrc` text,
  `song_id` bigint(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of song_list
-- ----------------------------
INSERT INTO `song_list` VALUES ('4', '忘川彼岸（DJ完整版）', 'song/忘川彼岸（DJ完整版）.mp3', '[00:00.336]常泽浩 - 忘川彼岸（DJ完整版）\n[00:01.052]作曲：常泽浩\n[00:01.506]作词：常泽浩\n[00:01.826]编曲：李景豪\n[00:02.345]红色彼岸花\n[00:04.218]漫天飞舞飘洒\n[00:06.141]抚平心中焦虑的伤疤\n[00:09.852]漫天蝶舞飞沙\n[00:11.694]繁星乘风融洽\n[00:13.586]怎能奈何你却了无牵挂\n[00:17.504]红色彼岸花\n[00:19.277]漫天飞舞飘洒\n[00:21.102]抚平心中焦虑的伤疤\n[00:24.872]漫天蝶舞飞沙\n[00:26.740]繁星乘风融洽\n[00:28.580]怎能奈何你却了无牵挂\n[00:32.354]红色彼岸花\n[00:34.218]漫天飞舞飘洒\n[00:36.036]抚平心中焦虑的伤疤\n[00:39.844]漫天蝶舞飞沙\n[00:41.696]繁星乘风融洽\n[00:43.588]怎能奈何你却了无牵挂\n[00:47.522]红色彼岸花\n[00:49.238]漫天飞舞飘洒\n[00:51.094]抚平心中焦虑的伤疤\n[00:54.853]漫天蝶舞飞沙\n[00:56.719]繁星乘风融洽\n[00:58.602]怎能奈何你却了无牵挂\n[01:02.374]红色彼岸花\n[01:04.278]漫天飞舞飘洒\n[01:06.086]抚平心中焦虑的伤疤\n[01:09.940]漫天蝶舞飞沙\n[01:11.737]繁星乘风融洽\n[01:13.642]怎能奈何你却了无牵挂\n[01:18.564]红色彼岸花\n[01:20.300]漫天飞舞飘洒\n[01:22.204]抚平心中焦虑的伤疤\n[01:25.897]漫天蝶舞飞沙\n[01:27.735]繁星乘风融洽\n[01:29.620]怎能奈何你却了无牵挂\n[01:33.397]红色彼岸花\n[01:35.281]漫天飞舞飘洒\n[01:37.101]抚平心中焦虑的伤疤\n[01:40.877]漫天蝶舞飞沙\n[01:42.744]繁星乘风融洽\n[01:44.645]怎能奈何你却了无牵挂\n', '1486112063');
