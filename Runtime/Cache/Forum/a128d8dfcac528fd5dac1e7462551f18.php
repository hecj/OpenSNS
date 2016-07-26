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
<!--Style-->
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
    <link type="text/css" rel="stylesheet" href="/dev/opensns/Application/Forum/Static/css/forum.css"/>
    <script type="text/javascript" src="/dev/opensns/Application/Forum/Static/js/common.js"></script>
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


<div id="sub_nav">
    <?php $logo = get_cover(modC('LOGO',0,'Config'),'path'); $logo = $logo?$logo:'/dev/opensns/Public/images/logo.png'; ?>

    <nav class="navbar navbar-default" >
        <div class="container"  style="width:1180px;">
            <a class="navbar-brand logo" href="<?php echo U('Forum/Index/index');?>"><i class="icon-comments"></i> <?php echo ($MODULE_ALIAS); ?></a>
            <ul class="nav navbar-nav navbar-left">
                <li id="tab_index">
                    <a href="<?php echo U('Forum/Index/index');?>">首页</a>
                </li>
                <li id="tab_lists"><a href="<?php echo U('forum/index/lists');?>">全部版块</a></li>
                <li id="tab_look"><a href="<?php echo U('forum/index/look');?>">随便看看</a></li>
                <!--<li><a>我的版块</a></li>-->
            </ul>
            <script>
                $('#tab_<?php echo ($tab); ?>').addClass('active');
            </script>
            <form class="navbar-form navbar-right" action="<?php echo U('Forum/Index/search');?>" method="post"
                  role="search">
                <div class="search-input-group">
                    <a type="submit" class="input-btn"><i class="icon-search"></i> </a>
                    <input type="text" name="keywords" class="input" placeholder="搜帖子">
                </div>
                </span>
            </form>
        </div>
    </nav>
</div>
<!-- /头部 -->

<!-- 主体 -->
<div id="main-container" class="">
    <div id="body-container" class="container  common-block">
        <link type="text/css" rel="stylesheet" href="/dev/opensns/Application/Forum/Static/css/forum.css"/>
<?php if(ACTION_NAME != 'edit'): endif; ?>
<?php if($forum_id == 0): else: ?>
    <div class="forum-header row ">
        <div class=" cover-header"><img class="cover" src="<?php echo ($forum["background"]); ?>"/>
            <img class="logo" src="<?php echo ($forum["logo"]); ?>"/>
        </div>
        <div class="content-block">
            <div class="title">
                <a href="<?php echo U('forum/index/forum',array('id'=>$forum['id']));?>" class=""><?php echo (op_t($forum["title"])); ?></a>

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="summary"><?php echo ($forum["description"]); ?></div>
                    <div class="count">
                        主题总数：<?php echo ($forum["topic_count"]); ?> &nbsp;&nbsp;&nbsp;
                        帖子总数：<?php echo ($forum["total_count"]); ?>
                    </div>
                </div>
                <div class="col-xs-3  text-right">
                    <?php if(($hasFollowed) == "0"): ?><button class="btn btn-primary btn-lg" onclick="forum.following(this)" data-id="<?php echo ($forum["id"]); ?>"><i class="icon-heart-empty"></i> <span>关注</span></button>
                        <?php else: ?>
                        <button class="btn btn-default btn-lg" onclick="forum.following(this)" data-id="<?php echo ($forum["id"]); ?>" ><i class="icon-heart"></i> <span>已关注</span></button><?php endif; ?>

                </div>
            </div>

        </div>

    </div><?php endif; ?>

        <div class="col-xs-9">

            <div class="container-fluid">
                
