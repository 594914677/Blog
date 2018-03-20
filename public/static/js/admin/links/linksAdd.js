layui.config({
	base : "/public/static/js/admin/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;

    //执行一个laydate实例 添加时间
    laydate.render({
        elem: '.linksTime' //指定元素
    });

 	form.on("submit(addLinks)",function(data){
        var linksName = $(".linksName").val();
        var linksUrl = $(".linksUrl").val();
        var masterEmail = $(".masterEmail").val();
        var linksTime = $(".linksTime").val();
        var linksDesc = $(".linksDesc").val();
        //显示、审核状态
        var isShow = data.field.isShow=="on" ? 1 : 0;

        $.post("linksAdd",
            {linksName:linksName,linksUrl:linksUrl,masterEmail:masterEmail,linksDesc:linksDesc,linksTime:linksTime,isShow:isShow},
            function(res){
                var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
                if(res.status){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg(res.info);
                        layer.closeAll("iframe");
                        //刷新父页面
                        parent.location.reload();
                    },2000);
                }else{
                    layer.msg(res.info, {time: 2000});
                }
            },'json');
        return false;
 	})
	
});
