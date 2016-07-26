<?php if (!defined('THINK_PATH')) exit(); if($is_following && !$is_self){ ?>
<button type="button" class="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-default'); ?>" data-after="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-default'); ?>"  data-before="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-primary'); ?>" data-role="unfollow" data-follow-who="<?php echo ($follow_who); ?>" style="width: 65px">
    已关注
</button>
<?php }elseif(!$is_following && !$is_self){ ?>
<button type="button" class="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-primary'); ?>" data-after="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-default'); ?>"  data-before="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-primary'); ?>"  data-role="follow" data-follow-who="<?php echo ($follow_who); ?>" style="width: 65px">
    关注
</button>
<?php }else{ ?>
<button class="btn btn-primary" disabled="disabled" style="width: 65px">
    自己
</button>
<?php } ?>