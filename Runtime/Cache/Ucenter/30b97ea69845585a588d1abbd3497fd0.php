<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php echo hook('syncMeta');?>

<?php $oneplus_seo_meta = get_seo_meta($vars,$seo); ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo modC('WEB_SITE_NAME','OpenSNS开源社交系统','Config');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>

<!-- zui -->
<link href="/dev/opensns/Public/zui/css/zui.css" rel="stylesheet">

<link href="/dev/opensns/Public/zui/css/zui-theme.css" rel="stylesheet">
<link href="/dev/opensns/Public/css/core.css" rel="stylesheet"/>
<link href="/dev/opensns/Theme/T4/Common/Static/css/tiny.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/dev/opensns/Public/js/ext/magnific/magnific-popup.css"/>
<!--<script src="/dev/opensns/Public/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/js/com/com.functions.js"></script>

<script type="text/javascript" src="/dev/opensns/Public/js/core.js"></script>-->
<script src="/dev/opensns/Public/js.php?f=js/jquery-2.0.3.min.js,js/com/com.functions.js,js/core.js,js/com/com.toast.class.js,js/com/com.ucard.js"></script>

    <link href="/dev/opensns/Application/Ucenter/Static/css/center.css" rel="stylesheet" type="text/css"/>
    <link href="/dev/opensns/Application/Ucenter/Static/css/usercenter.css" rel="stylesheet" type="text/css"/>

<!--合并前的js-->
<?php $config = api('Config/lists'); C($config); $count_code=C('COUNT_CODE'); ?>
<script type="text/javascript">
    var ThinkPHP = window.Think = {
        "ROOT": "/dev/opensns", //当前网站地址
        "APP": "/dev/opensns/index.php?s=", //当前项目地址
        "PUBLIC": "/dev/opensns/Public", //项目公共目录地址
        "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
        "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        'URL_MODEL': "<?php echo C('URL_MODEL');?>",
        'WEIBO_ID': "<?php echo C('SHARE_WEIBO_ID');?>"
    }

    var weibo_comment_order = "<?php echo modC('COMMENT_ORDER',0,'WEIBO');?>";
</script>

<!-- Bootstrap库 -->
<!--
<?php $js[]=urlencode('/static/bootstrap/js/bootstrap.min.js'); ?>

&lt;!&ndash; 其他库 &ndash;&gt;
<script src="/dev/opensns/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/Core/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/static/jquery.iframe-transport.js"></script>
-->
<!--CNZZ广告管家，可自行更改-->
<!--<script type='text/javascript' src='http://js.adm.cnzz.net/js/abase.js'></script>-->
<!--CNZZ广告管家，可自行更改end-->
<!-- 自定义js -->
<!--<script src="/dev/opensns/Public/js.php?get=<?php echo implode(',',$js);?>"></script>-->


<script>
    //全局内容的定义
    var _ROOT_ = "/dev/opensns";
    var MID = "<?php echo is_login();?>";
    var MODULE_NAME="<?php echo MODULE_NAME; ?>";
    var ACTION_NAME="<?php echo ACTION_NAME; ?>";
    var CONTROLLER_NAME ="<?php echo CONTROLLER_NAME; ?>";
    var initNum = "<?php echo modC('WEIBO_NUM',140,'WEIBO');?>";
    function adjust_navbar(){
        /*$('#sub_nav').css('top',$('#nav_bar').height());*/
        /*$('#main-container').css('padding-top',$('#nav_bar').height()+20)*/
    }
</script>

<audio id="music" src="" autoplay="autoplay"></audio>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
</head>
<body>
	<!-- 头部 -->
	<script src="/dev/opensns/Public/js/com/com.talker.class.js"></script>
<?php if((is_login()) ): ?><a class="btn-pull" onclick="talker.show()"><i class="icon-chat-dot"> </i>
        <i id="friend_has_new"
        <?php $map_mid=is_login(); $modelTP=D('talk_push'); $has_talk_push=$modelTP->where("(uid = ".$map_mid." and status = 1) or (uid = ".$map_mid." and status =
            0)")->count(); $has_message_push=D('talk_message_push')->where("uid= ".$map_mid." and (status=1 or status=0)")->count(); if($has_talk_push || $has_message_push){ ?>
        style="display: inline-block"
        <?php } ?>
        ></i>

    </a>

    <div id="talker">

    </div>
    <?php else: ?>
    <div id="right_panel" class="friend_panel visible-md visible-lg" style="display: none;">
        <a class="btn-pull" onclick="toast.error('请登陆后使用好友面板。')"> <i class="icon-chat-dot"> </i>
        </a>
    </div><?php endif; ?>

