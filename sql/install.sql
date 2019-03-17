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
	`create_time` bigint COMMENT '创建时间',
	`update_time` bigint COMMENT '修改时间',
	PRIMARY KEY(`user_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;