DROP TABLE IF EXISTS `gogo_user`;
CREATE TABLE `gogo_user` (
    `user_id`    int(11) UNSIGNED AUTO_INCREMENT COMMENT '用户ID',
    `user_name`  varchar(50)  UNIQUE KEY NOT NULL DEFAULT '' COMMENT '用户名',
    `user_pswd`  varchar(32)  NOT NULL DEFAULT '' COMMENT '用户密码',
    `salt`  varchar(32)       NOT NULL DEFAULT '' COMMENT '密码加盐',
    `face_img`   varchar(100) NOT NULL DEFAULT '' COMMENT '用户头像',
    `user_email` varchar(50)  NOT NULL DEFAULT '' COMMENT '邮箱地址',
    `name` 		 varchar(50)  NOT NULL DEFAULT '' COMMENT '姓名',
    `sex`  enum('0','1','2')  NOT NULL DEFAULT '0' COMMENT '0保密,1男,2女',
    `tel`    varchar(50)  	  NOT NULL DEFAULT '' COMMENT '电话',
    `adress` varchar(50)  	  NOT NULL DEFAULT '' COMMENT '家庭住址',
     PRIMARY KEY(user_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;