<?php D('Member')->need_login(); ?>
<!--[if lt IE 8]>
<div class="alert alert-danger" style="margin-bottom: 0">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a target="_blank"
                                                                                                href="http://browsehappy.com/">更换一个更好的浏览器</a>
    来提升用户体验.
</div>
<![endif]-->

<?php $unreadMessage=D('Common/Message')->getHaventReadMeassageAndToasted(is_login()); ?>

<div id="nav_bar" class="nav_bar">

    <div class="container">

        <nav class="" id="nav_bar_container">
            <?php $logo = get_cover(modC('LOGO',0,'Config'),'path'); $logo = $logo?$logo:'/dev/opensns/Public/images/logo.png'; ?>

            <a class="navbar-brand logo" href="<?php echo U('Home/Index/index');?>"><img src="<?php echo ($logo); ?>"/></a>
            <div class="" id="nav_bar_main">

                <ul class="nav navbar-nav navbar-left">
                    <?php $__NAV__ = D('Channel')->lists(true);$__NAV__ = list_to_tree($__NAV__, "id", "pid", "_"); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav['_']) != ""): ?><li class="dropdown">
                                <a title="<?php echo ($nav["title"]); ?>" class="dropdown-toggle nav_item" data-toggle="dropdown"
                                   href="#"><i
                                        class="icon-<?php echo ($nav["icon"]); ?> app-icon"></i> <?php echo ($nav["title"]); ?> <i
                                        class="icon-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if(is_array($nav["_"])): $i = 0; $__LIST__ = $nav["_"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subnav): $mod = ($i % 2 );++$i;?><li role="presentation"><a role="menuitem" tabindex="-1"
                                                                   style="color:<?php echo ($subnav["color"]); ?>"
                                                                   href="<?php echo (get_nav_url($subnav["url"])); ?>"
                                                                   target="<?php if(($subnav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><i
                                                class="icon-<?php echo ($subnav["icon"]); ?>"></i> <?php echo ($subnav["title"]); ?>
                                        </a>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <?php else: ?>
                            <li class="<?php if((get_nav_active($nav["url"])) == "1"): ?>active<?php else: endif; ?>">
                                <a title="<?php echo ($nav["title"]); ?>" href="<?php echo (get_nav_url($nav["url"])); ?>"
                                   target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><i
                                        class="icon-<?php echo ($nav["icon"]); ?> app-icon "></i>
                                    <span><?php echo ($nav["title"]); ?></span>
                                </a>
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!--登陆面板-->
                    <?php if(is_login()): ?><li class="dropdown"  style="border-right: #e5e6e7 1px solid;
  border-left: #e5e6e7 1px solid;">
                            <div></div>
                            <a id="nav_info" class="dropdown-toggle text-left" data-toggle="dropdown">
                                <img src="/dev/opensns/Theme/T4/Common/Static/images/ico-mes.png" ><span id="nav_bandage_count"
                                <?php if(count($unreadMessage) == 0): ?>style="display: none"<?php endif; ?>
                                class="label label-badge label-success"><?php echo count($unreadMessage);?></span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <li>
                                    <div class="clearfix header">
                                        <div class="col-xs-6 nav_align_left"><span
                                                id="nav_hint_count"><?php echo count($unreadMessage);?></span> 条未读
                                        </div>
                                    </div>
                                </li>
                                <li class="info-list">
                                    <div class="list-wrap">
                                        <ul id="nav_message" class="dropdown-menu-list scroller  list-data"
                                            style="width: auto;">
                                            <?php if(count($unreadMessage) == 0): ?><div style="font-size: 18px;color: #ccc;font-weight: normal;text-align: center;line-height: 150px">
                                                    暂无任何消息!
                                                </div>
                                                <?php else: ?>
                                                <?php if(is_array($unreadMessage)): $i = 0; $__LIST__ = $unreadMessage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
                                                        <a data-url="<?php echo ($message["url"]); ?>"
                                                           onclick="Notify.readMessage(this,<?php echo ($message["id"]); ?>)">
                                                           <h3 class="margin-top-0"> <i class="icon-bell"></i>
                                                            <?php echo ($message["title"]); ?></h3>
                                                            <p> <?php echo ($message["content"]); ?></p>
                                                        <span class="time">

                                                         <?php echo ($message["ctime"]); ?>

                                                        </span>
                                                        </a>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                        </ul>
                                    </div>
                                </li>
                                <li class="footer text-right">
                                    <div class="btn-group">
                                        <button onclick="Notify.setAllReaded()" class="btn btn-sm  "><i
                                                class="icon-check"></i> 全部已读
                                        </button>
                                        <a class="btn  btn-sm  " href="<?php echo U('ucenter/Message/message');?>">
                                            查看消息
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"  style="border-right: #e5e6e7 1px solid;">
                            <?php $common_header_user = query_user(array('nickname')); ?>
                            <a role="button" class="dropdown-toggle dropdown-toggle-avatar" data-toggle="dropdown">
                                <img src="/dev/opensns/Theme/T4/Common/Static/images/ico-set.png">
                            </a>
                            <ul class="dropdown-menu text-left" role="menu">

                                <li><a href="<?php echo U('ucenter/Index/index');?>"><span
                                        class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;个人主页</a>
                                </li>
                                <li><a href="<?php echo U('ucenter/Config/index');?>"><span
                                        class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;设置中心</a>
                                </li>
                                <li><a href="<?php echo U('ucenter/message/message');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;消息中心</a>
                                </li>
                                <li><a href="<?php echo U('ucenter/Collection/index');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;我的收藏</a>
                                </li>

                                <li><a href="<?php echo U('ucenter/Index/rank');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;我的头衔</a>
                                </li>
                                <?php $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); if(in_array('invite',$register_type)){ ?>
                                <li><a href="<?php echo U('ucenter/Invite/invite');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;邀请好友</a>
                                </li>
                                <?php } ?>

                                <?php echo hook('personalMenus');?>
                                <?php if(is_administrator()): ?><li><a href="<?php echo U('Admin/Index/index');?>" target="_blank"><span
                                            class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;管理后台</a></li><?php endif; ?>
                                <li><a event-node="logout"><span
                                        class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;注销</a>
                                </li>
                            </ul>
                        </li>
                        <li class="top_spliter "></li>
                        <?php else: ?>


                        <li class="top_spliter "></li>
                        <?php $open_quick_login=modC('OPEN_QUICK_LOGIN', 0, 'USERCONFIG'); $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); $only_open_register=0; if(in_array('invite',$register_type)&&!in_array('normal',$register_type)){ $only_open_register=1; } ?>
                        <script>
                            var OPEN_QUICK_LOGIN = "<?php echo ($open_quick_login); ?>";
                            var ONLY_OPEN_REGISTER = "<?php echo ($only_open_register); ?>";
                        </script>
                        <li class="">
                            <a data-login="do_login">登录</a>
                        </li>
                        <li class="">
                            <a data-role="do_register" data-url="<?php echo U('Ucenter/Member/register');?>">注册</a>
                        </li>
                        <li class="spliter "></li><?php endif; ?>
                </ul>

            </div>
            <!--导航栏菜单项-->

        </nav>
    </div>
