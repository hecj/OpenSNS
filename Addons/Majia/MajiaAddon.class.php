<?php
/**
 * 马甲插件
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-2
 * Time: 下午3:32
 * @author 郑钟良<zzl@ourstu.com>
 */
namespace Addons\Majia;
use Common\Controller\Addon;
require_once(ONETHINK_ADDON_PATH . 'Majia/Common/function.php');

class MajiaAddon extends Addon
{
    public $info = array(
        'name' => 'Majia',
        'title' => '马甲插件',
        'description' => '管理员可以切换多个账号登录',
        'status' => 1,
        'author' => '想天科技-zzl(郑钟良)',
        'version' => '0.1'
    );

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    /**
     * 设置skin钩子代码
     * @param $param 相关参数
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function personalMenus($param)
    {
        $uids=getMajiaUids();
        if(in_array(is_login(),$uids)){
            echo '<li>
                        <a data-type="ajax" data-url="'.addons_url('Majia://Majia/change').'" data-title="切换马甲！" data-toggle="modal">
                            <span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;切换马甲
                        </a>
                  </li>';
        }
    }
} 