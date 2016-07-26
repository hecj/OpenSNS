<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OpenSNS管理后台</title>
    <link href="/dev/opensns/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">


    <!--zui-->
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/zui/css/zui.css" media="all">
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/admin.css" media="all">
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/ext.css" media="all">
    <!--zui end-->

    <!--
        <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/base.css" media="all">
        <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/common.css" media="all"-->
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/module.css">
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/style.css" media="all">
    <!--<link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/dev/opensns/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/dev/opensns/Public/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/dev/opensns/Application/Admin/Static/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
    <script type="text/javascript">
        var ThinkPHP = window.Think = {
            "ROOT": "/dev/opensns", //当前网站地址
            "APP": "/dev/opensns/index.php?s=", //当前项目地址
            "PUBLIC": "/dev/opensns/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            'URL_MODEL': "<?php echo C('URL_MODEL');?>"
        }
    </script>
</head>
<body>
<style>

</style>
<div class="panel-header">
    <nav class="navbar navbar-inverse admin-bar" role="navigation">
        <div class="navbar-header">
            <a href="<?php echo U('Index/index');?>" class="navbar-brand">
                OpenSNS</a>
        </div>
        <div class="collapse navbar-collapse navbar-collapse-example">
            <ul id="nav_bar" class="nav navbar-nav">
                <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if(($menu["hide"]) != "1"): ?><li data-id="<?php echo ($menu["id"]); ?>" class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>">
                            <?php if(($menu["icon"]) != ""): ?><i class="icon-<?php echo ($menu["icon"]); ?>"></i>&nbsp;<?php endif; ?>
                            <?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="javascript:;"  onclick="clear_cache()"><i class="icon-trash"></i> 清空缓存</a></li>
                <li><a target="_blank" href="<?php echo U('Home/Index/index');?>"><i class="icon-copy"></i> 打开前台</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>
                        <?php echo session('user_auth.username');?> <b
                                class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                        <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
                    </ul>
                </li>
                <script>
                    function clear_cache() {
                        var msg = new $.Messager('清理缓存成功。', {placement: 'bottom'});
                        $.get('/cc.php');
                        msg.show()
                    }
                </script>
            </ul>
        </div>
    </nav>

    <div class="admin-title">

    </div>

</div>
<div class="panel-menu">
    <ul class="nav nav-primary nav-stacked">

        <?php if(is_array($__MODULE_MENU__)): $i = 0; $__LIST__ = $__MODULE_MENU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v['is_setup'] AND $v['admin_entry']): ?><li>
                    <a  href="<?php echo U($v['admin_entry']);?>" title="<?php echo (text($v["alias"])); ?>" class="text-ellipsis text-center">
                        <i class="icon-<?php echo ($v['icon']); ?>"></i><br/><?php echo ($v["alias"]); ?>
                    </a>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

    </ul>

</div>

