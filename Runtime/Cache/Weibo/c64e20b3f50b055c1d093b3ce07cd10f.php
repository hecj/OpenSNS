<?php if (!defined('THINK_PATH')) exit();?><div class="common_block_border" style="margin-top: 0">
    <div class="common_block_title"><?php echo ($title); ?></div>
    <ul class="userList clearfix">
        <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><li style="text-align: center">
                <a href="<?php echo ($u["user"]["space_url"]); ?>"><img ucard="<?php echo ($u["id"]); ?>" class="avatar-img " style="width: 64px;height: 64px" src="<?php echo ($u["user"]["avatar64"]); ?>"/></a>
                <br/><a href="<?php echo ($u["user"]["space_url"]); ?>" title="<?php echo (op_t($u["user"]["nickname"])); ?>" class="text-more" style="width: 100%"><?php echo (op_t($u["user"]["nickname"])); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>