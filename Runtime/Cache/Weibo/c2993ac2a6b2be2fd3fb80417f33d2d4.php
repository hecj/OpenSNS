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
	
    <?php echo W('Common/SubMenu/render',array($sub_menu,$tab,array('icon'=>'quote-left'),''));?>


<div id="main-container" class="container">
    <script>
    </script>
    <div class="row" >
        
    <style>
        #main-container {
            width: 960px;
        }
    </style>
    <link href="/dev/opensns/Application/Weibo/Static/css/weibo.css" type="text/css" rel="stylesheet"/>
    <!--微博内容列表部分-->
    <div class="weibo_middle pull-left" style="width: 660px">
        <?php if($show_post): ?><div class="weibo_content weibo_post_box">

        <p class="pull-left">
            <?php echo modC('WEIBO_INFO',' 有什么新鲜事想告诉大家?');?>
        </p>
        <div class="pull-right show_num_quick">还可以输入<?php echo modC('WEIBO_NUM',140,'WEIBO');?>个字</div>
        <div class="weibo_content_p">
            <div class="row">
                <div class="col-xs-12">
                    <p><textarea class="form-control weibo_content_quick" id="weibo_content" style="height: 6em;"
                                 placeholder="写点什么吧～～" onfocus="startCheckNum_quick($(this))"
                                 onblur="endCheckNum_quick()"></textarea></p>
                    <a href="javascript:" onclick="insertFace($(this))">
                        <img class="weibo_type_icon" src="/dev/opensns/Application/Core/Static/images/bq.png"/>表情
                    </a>
                    <?php if(modC('CAN_IMAGE',1)): ?><a href="javascript:" id="insert_image" onclick="insert_image.insertImage(this)">
                        <img class="weibo_type_icon" src="/dev/opensns/Application/Weibo/Static/images/image.png"/>图片
                    </a><?php endif; ?>
                    
                    <?php if(modC('CAN_TOPIC',1)): ?><a href="javascript:" onclick="insert_topic.InsertTopic(this)">
                        <img class="weibo_type_icon" src="/dev/opensns/Application/Weibo/Static/images/topic.png"/>话题
                    </a><?php endif; ?>
                    <?php echo hook('weiboType');?>
                    <p class="pull-right">
                        <?php echo use_topic();?>
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" value="发表"  data-role="send_weibo" class="btn btn-primary btn-lg" style="border:none;width: 100px" data-url="<?php echo U('Weibo/Index/doSend');?>"/>
                    </p>
                </div>
            </div>
            <div>

             
                <!-- <form method="post" action="?s=weibo&c=Tiezi&a=doSendtiezi" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="157286400">
                    标题：<input type="text" name="title" value=""></br>
                    内容：<input type="text" name="content" value=""></br>
                    <input type="file" name="file" value="">
                    <input type="submit" value=" 发表内容">
                </form> -->
            </div>
            <div id="emot_content" class="emot_content"></div>
            <div id="hook_show" class="emot_content"></div>
        </div>
    </div>
    <script>
        var ID_setInterval;
        function checkNum_quick(obj) {
            var value = obj.val();
            var value_length = value.length;
            var can_in_num = initNum - value_length;
            if (can_in_num < 0) {
                value = value.substr(0, initNum);
                obj.val(value);
                can_in_num = 0;
            }
            var html = "还可以输入" + can_in_num + "个字";
            $('.show_num_quick').html(html);
        }
        function startCheckNum_quick(obj) {
            ID_setInterval = setInterval(function () {
                checkNum_quick(obj);
            }, 250);
        }
        function endCheckNum_quick() {
            clearInterval(ID_setInterval);
        }
    </script>
    <script type="text/javascript" charset="utf-8" src="/dev/opensns/Public/js/ext/webuploader/js/webuploader.js"></script>
    <link href="/dev/opensns/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet"><?php endif; ?>
<script>    