</div>

<!--换肤插件钩子-->
<?php echo hook('setSkin');?>
<!--换肤插件钩子 end-->
<a id="goTopBtn"></a>
<?php if(is_login()&&(get_login_role_audit()==2||get_login_role_audit()==0)){ ?>
<div class="alert alert-danger" style="margin-bottom: 0">您当前登录的 <strong>角色</strong>还未通过审核或被禁用。
    <a target="_blank" href="<?php echo U('ucenter/config/role');?>">更换其它角色登录</a>
</div>
<?php } ?>
<!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->


	<!-- /头部 -->
	
	<!-- 主体 -->
	
<div id="main-container" class="container">
    <script>
    </script>
    <div class="row" >
        
    <div class="col-xs-12 usercenter">
        <div class="uc">
            <div class="uc_top_bg">
    <?php if($user_info['cover_id']): ?><img class="uc_top_img_bg" src="<?php echo ($user_info['cover_path']); ?>" style="width: 100%;height: 100%">
        <?php else: ?>
        <img class="uc_top_img_bg" src="/dev/opensns/Application/Ucenter/Static/images/user_top_default_bg.jpg" style="width: 100%;height: 100%"><?php endif; ?>
    <?php if(is_login() && $user_info['uid'] == is_login()): ?><div class="change_cover"><a data-type="ajax" data-url="<?php echo U('Ucenter/Public/changeCover');?>" data-toggle="modal" data-title="上传个人封面" style="color: white;"><img class="img-responsive" src="/dev/opensns/Application/Core/Static/images/fractional.png"></a>
        </div><?php endif; ?>
