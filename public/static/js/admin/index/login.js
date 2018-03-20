layui.config({
    base : "/public/static/js/admin/"
}).use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
//video背景
    $(window).resize(function(){
        if($(".video-player").width() > $(window).width()){
            $(".video-player").css({"height":$(window).height(),"width":"auto","left":-($(".video-player").width()-$(window).width())/2});
        }else{
            $(".video-player").css({"width":$(window).width(),"height":"auto","left":-($(".video-player").width()-$(window).width())/2});
        }
    }).resize();
    //登录按钮事件
    form.on("submit(login)",function(data){
        var username = $(".username").val();
        var password = $(".password").val();
        var captcha = $(".captcha").val();
        $.ajax({
            url: 'login',
            type: "POST",
            data: {username:username,password:password,captcha:captcha},
            dataType: "json",
            success: function (data) {
                if(data.status){
                    setTimeout(function() {
                        layer.msg(data.info, {time: 2000});
                        window.location.href = data.url;
                    }, 500);
                }else{
                    layer.msg(data.info, {time: 2000});
                }
            }
        });
        /*$.post("login",
            {username:username,password:password,captcha:captcha},
            function(res){
                if(res.status){
                    layer.msg(res.info, {time: 2000});
                    window.location.href = res.url;
                }else{
                    layer.msg(res.info, {time: 2000});
                }
            },'json');*/
        return false;

    })
});