</script>


        <div>
            <?php echo hook('Advs', 'weibo_below_sendbox');?>
        </div>
        <!--  筛选部分-->

        <div>
            <?php if(!is_login()) $style='margin-top:0' ?>
            <div id="weibo_filter" style="margin-bottom: 10px;position: relative;<?php echo ($style); ?>">
                <div class="weibo_icon">
                    <?php $show_icon_eye_open=0; if(count($top_list)){ $hide_ids=cookie('Weibo_index_top_hide_ids'); if(mb_strlen($hide_ids,'utf-8')){ $hide_ids=explode(',',$hide_ids); foreach($top_list as $val){ if(in_array($val,$hide_ids)){ $show_icon_eye_open=1; break; } }}} if(count($top_list)){ if($show_icon_eye_open){ ?>
                    <li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="显示全部置顶<?php echo ($MODULE_ALIAS); ?>" data-role="show_all_top_weibo">
                        <i class="icon icon-eye-open"></i>
                    </li>
                    <?php }else{ ?>
                    <li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="显示全部置顶<?php echo ($MODULE_ALIAS); ?>" data-role="show_all_top_weibo" style="display: none;">
                        <i class="icon icon-eye-open"></i>
                    </li>
                    <?php }} ?>
                </div>
                <?php if(is_array($tab_config)): $i = 0; $__LIST__ = $tab_config;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><a id="<?php echo ($tab); ?>" href="<?php echo U('Weibo/Index/index',array('type'=>$tab));?>">
                        <?php if($tab == 'concerned'){ ?>
                        我的关注
                        <?php }elseif($tab == 'hot'){ ?>
                        热门<?php echo ($MODULE_ALIAS); ?>
                        <?php }else{ ?>
                        全站<?php echo ($MODULE_ALIAS); ?>
                        <?php } ?>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>
        <script>
            $('#weibo_filter #<?php echo ($filter_tab); ?>').addClass('active');
        </script>


        <!--筛选部分结束-->
        <div id="top_list">
            <?php if(is_array($top_list)): $i = 0; $__LIST__ = $top_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top): $mod = ($i % 2 );++$i; echo W('WeiboDetail/detail',array('weibo_id'=>$top,'can_hide'=>1)); endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div id="weibo_list">
            <?php if($page != 1){ ?>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('Weibo/WeiboDetail/detail',array('weibo_id'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>
<?php if(empty($lastId) == false): ?><script>
        weibo.lastId = '<?php echo ($lastId); ?>';
    </script><?php endif; ?>


            <?php } ?>

        </div>
        <div id="load_more" class="text-center text-muted"
        <?php if($page != 1): ?>style="display:none"<?php endif; ?>
        >
        <p id="load_more_text">载入更多</p>
    </div>
    <div id="index_weibo_page" style=" <?php if($page == 1): ?>display:none<?php endif; ?>">
        <div class="text-right">
            <?php echo getPagination($total_count,30);?>
        </div>
    </div>
    </div>

    <!--微博内容列表部分结束-->
    <!--首页右侧部分-->
    <div class="weibo_right" style="width: 280px">
        <!--登录后显示个人区域-->
        <?php if(is_login()): ?><div class="user-card">
                <div>
                    <div class="top_self">
                        <?php if($self['cover_id']): ?><img class="cover uc_top_img_bg_weibo" src="<?php echo ($self['cover_path']); ?>">
                            <?php else: ?>
                            <img class="cover uc_top_img_bg_weibo" src="/dev/opensns/Application/Core/Static/images/bg.jpg"><?php endif; ?>
                        <?php if(is_login() && $self['uid'] == is_login()): ?><div class="change_cover"><a data-type="ajax" data-url="<?php echo U('Ucenter/Public/changeCover');?>"
                                                         data-toggle="modal" data-title="上传个人封面" style="color: white;"><img
                                    class="img-responsive" src="/dev/opensns/Application/Core/Static/images/fractional.png" style="width: 25px;"></a>
                            </div><?php endif; ?>
                    </div>
                </div>
                <div class="user_info" style="padding: 0px;">
                    <div class="avatar-bg">
                        <div class="headpic ">
                            <a href="<?php echo ($self["space_url"]); ?>" ucard="<?php echo ($self["uid"]); ?>">
                                <img src="<?php echo ($self["avatar128"]); ?>" class="avatar-img" style="width:80px;"/>
                            </a>
                        </div>
                        <div class="clearfix " style="padding: 0;margin-bottom:8px">
                            <div class="clearfix">
                                <div class="col-xs-12" style="text-align: center">
                        <span class="nickname">
                            <?php echo ($self["title"]); ?>
                        <a ucard="<?php echo ($self["user"]["uid"]); ?>" href="<?php echo ($self["space_url"]); ?>" class="user_name"><?php echo (htmlspecialchars($self["nickname"])); ?></a>
                            <?php echo W('Common/UserRank/render',array($self['uid']));?>

                            </span>
                                </div>
                            </div>
                            <?php $title=D('Ucenter/Title')->getCurrentTitleInfo(is_login()); ?>
                            <script>
                                $(function () {
                                    $('#upgrade').tooltip({
                                                html: true,
                                                title: '当前阶段：<?php echo ($self["title"]); ?> <br/>下一阶段：<?php echo ($title["next"]); ?><br/>现有：<?php echo ($self["score"]); ?><br/>需要：<?php echo ($title["upgrade_require"]); ?><br/>剩余需要： <?php echo ($title["left"]); ?><br/>升级进度：<?php echo ($title["percent"]); ?>% <br/> '
                                            }
                                    );
                                })
                            </script>

                        </div>

                        <div id="upgrade" data-toggle="tooltip" data-placement="bottom" title=""
                             style="padding-bottom: 10px;padding-top: 10px">
                            <div style="border-top:1px solid #eee;"></div>
                            <div style="border-top: 1px solid rgb(3, 199, 3);margin-top: -1px;width: <?php echo ($title["percent"]); ?>%;z-index: 9999;">

                            </div>
                        </div>
                        <div class="clearfix user-data">
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/applist',array('uid'=>$self['uid'],'type'=>'weibo'));?>"
                                   title="<?php echo ($MODULE_ALIAS); ?>数"><?php echo ($self["weibocount"]); ?></a><br><?php echo ($MODULE_ALIAS); ?>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/fans',array('uid'=>$self['uid']));?>" title="粉丝数"><?php echo ($self["fans"]); ?></a><br>粉丝
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/following',array('uid'=>$self['uid']));?>" title="关注数"><?php echo ($self["following"]); ?></a><br>关注
                            </div>
                        </div>

                    </div>
                </div>
            </div><?php endif; ?>
        <!--登录后显示个人区域部分结束-->

        <div>
            <div class="checkin">
                <?php echo hook('checkIn');?>
                <?php echo hook('Rank');?>
            </div>
            <?php echo hook('weiboSide');?>
            <!--广告位-->
            <?php echo hook('Advs', 'weibo_below_checkrank');?>
            <!--广告位end-->

            <?php if(modC('ACTIVE_USER',1)): echo W('TopUserList/lists',array(null,'score'.modC('ACTIVE_USER_ORDER',1).'
                desc','活跃用户','top',modC('ACTIVE_USER_COUNT',6))); endif; ?>
            <?php if(modC('NEWEST_USER',1)): echo W('UserList/lists',array(null,'id desc','最新加入','new',modC('NEWEST_USER_COUNT',6))); endif; ?>
        </div>
    </div>
    <!--首页右侧部分结束-->

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




    <script src="/dev/opensns/Application/Weibo/Static/js/weibo.js"></script>
    <script>
        var SUPPORT_URL = "<?php echo addons_url('Support://Support/doSupport');?>";
        weibo.page = '<?php echo ($page); ?>';
        weibo.loadCount = 0;
        weibo.lastId = parseInt('<?php echo (reset($list)); ?>')+1;
        weibo.url = "<?php echo ($loadMoreUrl); ?>";
        weibo.type = "<?php echo ($type); ?>";
        $(function () {




            weibo_bind();
            //当屏幕滚动到底部时
            if (weibo.page == 1) {
                $(window).on('scroll', function () {
                    if (weibo.noMoreNextPage) {
                        return;
                    }
                    if (weibo.isLoadingWeibo) {
                        return;
                    }
                    if (weibo.isLoadMoreVisible()) {
                        weibo.loadNextPage();
                    }
                });
                $(window).trigger('scroll');
            }
        });

    </script>


<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>

	<!-- /底部 -->
</body>
</html>