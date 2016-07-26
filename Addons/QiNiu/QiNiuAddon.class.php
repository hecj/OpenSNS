<?php

namespace Addons\QiNiu;

use Common\Controller\Addon;

class QiNiuAddon extends Addon
{
    public $info = array(
        'name' => 'QiNiu',
        'title' => '七牛云存储',
        'description' => '七牛云存储',
        'status' => 1,
        'author' => '駿濤',
        'version' => '1.0.0'
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
     * uploadDriver  上传驱动，必需，用于确定插件是否是上传驱动
     * @return bool
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public function uploadDriver()
    {
        return true;
    }

    /**
     * uploadConfig   获取上传驱动的配置
     * @return array
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public function uploadConfig()
    {
        $config = $this->getConfig();
        return $uploadConfig = array(
            'accessKey' => $config['accessKey'],
            'secrectKey' => $config['secrectKey'],
            'bucket' => $config['bucket'],
            'domain' => $config['domain'],
            'timeout' => 3600,
        );
    }


    /**
     * uploadDealFile   处理上传参数
     * @param $file
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public function uploadDealFile(&$file)
    {
        $file['qiniu_key'] = str_replace('./', '', $file['rootPath']) . $file['savepath'] . $file['savename'];
    }

    /**
     * crop  裁剪图片
     * @param $path
     * @param $crop
     * @return string
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public function crop($path,$crop){
        //解析crop参数
        $crop = explode(',', $crop);
        $x = $crop[0];
        $y = $crop[1];
        $width = $crop[2];
        $height = $crop[3];
        $imageInfo = file_get_contents($path . '?imageInfo');
        $imageInfo = json_decode($imageInfo);
        //生成将单位换算成为像素
        $x = $x * $imageInfo->width;
        $y = $y * $imageInfo->height;
        $width = $width * $imageInfo->width;
        $height = $height * $imageInfo->height;
        $new_img = $path . '?imageMogr2/crop/!' . $width . 'x' . $height . 'a' . $x . 'a' . $y;
        //返回新文件的路径
        return $new_img;
    }

    /**
     * thumb  取缩略图
     * @param $path
     * @param string $width
     * @param string $height
     * @return string
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    public function thumb($path,$width='',$height=''){
        if(stripos($path,'imageMogr2') === false){
            $path = $path . '?imageView2/1/w/'.$width.'/h/'.$width;
        }else{
            $path = $path . '/thumbnail/' . $width . 'x' . $height . '!';
        }
        return $path;
    }


}