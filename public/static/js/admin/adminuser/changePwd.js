layui.config({
    base : "/public/static/js/admin/"
}).use(['form','layer','jquery','laydate'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;

    //添加验证规则
    form.verify({
        newPwd : function(value, item){
            if(value.length < 5){
                return "密码长度不能小于6位";
            }
        },
        confirmPwd : function(value, item){
            if($("#newPwd").val() !== value){
                return "两次输入密码不一致，请重新输入！";
            }
        }
    });

    //修改密码
    form.on("submit(changePwd)",function(data){
        var id = $(".id").val();
        var name = $(".name").val();
        var oldPwd = $(".oldPwd").val();
        var newPwd = $(".newPwd").val();
        var confirmPwd = $(".confirmPwd").val();
        var url = $('.url').attr('data-url');

        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        $.post(url,
            {id:id, name:name, oldPwd:oldPwd, newPwd:newPwd, confirmPwd:confirmPwd},
            function(res){
                if(res.status){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg(res.info);
                        location.reload();
                    },2000);
                }else{
                    layer.msg(res.info, {time: 2000});
                }
            },'json');
        return false;
    })

});