<div class="panel-main" style="float:left;">

    <div class="">


    <div class="clearfix " style="">
        <?php if(!empty($__MENU__["child"])): ?><div class="sub_menu_wrapper" style="background: rgb(245, 246, 247); bottom: -10px;top: 0;position: absolute;width: 180px;overflow: auto">
                <div>
                    <nav id="sub_menu" class="menu" data-toggle="menu">
                        <ul class="nav nav-primary">
                            
                                <!--     <?php if(!empty($_extra_menu)): ?>
                                         <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>-->
                                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                                    <?php if(!empty($sub_menu)): ?><li class="show">
                                            <a href="#">
                                                <?php if(!empty($key)): echo ($key); endif; ?>
                                            </a>
                                            <ul class="nav">
                                                <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                                        <a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </ul>
                                        </li><?php endif; ?>
                                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>

                            

                        </ul>
                    </nav>
                </div>
            </div><?php endif; ?>


        <?php if(!empty($__MENU__["child"])): $col=10; ?>
            <?php else: ?>
            <?php $col=12; endif; ?>
        <div id="main-content" class="" style="padding:10px;padding-left:0;padding-bottom:10px;left: 180px;position:absolute;right: 0;bottom: 0;top: 0;overflow: auto">
           <?php if(($update) == "1"): ?><div id="top-alert" class="alert alert-success alert-dismissable" style="position: absolute;left: 50%;margin-left: -150px;width: 300px;box-shadow: rgba(95, 95, 95, 0.4) 3px 3px 3px;z-index:999">
                   <i class="icon-ok-sign" style="font-size: 28px"></i>  &nbsp;&nbsp; 有新版本可更新！<a class="alert-link" href="<?php echo U('Cloud/update');?>">去更新！</a>
                   <button class="close fixed" style="margin-top: 4px;">&times;</button>
               </div><?php endif; ?>

            <div id="main" style="overflow-y:auto;overflow-x:hidden;">
                
                    <!-- nav -->
                    <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                            <span>您的位置:</span>
                            <?php $i = '1'; ?>
                            <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                                    <?php else: ?>
                                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                                <?php $i = $i+1; endforeach; endif; ?>
                        </div><?php endif; ?>
                    <!-- nav -->
                

                <div class="admin-main-container">
                    

    <!-- 标题 -->
    <div class="main-title">
        <h2>
            论坛分类、板块管理 （一级为分类，二级为板块）
        </h2>
    </div>

    <div class="with-padding">

        <!-- 表格列表 -->
        <div class="tb-unit posr">
            <div class="tb-unit-bar">
                <a href="<?php echo U('Admin/Forum/addtype');?>" class="btn" style="margin-right:5px;">新增</a></div>
            <div class="category">
                <div class="hd clearfix">
                    <div class="fold">折叠</div>
                    <div class="order">排序</div>
                    <div class="name">名称</div>
                </div>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="cate-item">
                        <dt class="clearfix">
                        <form action="<?php echo U('Admin/Forum/addtype');?>" method="post">
                            <div class="btn-toolbar opt-btn clearfix">
                                <a title="编辑" href="<?php echo U('Admin/Forum/addtype',array('id'=>$vo['id'],'pid'=>0));?>">
                                    编辑
                                </a>
                                <?php if(($vo["status"]) == "1"): ?><a title="禁用" href="<?php echo U('Admin/Forum/setTypeStatus',array('ids'=>$vo['id'],'status'=>0));?>" class="ajax-get">
                                        禁用
                                    </a>
                                    <?php else: ?>
                                    <a title="启用" href="<?php echo U('Admin/Forum/setTypeStatus',array('ids'=>$vo['id'],'status'=>1));?>" class="ajax-get">
                                        启用
                                    </a><?php endif; ?>
                                <a title="删除" href="<?php echo U('Admin/Forum/setTypeStatus',array('ids'=>$vo['id'],'status'=>-1));?>" class="confirm ajax-get">
                                    删除
                                </a>
                            </div>
                            <div class="fold"><i class="icon-unfold"></i></div>
                            <div class="order">
                                <input type="text" name="sort" class="form-control text input-mini" value="<?php echo ($vo["sort"]); ?>">
                            </div>

                            <div class="name">
                                <span class="tab-sign"></span>
                                <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
                                <input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="<?php echo ($vo["title"]); ?>">
                                <a class="add-sub-cate" title="添加板块" href="<?php echo U('Admin/Forum/editForum',array('type_id'=>$vo['id']));?>">
                                    <i class="icon-plus"></i>
                                </a>
                                <span class="help-inline msg"></span>
                            </div>
                        </form>
                        </dt>
                        <?php if(!empty($vo["child"])): ?><dd>
                                <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><dl class="cate-item">
                                        <dt class="clearfix">
                                        <form action="<?php echo U('Admin/Forum/editForum');?>" method="post">
                                            <div class="btn-toolbar opt-btn clearfix">
                                                <a title="编辑" href="<?php echo U('Admin/Forum/editForum',array('id'=>$vl['forum_id'],'pid'=>0));?>">
                                                    编辑
                                                </a>
                                                <?php if(($vl["status"]) == "1"): ?><a title="禁用" href="<?php echo U('Admin/Forum/setForumStatus',array('ids'=>$vl['forum_id'],'status'=>0));?>" class="ajax-get">
                                                        禁用
                                                    </a>
                                                    <?php else: ?>
                                                    <a title="启用" href="<?php echo U('Admin/Forum/setForumStatus',array('ids'=>$vl['forum_id'],'status'=>1));?>" class="ajax-get">
                                                        启用
                                                    </a><?php endif; ?>
                                                <a title="删除" href="<?php echo U('Admin/Forum/setForumStatus',array('ids'=>$vl['forum_id'],'status'=>-1));?>" class="confirm ajax-get">
                                                    删除
                                                </a>
                                            </div>
                                            <div class="fold"><i></i></div>
                                            <div class="order">
                                                <input type="text" name="sort" class="form-control text input-mini" value="<?php echo ($vl["sort"]); ?>">
                                            </div>

                                            <div class="name">
                                                <span class="tab-sign"></span>
                                                <input type="hidden" name="quick_edit" value="1">
                                                <input type="hidden" name="id" value="<?php echo ($vl["forum_id"]); ?>">
                                                <input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="<?php echo ($vl["title"]); ?>">
                                                <span class="help-inline msg"></span>
                                            </div>
                                        </form>
                                        </dt>

                                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                            </dd><?php endif; ?>
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!-- /表格列表 -->
    </div>


                </div>

            </div>
        </div>
    </div>
    </div>
