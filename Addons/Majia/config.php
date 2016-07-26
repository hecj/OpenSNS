<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-2-28
 * Time: 下午2:14
 * @author 郑钟良<zzl@ourstu.com>
 */

return array(
    'uids'=>array(
        'title'=>'串通的用户id：(多个id用,分割)',
        'type'=>'textarea',
        'value'=>'1',//安装时有用，之后都是从数据库读取配置
    ),
    'addons_cache'=>array(
        'type'=>'hidden',
        'value'=>'MAJIA_ADDON_UIDS',
    )
);