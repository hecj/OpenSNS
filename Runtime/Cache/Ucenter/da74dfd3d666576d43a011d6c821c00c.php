<?php if (!defined('THINK_PATH')) exit();?><div data-role="login_info"></div>
<div class="col-xs-6 lg_left">
    <div class="col-xs-12">
        <div class="col-xs-12  lg_lf_top">
            <h2>欢迎回到 <?php if(($login_type) == "login"): ?><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/dev/opensns" title="进入首页"><?php echo modC('WEB_SITE_NAME','OpenSNS开源社交系统','Config');?></a><?php else: echo modC('WEB_SITE_NAME','OpenSNS开源社交系统','Config'); endif; ?> ！</h2>
        </div>
        <div class="clearfix"></div>
        <form action="/dev/opensns/index.php?s=/ucenter/member/login.html" method="post" class="lg_lf_form ">
            <div class="row">
                <div class="form-group">
                    <label for="inputEmail" class=".sr-only col-xs-12"></label>

                    <div class="col-xs-12">

                        <input type="text" id="inputEmail" class="form-control" placeholder="请输入<?php echo ($ph); ?>"
                               ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写4-32位用户名"
                               nullmsg="请填写用户名"
                               datatype="*4-32" value="" name="username" autocomplete="off">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class=".sr-only col-xs-12"></label>

                    <div class="col-xs-12">
                        <div id="password_block" class="input-group">
                            <input type="password" id="inputPassword" class="form-control"
                                   placeholder="请输入密码"
                                   errormsg="密码为6-30位" nullmsg="请填写密码" datatype="*6-30" name="password">

                            <div class="input-group-addon"><a style="width: 100%;height: 100%"
                                                              href="javascript:void(0);"
                                                              onclick="change_show(this)">show</a></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <?php if(check_verify_open('login')): ?><div class="form-group">
                        <label for="verifyCode" class=".sr-only col-xs-12"
                               style="display: none"></label>

                        <div class="col-xs-4">
                            <input type="text" id="verifyCode" class="form-control" placeholder="验证码"
                                   errormsg="请填写验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                        </div>
                        <div class="col-xs-8 lg_lf_fm_verify">
                            <img class="verifyimg reloadverify  " alt="点击切换" src="<?php echo U('verify');?>"
                                 style="cursor:pointer;max-width: 100%">
                        </div>
                        <div class="col-xs-11 Validform_checktip text-warning lg_lf_fm_tip col-sm-offset-1"></div>
                        <div class="clearfix"></div>
                    </div><?php endif; ?>
                <div class="clearfix form-group">
                    <div class="col-xs-6">
                        <label>
                            <input type="checkbox" name="remember" value="1" style="cursor:pointer;">
                            记住登录
                        </label>
                    </div>
                    <div class="col-xs-6 text-right">
                        <div class="with-padding"><a class="" href="<?php echo U('Member/mi');?>"
                                                     style="color: #848484;font-size: 12px;">忘记密码？</a>
                        </div>
                    </div>
                </div>
            </div>
            <input name="from" type="hidden" value="<?php echo $_SERVER['HTTP_REFERER'] ?>">
            <?php session('login_http_referer',$_SERVER['HTTP_REFERER']); ?>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">登 录</button>
            </div>


        </form>
    </div>
    <div class="lg_center"></div>
</div>

<div class="col-xs-6">

    <div class="" style="margin: 21px 0 16px 40px;">

        <h2>没有账号？</h2>
        <?php $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); if(in_array('invite',$register_type)&&!in_array('normal',$register_type)){ ?>
        <?php if(check_reg_type('username')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'username'));?>" data-title="邀请用户才能注册！" data-toggle="modal"
               class="btn btn-block btn-danger btn-lg">用户名注册</a>
            <?php } ?>
            <?php if(check_reg_type('email')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'email'));?>" data-title="邀请用户才能注册！" data-toggle="modal"
               class="btn btn-block btn-primary btn-lg">邮箱注册</a>
            <?php } ?>
            <?php if(check_reg_type('mobile')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'mobile'));?>" data-title="邀请用户才能注册！" data-toggle="modal"
               class="btn btn-block btn-success btn-lg">手机号注册</a>
            <?php } ?>
        <?php }else{ ?>
            <?php if(check_reg_type('username')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'username'));?>"
               class="btn btn-block btn-danger btn-lg">用户名注册</a>
            <?php } ?>
            <?php if(check_reg_type('email')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'email'));?>"
               class="btn btn-block btn-primary btn-lg">邮箱注册</a>
            <?php } ?>
            <?php if(check_reg_type('mobile')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'mobile'));?>"
               class="btn btn-block btn-success btn-lg">手机号注册</a>
            <?php } ?>
        <?php } ?>
    </div>

    <div style="margin-top: 20px;">
        <?php echo hook('syncLogin');?>
    </div>
</div>

<div class="clearfix"></div>


<script type="text/javascript">
    var quickLogin = "<?php echo ($login_type); ?>";
    $(document)
            .ajaxStart(function () {
                $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
            });

    function change_show(obj) {
        if ($(obj).text().trim() == 'show') {
            var value = $('#inputPassword').val().trim();
            var html = '<input type="text" value="' + value + '" id="inputPassword" class="form-control" placeholder="请输入密码" errormsg="密码为6-30位" nullmsg="请填写密码" datatype="*6-30" name="password">' +
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">hide</a></div>';
            $('#password_block').html(html);
        } else {
            var value = $('#inputPassword').val().trim();
            var html = '<input type="password" value="' + value + '" id="inputPassword" class="form-control" placeholder="请输入密码" errormsg="密码为6-30位" nullmsg="请填写密码" datatype="*6-30" name="password">' +
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">show</a></div>';
            $('#password_block').html(html);
        }
    }

    $(function () {
        $("form").submit(function () {
            toast.showLoading();
            var self = $(this);
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;
            function success(data) {
                if (data.status) {
                    if (data.url==undefined&&quickLogin == "quickLogin") {
                        $('[data-role="login_info"]').append(data.info);
                        toast.success('欢迎回来。', '温馨提示');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        $('body').append(data.info);
                        toast.success('欢迎回来，页面正在跳转，请稍候。', '温馨提示');
                        setTimeout(function () {
                            window.location.href = data.url;
                        }, 1500);
                    }
                } else {
                    toast.error(data.info, '温馨提示');
                    //self.find(".Validform_checktip").text(data.info);
                    //刷新验证码
                    $(".reloadverify").click();
                }
                toast.hideLoading();
            }
        });
        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(function () {
            if (verifyimg.indexOf('?') > 0) {
                $(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });
    });
</script>