<script type="text/javascript" src="/dev/opensns/Application/Forum/Static/js/common.js"></script>
<div class="clearfix post_content">
<div class="col-xs-12  " style="background: white">
    <div style="margin-top: 15px"></div>
    <?php $user = query_user(array('avatar128','uid','nickname','space_url','rank_link','space_link'), $post['uid']); ?>
    <?php if($showMainPost): ?><div class="row" style="position: relative">
            <div class="forum_left_operation">
                <div class="text-right btn-toolbar " role="toolbar">
                    <div class="btn-group btn-group-vertical">
                        <?php if(check_auth('Forum/Index/editPost',get_expect_ids(0,0,$post['id'],0,1)) && $allow_publish): ?><a class="btn" title="编辑"
                               href="<?php echo U('Index/edit',array('post_id'=>$post['id']));?>">
                                <i class="forum_edit"></i>
                            </a><?php endif; ?>
                        <?php if(check_auth('Forum/Index/doReply',get_expect_ids(0,0,$post['id'],0,0))): ?><a class="btn" title="评论" href="#reply_form">
                                <i class="forum_reply"></i>
                            </a><?php endif; ?>
                        <?php if(check_auth('Forum/Index/delPost',get_expect_ids(0,0,$post['id'],0,0))): ?><a href="javascript:" class="btn del_post_btn" args="post_id=<?php echo ($post['id']); ?>">
                                <i class="icon-remove-sign" style="background: none;font-size: 19px;"></i>
                            </a><?php endif; ?>

                        <?php $hideStyle = 'display: none;'; $bookmarkStyle = $isBookmark ? $hideStyle : ''; $unbookmarkStyle = $isBookmark ? '' : $hideStyle; ?>
                        <a title="取消收藏" id="unbookmark_button" class="btn " style="<?php echo ($unbookmarkStyle); ?> padding-bottom: 2px"
                           href="<?php echo U('Index/doBookmark?add=0',array('post_id'=>$post['id']));?>">
                            <i class="forum_uncollect"></i></a>

                        <a title="收藏本帖" id="bookmark_button" class="btn " style="<?php echo ($bookmarkStyle); ?> padding-bottom: 2px"
                           href="<?php echo U('Index/doBookmark',array('post_id'=>$post['id']));?>"><i
                                class="forum_collect" ></i></a>

                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <p>
                    <a href="<?php echo ($user["space_url"]); ?>" ucard="<?php echo ($user["uid"]); ?>"><img src="<?php echo ($user["avatar128"]); ?>"
                                                                         class="avatar-img"/></a>
                </p>

                <p class="text-center">
                    <a href="<?php echo ($user["space_url"]); ?>" ucard="<?php echo ($user["uid"]); ?>"><?php echo (htmlspecialchars($user["nickname"])); ?></a>
                </p>

                <p class="text-center">
                    <?php echo W('Common/UserRank/render',array($user['uid']));?>
                </p>
            </div>
            <div class="col-xs-10 ">
                <div class="row">
                    <div style="position: relative">
                        <a class="ribbion-green">楼主</a>

                        <div style="padding: 10px"></div>
                        <div class="col-xs-12 post_title">
                            <h2><?php echo (op_t($post["title"])); ?>
                            </h2>

                            <div class="small sub_title">   <br/>
                                <a href="<?php echo ($user["space_url"]); ?>" ucard="<?php echo ($user["uid"]); ?>"
                                   class="text-primary"><?php echo ($user["nickname"]); ?></a>  <?php echo (time_format($post["create_time"])); ?> 发表在<a
                                    href="<?php echo U('Forum/Index/forum',array('id'=>$post['forum_id']));?>">【<?php echo ($post["forum"]["title"]); ?>】</a>  <?php echo Hook('support',array('app'=>'Forum',table=>'post','row'=>$post['id'],'uid'=>$post['uid'],'jump'=>'forum/index/detail'));?>
                            </div>
                        </div>

                    </div>
                </div>
                <div style="padding: 10px"></div>
                <div class="col-xs-12 main_content">
                    <?php echo (render(parse_at_users(parse_popup($post["content"])))); ?>
                </div>
                <div>


                    <br/>
                    <?php if($post['create_time'] != $post['update_time']): ?><p class="text-muted">
                            [最后编辑于 <?php echo (time_format($post['update_time'])); ?> ]
                        </p><?php endif; ?>
                </div>
                <div>
                    <?php echo W('Common/Share/detailShare');?>
                </div>

            </div>
        </div>

        <hr class="post_line"/><?php endif; ?>

    <?php if(is_array($replyList)): $k = 0; $__LIST__ = $replyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($k % 2 );++$k;?><div class="row" style="position: relative">
            <a id="<?php echo ($reply["id"]); ?>" style="margin-top: -100px;position: absolute;"></a>
            <?php if(($reply["uid"]) == $post['uid']): ?><a class="ribbion-green">楼主</a><?php endif; ?>

            <div class="col-xs-2">
                <p class="text-center">
                    <a ucard="<?php echo ($reply["uid"]); ?>" href="<?php echo ($reply["user"]["space_url"]); ?>"><img src="<?php echo ($reply["user"]["avatar128"]); ?>"
                                                                                class="avatar-img"/></a>
                </p>

                <p class="text-center">
                    <a ucard="<?php echo ($reply["uid"]); ?>" href="<?php echo ($reply["user"]["space_url"]); ?>"><?php echo ($reply["user"]["nickname"]); ?></a>
                </p>

                <p class="text-center">
                    <?php echo W('Common/UserRank/render',array($reply['uid']));?>
                </p>
            </div>
            <div class="col-xs-10">
                <div style="min-height: 10em;overflow: hidden;word-break: break-all" class="post_content">
                    <div style="padding: 15px"></div>
                    <?php echo (render(parse_at_users(parse_popup($reply["content"])))); ?>
                    <br/>
                </div>
                <p class="pull-right text-muted">
                    <?php echo getLou( $limit*($page-1)+$k+1);?>

                    发表于 <?php echo (time_format($reply["create_time"])); ?>
                    <?php if(check_auth('Forum/Index/delPostReply',get_expect_ids(0,$reply['id'],0,1))): ?><a href="javascript:" class="del_reply_btn" args="reply_id=<?php echo ($reply['id']); ?>">删除</a><?php endif; ?>
                    <?php if(check_auth('Forum/Index/doReplyEdit',get_expect_ids(0,$reply['id'],0,1))): ?><a href="<?php echo U('Index/editReply',array('reply_id'=>$reply['id']));?>">编辑</a><?php endif; ?>
                    <?php if(check_auth('Forum/Lzl/doSendLZLReply',get_expect_ids(0,$reply['id'],0,1))): ?><a href="javascript:" class="reply_btn" args="<?php echo ($reply['id']); ?>" id="reply_btn_<?php echo ($reply['id']); ?>">回复(<?php echo ($reply["lzl_count"]); ?>)</a>
                        <?php else: ?>
                        <a href="javascript:" onclick=" if(is_login()){toast.error('你无回复权限！！');}else{toast.error('请先登录！');}">回复(<?php echo ($reply["lzl_count"]); ?>)</a><?php endif; ?>

                </p>

                <div class="clearfix"></div>
                <div id="lzl_reply_div_<?php echo ($reply['id']); ?>"<?php if($reply['lzl_count'] == 0): ?>style="display:none"<?php endif; ?>>
                <?php echo W('LZLReply/LZLReply',array('to_f_reply_id'=>$reply['id'],'post_id'=>$post['id'],'reply_uid'=>$reply['uid'],'count'=>$reply['lzl_count']));?>
                </div>
            </div>
        </div>
        <hr class="post_line"/><?php endforeach; endif; else: echo "" ;endif; ?>

    <div class="row">
        <div class="col-xs-12">
            <pull class="pull-right">
                <?php echo getPagination($replyTotalCount);?>
            </pull>
        </div>
    </div>

    <br/>

    <!--发表回复-->
    <?php if(is_login()): if(check_auth('Forum/Index/doReply',get_expect_ids(0,0,$post['id'],0,0))): $user = query_user(array('avatar128')); $user['uid'] = get_uid(); ?>
            <div class="row">
                <div class="col-xs-2">
                    <p>
                        <a href="<?php echo ($user["space_url"]); ?>" ucard="<?php echo ($user["uid"]); ?>">
                            <img src="<?php echo ($user["avatar128"]); ?>" class="avatar-img"/></a>
                    </p>
                </div>
                <div class="col-xs-10">
                    <div id="reply_block">
                        <form id="reply_form" action="<?php echo U('doReply',array('post_id'=>$post['id']));?>" method="post"
                              class="ajax-form">
                            <h4>发表评论</h4>
                            <p>
                                <?php $config=''; ?>

                            </p>
                            <?php echo W('Common/Ueditor/editor',array('content','content','','100%','350px',$config));?>

                            <p class="pull-right" style="margin-top: 10px;">
                                <input type="submit" id="reply_button" class="btn btn-primary" value="发表 Ctrl+Enter"/>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <p class="text-center text-muted" style="font-size: 3em; padding-top: 2em; padding-bottom: 2em;">你没有评论权限~</p><?php endif; ?>
        <?php else: ?>
        <p class="text-center text-muted" style="font-size: 3em; padding-top: 2em; padding-bottom: 2em;">请<a
                href="<?php echo U('Ucenter/Member/login');?>">登录</a>后评论~</p><?php endif; ?>
