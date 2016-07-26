<?php if (!defined('THINK_PATH')) exit(); if(is_array($posts)): $i = 0; $__LIST__ = $posts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $user = query_user(array('avatar128','avatar64','nickname','uid','space_url'), $vo['uid']); ?>
<div class="clearfix">
    <div class="col-xs-2 text-center">
        <p>
            <a href="<?php echo ($user["space_url"]); ?>">
                <img src="<?php echo ($user["avatar64"]); ?>" ucard="<?php echo ($user["uid"]); ?>" class="avatar-img"/>
            </a>
        </p>
    </div>
    <div class="col-xs-10">
        <p>
            <a class="forum_forum_name" target="_blank" href="<?php echo U('Forum/Index/forum',array('id'=>$vo['forum_id']));?>">[<?php echo (text($vo["forum"]["title"])); ?>]</a>
            <a target="_blank"  class="forum-list-title-link" title="<?php echo (text($vo["title"])); ?>"
               href="<?php echo U('Index/detail',array('id'=>$vo['id']));?>"><?php echo (mb_substr(htmlspecialchars($vo["title"]),0,30,'utf-8')); ?>
            </a>
            <?php if(($document["is_top"]) == "2"): ?><span class="label label-badge label-danger">全站</span>
                <?php else: ?>
                <?php if(($document["is_top"]) == "1"): ?><span class="label label-badge label-info">版块</span><?php endif; endif; ?>
        </p>

        <p class="pull-right text-muted">
            <span>阅读（<?php echo ($vo["view_count"]); ?>）</span>
            <span style="width: 1em; display: inline-block;">&nbsp;</span>
            <span>回复（<?php echo ($vo["reply_count"]); ?>）</span>
        </p>

        <p class="text-muted author">
            <a href="<?php echo ($user["space_url"]); ?>" ucard="<?php echo ($user["uid"]); ?>"><?php echo (op_t($user["nickname"])); ?></a>
            发布：<?php echo (friendlydate($vo["create_time"])); ?> |
            回复：<?php echo (friendlydate($vo["last_reply_time"])); ?>
        </p>
    </div>
</div>


    <?php if($i != count($list)): ?><hr class="forum-list-hr"/>
        <?php else: ?>
        <div class="forum-list-no-hr"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>