</div>



<?php if($report){ ?>
<div  class="report_feedback" title="填写四格体验报告" data-toggle="modal" data-target="#myModal">
    <div class="report_icon" ></div>
    <span class="label label-badge label-danger report_point">1</span>
</div>




<div class="modal fade in" id="myModal" aria-hidden="false"  style="display: none">
    <div class="modal-dialog" >
        <div class="modal-content">
            <form class="report_form"  action="<?php echo U('admin/admin/submitReport');?>" method="post">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                <h4 class="modal-title">四格体验报告</h4>
            </div>

            <div class="modal-body">

                    <div class="row">
                        <!-- 帖子分类 -->
                        <div class="col-sm-12">
<div>感谢您使用我们的产品，希望您的认真反馈有助于我们改善产品。</div>

                                <label class="item-label">我的更新心情</label>
                            <div>
                                <select name="q1" class="report-select" style="width:400px;">
                                    <option value="0">请选择</option>
                                    <option>开心</option>
                                    <option>悲伤</option>
                                    <option>超有爱</option>
                                    <option>期待</option>
                                </select>
                        </div>

                                <label class="item-label">我选择的最有爱更新</label>
                            <div>
                                <select name="q2" class="report-select" style="width:400px;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($this_update)): $i = 0; $__LIST__ = $this_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>

                                <label class="item-label">我选择的最不给力更新
                                </label>
                            <div>
                                <select name="q3" class="report-select" style="width:400px;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($this_update)): $i = 0; $__LIST__ = $this_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>


                                <label class="item-label">我选择的期待功能
                                </label>
                            <div>
                                <select name="q4" class="report-select" style="width:400px;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($future_update)): $i = 0; $__LIST__ = $future_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <?php if(strval($report['url'])!=''){ ?>
                <a class="pull-left" href="<?php echo ($report['url']); ?>" target="_blank" >查看更新详情</a>
                <?php } ?>
                <button type="submit" class="btn ajax-post" target-form="report_form">确定</button>
            </div>

            </form>
        </div>
    </div>
</div>



<?php } ?>


