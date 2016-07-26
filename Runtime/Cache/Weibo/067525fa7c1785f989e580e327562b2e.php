<?php if (!defined('THINK_PATH')) exit();?><div id="weibo_<?php echo ($weibo["id"]); ?>" <?php if($can_hide): ?>class="row top_can_hide"<?php else: ?>class="row"<?php endif; ?> <?php if($top_hide): ?>style="display:none"<?php endif; ?>>
    <div class="col-xs-12">
        <div class="col-xs-12 weibo_content" style="padding: 0;position:relative;">
            <div class="weibo_icon">
                <?php if(check_auth('Weibo/Index/setTop')): if(($weibo["is_top"]) == "0"): ?><li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="置顶<?php echo ($MODULE_ALIAS); ?>" data-role="weibo_set_top">
                            <i class="icon icon-arrow-up"></i>
                        </li>
                        <?php else: ?>
                        <li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="取消置顶" data-role="weibo_set_top">
                            <i class="icon icon-arrow-down"></i>
                        </li><?php endif; endif; ?>
                <?php if($weibo['can_delete']): ?><li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="删除<?php echo ($MODULE_ALIAS); ?>" data-role="del_weibo">
                        <i class="icon icon-trash"></i>
                    </li><?php endif; ?>
                <?php if($can_hide): ?><li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="隐藏置顶<?php echo ($MODULE_ALIAS); ?>" data-role="hide_top_weibo">
                        <i class="icon icon-eye-close"></i>
                    </li><?php endif; ?>
            </div>
            <div class="" style="padding: 10px 10px 5px 10px">
                <div class="col-xs-2 text-center" style="position: relative;padding: 0px">
                    <a class="s_avatar" href="<?php echo ($weibo["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["user"]["uid"]); ?>">
                        <img src="<?php echo ($weibo["user"]["avatar64"]); ?>" class="avatar-img" style="width: 64px;"/>
                    </a>
                </div>
                <div class="col-xs-10" style="padding: 5px">
                    <?php if(($weibo["is_top"]) == "1"): ?><div class="ribbion-green"></div><?php endif; ?>
                    <p>
                        <?php if(modC('SHOW_TITLE',1)): ?><small class="font_grey">【<?php echo ($weibo["user"]["title"]); ?>】</small><?php endif; ?>
                        <a ucard="<?php echo ($weibo["user"]["uid"]); ?>" href="<?php echo ($weibo["user"]["space_url"]); ?>" class="user_name">
                            <?php echo (htmlspecialchars($weibo["user"]["nickname"])); ?>
                        </a>
                        <?php echo W('Common/UserRank/render',array($weibo['uid']));?>

                    </p>
                    <div class="weibo_content_p">
                        <?php echo ($weibo["fetchContent"]); ?>
                    <span>
                        <a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a>
                    </span>
                        &nbsp;&nbsp;<span>来自 <?php if($weibo['from'] == ''): ?>网站端 <?php else: ?><strong><?php echo ($weibo["from"]); ?></strong><?php endif; ?></span>
                        <?php echo hook('report',array('type'=>$MODULE_ALIAS.'/'.$MODULE_ALIAS,'url'=>"Weibo/Index/weiboDetail?id=$weibo[id]",'data'=>array('weibo-id'=>$weibo['id'])));?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 weibo_content_bottom">
                <div class="col-xs-12" style="padding: 0px;text-align: center" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                    <?php $weiboCommentTotalCount = $weibo['comment_count']; ?>
                    <div class="col-xs-4"style="padding: 0px"><?php echo Hook('support',array('table'=>'weibo','row'=>$weibo['id'],'app'=>'Weibo','uid'=>$weibo['uid'],'jump'=>'weibo/index/weibodetail'));?></div>

<?php $sourceId =$weibo['data']['sourceId']?$weibo['data']['sourceId']:$weibo['id']; ?>
<a title="转发"  data-role="send_repost"  href="<?php echo U('Weibo/Index/sendrepost',array('sourceId'=>$sourceId,'weiboId'=>$weibo['id']));?>">转发 <?php echo ($weibo["repost_count"]); ?></a>


<div class=" col-xs-4" style="padding: 0px"><span class="cpointer" data-role="weibo_comment_btn"  data-weibo-id="<?php echo ($weibo["id"]); ?>">
    评论 <?php echo ($weiboCommentTotalCount); ?>
</span>
</div>
                </div>
            </div>
        </div>
        <div class="row weibo-comment-list"   <?php if(modC('SHOW_COMMENT',1)): ?>style="display: block;" <?php else: ?> style="display: none;"<?php endif; ?> data-weibo-id="<?php echo ($weibo["id"]); ?>">
            <?php if(modC('SHOW_COMMENT',1)): ?><div class="col-xs-12">
                <div class="light-jumbotron weibo-comment-block" style="padding: 1em 2em;">
                    <div class="weibo-comment-container">
                        <?php echo W('Weibo/Comment/someComment',array('weibo_id'=>$weibo['id']));?>
                    </div>
                </div>
            </div><?php endif; ?>

        </div>
    </div>
</div>
<script>
  // alert($('.weibo-comment-container').text());
</script>