</div>
</div>

<script>
    var SUPPORT_URL = "<?php echo addons_url('Support://Support/doSupport');?>";
    //点击收藏/取消收藏按钮
    $(function () {
        $.post(U('Core/Public/atWhoJson'),{},function(res){
            atwho_config = {
                at: "@",
                data: res,
                tpl: "<li data-value='@${nickname}'><img class='avatar-img' style='width:2em;margin-right: 0.6em' src='${avatar32}'/>${nickname}</li>",
                show_the_at: true,
                search_key: 'search_key',
                start_with_space: false
            };
        },'json')

        ue_content.addListener( 'ready', function( editor ) {
            $(this.document.body).atwho(atwho_config);
            //editor.setCursor();

        } );

        ue_content.addListener("beforeSubmit",function(){
            ue_content.sync();
            $("#reply_form").submit();
            return false;
        })





       /* var $inputor = $('#contentEditor').atwho(atwho_config);
*/
      /*  bindSupport();*/
        $('#bookmark_button, #unbookmark_button').click(function (e) {

            //取消默认操作
            e.preventDefault();

            //发送AJAX请求
            var button = $(this);
            var href = button.attr('href');
            var originalClass = $(this).attr('class');
            button.attr('class', 'btn');
            $.post(href, {}, function (a) {
                button.attr('class', originalClass);
                if (a.status) {
                    switchButtonVisibility();
                }
            });

            return false;
        });

        function switchButtonVisibility() {
            switchVisibility('#bookmark_button');
            switchVisibility('#unbookmark_button');
        }

        function switchVisibility(css) {
            var element = $(css);
            if (element.is(':visible')) {
                element.hide();
            } else {
                element.show();
            }
        }

        if ("<?php echo ($sr); ?>" != "") {
            $('#lzl_reply_list_<?php echo ($sr); ?>').load(U('Forum/Lzl/lzllist', ['to_f_reply_id', '<?php echo ($sr); ?>', 'page', '<?php echo ($sp); ?>'], true), function () {
                ucard();
            });
        }
    })


    $(document).ready(function () {


        $('.popup-gallery').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: '.popup',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function (item) {
                        /*           return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';*/
                        return '';
                    }
                }
            });
        });
    });