<script>
    $(function () {
        var config = {
            '.chosen-select'           : {search_contains: true, drop_width: 400,no_results_text:'找不到匹配的选项'},
            '.report-select'           : {search_contains: true, width: '400px',no_results_text:'找不到匹配的选项'}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

    });
</script>


<script src="/dev/opensns/Application/Admin/Static/zui/lib/chosen/chosen.js"></script>
<link href="/dev/opensns/Application/Admin/Static/zui/lib/chosen/chosen.css" type="text/css" rel="stylesheet">




<!-- 内容区 -->

<!-- /内容区 -->
<script type="text/javascript">
    (function () {
        var ThinkPHP = window.Think = {
            "ROOT": "/dev/opensns", //当前网站地址
            "APP": "/dev/opensns/index.php?s=", //当前项目地址
            "PUBLIC": "/dev/opensns/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            'URL_MODEL': "<?php echo C('URL_MODEL');?>"
        }
    })();
</script>
<script type="text/javascript" src="/dev/opensns/Public/static/think.js"></script>

<!--zui-->
<script type="text/javascript" src="/dev/opensns/Application/Admin/Static/js/common.js"></script>
<script type="text/javascript" src="/dev/opensns/Application/Admin/Static/js/com/com.toast.class.js"></script>
<script type="text/javascript" src="/dev/opensns/Application/Admin/Static/zui/js/zui.js"></script>
<script type="text/javascript" src="/dev/opensns/Application/Admin/Static/zui/lib/autotrigger/autotrigger.min.js"></script>
<!--zui end-->
<link rel="stylesheet" type="text/css" href="/dev/opensns/Application/Admin/Static/js/kanban/kanban.css" media="all">
<script type="text/javascript" src="/dev/opensns/Application/Admin/Static/js/kanban/kanban.js"></script>
<script type="text/javascript">
    +function () {
        var $window = $(window), $subnav = $("#subnav"), url;
        $window.resize(function () {
            $("#main").css("min-height", $window.height() - 130);
        }).resize();


        // 导航栏超出窗口高度后的模拟滚动条
        var sHeight = $(".sidebar").height();
        var subHeight = $(".subnav").height();
        var diff = subHeight - sHeight; //250
        var sub = $(".subnav");
        if (diff > 0) {
            $(window).mousewheel(function (event, delta) {
                if (delta > 0) {
                    if (parseInt(sub.css('marginTop')) > -10) {
                        sub.css('marginTop', '0px');
                    } else {
                        sub.css('marginTop', '+=' + 10);
                    }
                } else {
                    if (parseInt(sub.css('marginTop')) < '-' + (diff - 10)) {
                        sub.css('marginTop', '-' + (diff - 10));
                    } else {
                        sub.css('marginTop', '-=' + 10);
                    }
                }
            });
        }
    }();
    highlight_subnav("<?php echo U('Admin'.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$_GET);?>")
</script>

    <script type="text/javascript" src="/dev/opensns/Public/static/qtip/jquery.qtip.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/dev/opensns/Public/static/qtip/jquery.qtip.min.css" media="all">
    <script type="text/javascript" charset="utf-8">
        +function ($) {
            /* 分类展开收起 */
            $(".category dd").prev().find(".fold i").addClass("icon-unfold")
                    .click(function(){
                        var self = $(this);
                        if(self.hasClass("icon-unfold")){
                            self.closest("dt").next().slideUp("fast", function(){
                                self.removeClass("icon-unfold").addClass("icon-fold");
                            });
                        } else {
                            self.closest("dt").next().slideDown("fast", function(){
                                self.removeClass("icon-fold").addClass("icon-unfold");
                            });
                        }
                    });

            /* 三级分类删除新增按钮 */
            $(".category dd dd .add-sub").remove();

            /* 实时更新分类信息 */
            $(".category")
                    .on("submit", "form", function(){
                        var self = $(this);
                        $.post(
                                self.attr("action"),
                                self.serialize(),
                                function(data){
                                    /* 提示信息 */
                                    var name = data.status ? "success" : "error", msg;
                                    msg = self.find(".msg").addClass(name).text(data.info)
                                            .css("display", "inline-block");
                                    setTimeout(function(){
                                        msg.fadeOut(function(){
                                            msg.text("").removeClass(name);
                                        });
                                    }, 1000);
                                },
                                "json"
                        );
                        return false;
                    })
                    .on("focus","input",function(){
                        $(this).data('param',$(this).closest("form").serialize());

                    })
                    .on("blur", "input", function(){
                        if($(this).data('param')!=$(this).closest("form").serialize()){
                            $(this).closest("form").submit();
                        }
                    });

            //导航高亮
            highlight_subnav('<?php echo U('Forum/type');?>');
        }(jQuery);
    </script>



</body>
</html>