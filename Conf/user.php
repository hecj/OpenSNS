<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * UCenter客户端配置文件
 * 注意：该配置文件请使用常量方式定义
 */

define('UC_APP_ID', 1); //应用ID
define('UC_API_TYPE', 'Model'); //可选值 Model / Service
define('UC_AUTH_KEY', '87K2RNbQc65JjUAuzx4tWCqwESX1olPhegrMykis'); //加密KEY
define('UC_DB_DSN', 'mysqli://root:dxdiag@114.66.196.203:3306/opensns'); // 数据库连接，使用Model方式调用API必须配置此项
define('UC_TABLE_PREFIX', 'ocenter_'); // 数据表前缀，使用Model方式调用API必须配置此项
