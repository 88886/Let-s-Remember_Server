-- 创建用户表
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
	`user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`username` varchar(255) NOT NULL COMMENT '用户账号',
	`password` varchar(255) NOT NULL COMMENT '用户密码',
	`nickname` varchar(255) COMMENT '用户昵称',
	`mobile` varchar(255) COMMENT '手机号',
	`email` varchar(255) COMMENT '邮箱',
	`integral` int(11) DEFAULT 100 COMMENT '积分',
	`recite_short` int(11) DEFAULT 0 COMMENT '单词类背诵数量',
	`recite_middle` int(11) DEFAULT 0 COMMENT '诗歌背诵数量',
	`recite_long` int(11) DEFAULT 0 COMMENT '长篇背诵数量',
	`create_time` bigint COMMENT '创建时间',
	`update_time` bigint COMMENT '修改时间',
	PRIMARY KEY(`user_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 创建素材表
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
	`material_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL COMMENT '标题',
	`path` varchar(255) NOT NULL COMMENT '存放路径',
	`upload_user_id` int(11) COMMENT '上传者ID',
	`download_count` int(11) DEFAULT 0 COMMENT '下载次数',
	`create_time` bigint COMMENT '创建时间',
	`update_time` bigint COMMENT '修改时间',
	PRIMARY KEY(`material_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 创建用户-素材关系表
DROP TABLE IF EXISTS `um`;
CREATE TABLE `um` (
	`um_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL COMMENT '用户ID',
	`material_id` int(11) NOT NULL COMMENT '素材ID',
	`create_time` bigint COMMENT '创建时间',
	`update_time` bigint COMMENT '修改时间',
	PRIMARY KEY(`um_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 创建用户成就表
DROP TABLE IF EXISTS `achieve`;
CREATE TABLE `achieve` (
	`achieve_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL COMMENT '用户ID',
	PRIMARY KEY(`achieve_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO user (username, password, nickname) values ('user0', '0', '用户0');
INSERT INTO user (username, password, nickname) values ('user1', '1', '用户1');
INSERT INTO user (username, password, nickname) values ('user2', '2', '用户2');