</script>
<style>
    .forum-first-block {
        background: white;
        box-shadow: 0 0 5px rgb(204, 204, 204);
        -moz-box-shadow: 0 0 5px #CCCCCC;
        -khtml-box-shadow: 0 0 5px #CCCCCC;
        margin-top: 15px;
    }
</style>
<script type="text/javascript" charset="utf-8" src="/dev/opensns/Public/static/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<link rel="stylesheet" type="text/css" href="/dev/opensns/Public/static/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css"/>
<script type="text/javascript">
    SyntaxHighlighter.all();
</script>

            </div>
        </div>
        <div class="col-xs-3">
            
            
                <div class="margin-bottom-15"></div>
<nav class="menu" data-toggle="menu">
    <?php if(check_auth('Forum/Index/addPost',get_expect_ids(0,0,0,forum_id,0))&&forumAllowCurrentUserGroup($forum_id)): ?><a class="btn btn-primary btn-md" href="<?php echo U('Index/edit',array('forum_id'=>$forum_id));?>"><i
                class="icon-edit"></i> 发表新帖</a><?php endif; ?>

    <?php $myForums=D('Forum')->getFollowForums(is_login()); ?>

    <ul class="nav nav-primary" style="background: #ffffff">
        <li class="show">
            <a href="#"><i class="icon-heart"></i> 我的关注</a>
            <ul class="nav">
                <?php if(is_array($myForums)): $i = 0; $__LIST__ = $myForums;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each_forum): $mod = ($i % 2 );++$i;?><li  class=""><a
                            href="<?php echo U('Index/forum',array('id'=>$each_forum['id']));?>" class=" "><i
                            class="icon-heart"></i> <?php echo (op_t($each_forum["title"])); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>

        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><li class=" show">
                <a href="#"><i class="icon-list-ul"></i> <?php echo ($type["title"]); ?></a>
                <ul class="nav">
                    <?php if(is_array($type["forums"])): $i = 0; $__LIST__ = $type["forums"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each_forum): $mod = ($i % 2 );++$i;?><li class="forum_<?php echo ($each_forum["id"]); ?>" class=""><a
                                href="<?php echo U('Index/forum',array('id'=>$each_forum['id']));?>" class=" "><i
                                class="icon-comment-alt"></i> <?php echo (op_t($each_forum["title"])); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
    <script>
        $('.forum_<?php echo ($forum_id); ?>').addClass('active')
    </script>
</nav>

<?php echo W('Event/RecommendEvent/recommendEvent');?>

<?php echo W('HotPost/lists',array('forum_id'=>$forum_id));?>


            

        </div>
    </div>

    
    <div class="container">
        <div class="row">
            <div class="col-xs-9">

            </div>
            <div class="col-xs-3">


            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(window).resize(function () {
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    });
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