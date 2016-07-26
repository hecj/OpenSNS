<?php if (!defined('THINK_PATH')) exit();?>
    <p class="word-wrap"><?php echo ($weibo["content"]); ?></p>

    <div class="triangle sanjiao" style="margin-left: 20px;border-bottom: 10px solid #e8e8e8;"></div>
    <div class="triangle_up sanjiao" style="margin-left: 20px;border-bottom: 10px solid #f1f1f1;"></div>
    <div  style="border: 1px solid #e8e8e8;padding: 10px;margin-bottom: 20px; background: #f1f1f1">
    <?php if(empty($weibo["source_weibo"]["uid"])): ?>原内容已删除
        <?php else: ?>
        <div>  <a ucard="<?php echo ($weibo["source_weibo"]["user"]["uid"]); ?>"     href="<?php echo ($weibo["source_weibo"]["user"]["space_url"]); ?>">@<?php echo (htmlspecialchars($weibo["source_weibo"]["user"]["nickname"])); ?></a></div>
        <?php echo ($weibo["source_weibo"]["fetchContent"]); ?>
        <span class="text-primary pull-left" style="font-size: 12px;"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['source_weibo']['id']));?>"><?php echo (friendlydate($weibo["source_weibo"]["create_time"])); ?></a>   </span>
        <span class="text-primary pull-right" style="font-size: 12px;"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['source_weibo']['id']));?>"> 原<?php echo ($MODULE_ALIAS); ?>转发（<?php echo ($weibo["source_weibo"]["repost_count"]); ?>）</a>  </span>
        &nbsp;<?php endif; ?>
    </div>
    <?php if($weibo['source_weibo']['uid']): ?><script>
            var html='<a href="<?php echo ($weibo["source_weibo"]["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["source_weibo"]["user"]["uid"]); ?>" style="position: absolute;margin-top: 32px;margin-left: -32px;"><img src="<?php echo ($weibo["source_weibo"]["user"]["avatar32"]); ?>"   class="avatar-img"   style="width: 32px;"/> </a>';
            $('#weibo_<?php echo ($weibo["id"]); ?>').find('.s_avatar').after(html);
        </script><?php endif; ?>