</div>
<div class="row uc_info">
    <div class="col-xs-3">
        <dl>
            <dt>
                <a href="<?php echo ($user_info["space_url"]); ?>" title="">
                    <img src="<?php echo ($user_info["avatar128"]); ?>" class="avatar-img img-responsive top_img"/>
                </a>
            </dt>
            <dd>
                <div>
                    <div class="col-xs-6 text-center">
                        <a href="<?php echo U('Ucenter/Index/fans',array('uid'=>$user_info['uid']));?>" title="粉丝数"><?php echo ($user_info["fans"]); ?></a><br>粉丝
                    </div>
                    <div class="col-xs-6 text-center">
                        <a href="<?php echo U('Ucenter/Index/following',array('uid'=>$user_info['uid']));?>" title="关注数"><?php echo ($user_info["following"]); ?></a><br>关注
                    </div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="col-xs-6">
        <div class="uc_main_info">
            <div class="uc_m_t_12 uc_m_b_12 uc_uname">
                <span>
                    <a ucard="<?php echo ($user_info["uid"]); ?>" href="<?php echo ($user_info["space_url"]); ?>" title=""><?php echo (htmlspecialchars($user_info["nickname"])); ?></a>
                </span>
                    <span>
                        <?php echo W('Common/UserRank/render',array($user_info['uid']));?>
            </span>
            </div>
            <div class="uc_m_b_12 text-more" style="width: 100%">个性签名：<span>
                <?php if($user_info['signature'] == ''): ?>还没想好O(∩_∩)O
                    <?php else: ?>
                    <attr title="<?php echo ($user_info["signature"]); ?>"><?php echo ($user_info["signature"]); ?></attr><?php endif; ?>
            </span></div>
            <div class="uc_m_b_12">
                <span class="uc_m_r_36">积分：<?php echo ($user_info["score"]); ?>&nbsp;&nbsp;
                </span>
            </div>
            <div class="uc_m_b_12"><span>等级：<?php echo ($user_info["title"]); ?></span></div>
            <?php if(!empty($user_info['tags'])): ?><div class="uc_m_b_12">
                    <span>
                        个人标签：
                        <?php if(is_array($user_info['tags'])): $i = 0; $__LIST__ = $user_info['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>&nbsp;<a href="<?php echo U('people/index/index',array('tag'=>$tag['id']));?>" class="label label-badge label-default"><?php echo ($tag["title"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                    </span>
                </div><?php endif; ?>
        </div>
    </div>
    <?php if(is_login() && $user_info['uid'] != get_uid()): ?><div class="col-xs-3">
            <div class="uc_follow">

                <?php echo W('Common/Follow/follow',array('follow_who'=>$user_info['uid']));?>
            </div>
        </div><?php endif; ?>
</div>
            <?php if(ACTION_NAME=='information'){ $tabClass['user_data'] = 'active'; } elseif(ACTION_NAME=='fans'||ACTION_NAME=='following'){ $tabClass['user_fans'] = 'active'; } elseif(ACTION_NAME=='rankverify'||ACTION_NAME=='rank'||ACTION_NAME=='rankverifyfailure'||ACTION_NAME=='rankverifywait'){ $tabClass['user_rank'] = 'active'; } else{ $tabClass[$type] = 'active'; } ?>
        <style>
            .nav.navbar-nav li a.active{
                background-color: #ffffff;
            }
        </style>
<nav class="navbar navbar-default uc_navbar" role="navigation">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if(is_array($appArr)): $i = 0; $__LIST__ = $appArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('appList',array('type'=>$key,'uid'=>$uid));?>"  class="<?php echo ($tabClass[$key]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li>
                <a href="<?php echo U('information',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_data"]); ?>">资料</a>
            </li>
            <li>
                <a href="<?php echo U('rank',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_rank"]); ?>">头衔</a>
            </li>
            <li>
                <a href="<?php echo U('photo',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_photo"]); ?>">相册</a>
            </li>
            <li>
                <a href="<?php echo U('following',array('uid'=>$uid));?>" class="<?php echo ($tabClass["user_fans"]); ?>">关注/粉丝</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

            <div class="row uc_content">
                <div class="col-xs-7">
                    <?php echo W($module.'/UcenterBlock/render',array('uid'=>$user_info['uid'],'page'=>$page,'tab'=>$tab));?>
                </div>
                <div class="col-xs-5 uc_other_link">
                    <div>
    <div class="uc_link_block clearfix col-xs-12">
        <div class="uc_link_top clearfix">
            <div class="uc_title">
                <?php if($uid == is_login()): ?>我<?php else: ?>TA<?php endif; ?>的关注(<?php echo ((isset($follow_totalCount) && ($follow_totalCount !== ""))?($follow_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('following',array('uid'=>$uid));?>">更多</a></div>
        </div>
        <div class="col-xs-12 uc_link_info">
            <?php if(is_array($follow_default)): $i = 0; $__LIST__ = $follow_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fl): $mod = ($i % 2 );++$i;?><div class="col-xs-3">
                    <dl>
                        <a href="<?php echo ($fl["user"]["space_url"]); ?>">
                            <dt><img style="width: 64px;height: 64px" ucard="<?php echo ($fl["user"]["uid"]); ?>" src="<?php echo ($fl["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fl["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fl["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($follow_default) == 0): ?><p style="text-align: center; font-size: 24px;">
                <br><br>
                暂无关注任何人哦～
                <br><br><br>
            </p><?php endif; ?>
        </div>

    </div>
    <div class="uc_link_block clearfix col-xs-12" style="margin-top: 10px;">
        <div class="uc_link_top clearfix">
            <div class="uc_title">
                <?php if($uid == is_login()): ?>我<?php else: ?>TA<?php endif; ?>的粉丝(<?php echo ((isset($fans_totalCount) && ($fans_totalCount !== ""))?($fans_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('fans',array('uid'=>$uid));?>">更多</a></div>
        </div>
        <div class="col-xs-12 uc_link_info">
            <?php if(is_array($fans_default)): $i = 0; $__LIST__ = $fans_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fs): $mod = ($i % 2 );++$i;?><div class="col-xs-3">
                    <dl>
                        <a href="<?php echo ($fs["user"]["space_url"]); ?>">
                            <dt><img style="width: 64px;height: 64px"  ucard="<?php echo ($fs["user"]["uid"]); ?>" src="<?php echo ($fs["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fs["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fs["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($fans_default) == 0): ?><p style="text-align: center; font-size: 24px;">
                <br><br>
                暂无粉丝哦～
                <br><br><br>
            </p><?php endif; ?>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	<div class="footer-bar ">

    <div class="container">
        <div class="row">
            <div class="col-xs-6">

                <div>
                    <?php echo modC('ABOUT_US','暂未设置','Config');?>
                </div>
                <div class="copyright" style=""><?php echo modC('COPY_RIGHT','暂未设置','Config');?>
                Powered by <a style="color: #888;" target="_blank" href="http://www.opensns.cn">OpenSNS</a>
                    备案号：<a href="http://www.miitbeian.gov.cn/" target="_blank">
                        <?php echo modC('ICP','暂未设置','Config');?> </a>
            </div>
            </div>
            <div class="col-xs-1">
                &nbsp;
            </div>
            <div class="col-xs-2">
                <ul class="friend-link">
                    <?php echo Hook('friendLink');?>
                </ul>
            </div>
            <div class="col-xs-2">
                <h2>关注我们</h2>

                <?php $qrcode=modC('QRCODE','暂未设置','Config'); ?>
                <img class="qrcode" src="<?php echo (getthumbimagebyid($qrcode,90,90)); ?>">
            </div>
        </div>
        <?php echo C('COUNT_CODE');?>
    </div>

</div>
<!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->

<script>
    $(window).resize(adjust_navbar).resize()

</script>
<!-- 为了让html5shiv生效，请将所有的CSS都添加到此处 -->
<link type="text/css" rel="stylesheet" href="/dev/opensns/Public/static/qtip/jquery.qtip.css"/>



<!--<script type="text/javascript" src="/dev/opensns/Public/js/com/com.notify.class.js"></script>-->

<!-- 其他库-->
<!--<script src="/dev/opensns/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/static/jquery.iframe-transport.js"></script>

<script type="text/javascript" src="/dev/opensns/Public/js/ext/magnific/jquery.magnific-popup.min.js"></script>-->
<!--CNZZ广告管家，可自行更改-->
<!--<script type='text/javascript' src='http://js.adm.cnzz.net/js/abase.js'></script>-->
<!--CNZZ广告管家，可自行更改end
 自定义js-->

<!--<script type="text/javascript" src="/dev/opensns/Public/js/ext/placeholder/placeholder.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/js/ext/atwho/atwho.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/zui/js/zui.js"></script>-->
<link type="text/css" rel="stylesheet" href="/dev/opensns/Public/js/ext/atwho/atwho.css"/>

<script src="/dev/opensns/Public/js.php?t=js&f=js/com/com.notify.class.js,static/qtip/jquery.qtip.js,js/ext/slimscroll/jquery.slimscroll.min.js,js/ext/magnific/jquery.magnific-popup.min.js,js/ext/placeholder/placeholder.js,js/ext/atwho/atwho.js,zui/js/zui.js&v=<?php echo ($site["sys_version"]); ?>.js"></script>
<script type="text/javascript" src="/dev/opensns/Public/static/jquery.iframe-transport.js"></script>

<script src="/dev/opensns/Public/js/ext/lazyload/lazyload.js"></script>



<!-- 用于加载js代码 -->

<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>

	<!-- /底部 -->
</body>
</html>