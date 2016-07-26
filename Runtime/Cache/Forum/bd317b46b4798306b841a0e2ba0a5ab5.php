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
    <script type="text/javascript" src="/dev/opensns/Application/Forum/Static/js/common.js"></script>
</head>
<body>
<!-- 头部 -->


<!-- /头部 -->
<link type="text/css" rel="stylesheet" href="/dev/opensns/Application/Forum/Static/css/forum.css"/>
<!-- 主体 -->
<div id="main-container" class="">
    <div id="body-container" class="container  common-block">
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-12">
                    <div class="fourm-top common_block_border"
                         style="padding: 15px 20px;margin: -15px;margin-top: 0;margin-bottom: 15px">
                        <h4>
                            <?php if($isEdit): ?>编辑帖子
                                <?php else: ?>
                                发表新帖<?php endif; ?>
                        </h4>
                        <hr/>
                        <section id="contents">
                            <form action="<?php echo U('Forum/Index/doEdit');?>" method="post" id="edit-article-form" style="width: 665px;">
                                <input type="hidden" name="post_id" value="<?php echo ($post["id"]); ?>"/>

                                <div class="row">
                                    <!-- 帖子分类 -->
                                    <div class="col-xs-3">
                                        <p>
                                            <select class="form-control" name="forum_id">
                                                <?php if(is_array($forum_list)): $i = 0; $__LIST__ = $forum_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$each_forum): $mod = ($i % 2 );++$i; if($each_forum['allow_publish']): $selected = $each_forum['id'] == $forum_id ? 'selected' : ''; ?>
                                                        <option value="<?php echo ($each_forum["id"]); ?>"
                                                                <?php echo ($selected); ?>><?php echo (op_t($each_forum["title"])); ?>
                                                        </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-xs-9">
                                        <p>
                                            <input id="title" type="text" name="title" placeholder="标题"
                                                   value="<?php echo ($post["title"]); ?>"
                                                   class="form-control"/>
                                        </p>
                                    </div>
                                </div>
                                <p>

                                    <?php $config="toolbars:[['source','|','bold','italic','underline','fontsize','forecolor','fontfamily','backcolor','|','link','emotion','scrawl','attachment','insertvideo','insertimage','insertcode']]"; ?>

                                    <?php echo W('Common/Ueditor/editor',array('myeditor','content',$post['content'],'100%','350px',$config));?>

                                </p>

                                <p>&nbsp;</p>

                                <p class="pull-right">
                                    <button type="submit" class="btn btn-large btn-primary" id="submit-button">
                                        <span class="glyphicon glyphicon-edit"></span>
                    <span id="submit-content">
                        <?php if($isEdit): ?>编辑帖子 Ctrl+Enter
                            <?php else: ?>
                            发表帖子 Ctrl+Enter<?php endif; ?>
                    </span>
                                    </button>
                                    <input type="hidden" id="isEdit" value="<?php echo ($isEdit); ?>">
                                </p>
                                <p>
                                    <?php $hasWeibo=D('Module')->checkInstalled('Weibo'); ?>
                                    <?php if(($hasWeibo) == "1"): ?><label>
                                            <input type="checkbox" name="sendWeibo" value="1" checked> 同步到微博
                                        </label><?php endif; ?>

                                </p>
                            </form>
                        </section>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-9">
                </div>
                <div class="col-xs-3">

                </div>
            </div>
        </div>
        <div class="col-xs-4">
            
            
                <div>
                    <h1>发帖须知</h1>

                    <p>
                        请严格遵守法律法规，对所发表的内容负责。
                    </p>

                </div>
            

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



    <script type="text/javascript" src="/dev/opensns/Public/Core/js/ext/atwho/atwho.js"></script>
    <link type="text/css" rel="stylesheet" href="/dev/opensns/Public/Core/js/ext/atwho//atwho.css"/>
    <script>
        //点击编辑或发表按钮之后
        $(function () {
            $('#edit-article-form').keypress(function (e) {
                if (e.ctrlKey && e.which == 13 || e.which == 10) {
                    $('#submit-button').focus();
                    $("#submit-button").click();
                }
            });

            var $inputor = $('#contentEditor').atwho(atwho_config);

            var submitCount = 0;
            $('#edit-article-form').submit(function (e) {
                //为了得到编辑器中的内容，触发两次提交事件
                if (submitCount == 0) {
                    submitCount = 1;
                    $('#edit-article-form').trigger('submit');
                    e.preventDefault();
                    return false;
                } else {
                    submitCount = 0;
                }
                //显示正在提交
                showSubmitting();
                //获取用户输入的内容
                var postData = $(this).serialize();
                var action = $(this).attr('action');
                $.post(action, postData, function (e) {
                    if (e.status) {
                        showSubmitSuccess(e.info, e.url);
                    } else {
                        showSubmitError(e.info);
                    }
                });
                //停止提交
                e.preventDefault();
                return false;
            });

            function showSubmitError(message) {
                $('#submit-button').removeClass('disabled');
                var isEdit = $('#isEdit').val();
                var text = '';
                if (isEdit) {
                    text = '编辑帖子';
                } else {
                    text = '发表帖子';
                }
                $('#submit-content').text(text);
                toast.error(message, '错误');
            }

            function showSubmitSuccess(message, url) {
                toast.success(message, '温馨提示');
                setTimeout(function () {
                    location.href = url;
                }, 1500);
            }

            function showSubmitting() {
                $('#submit-button').attr('class', 'btn btn-primary disabled');
                $('#submit-content').text('正在提交');
            }
        })
    </script>