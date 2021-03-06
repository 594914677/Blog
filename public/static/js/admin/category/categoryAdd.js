layui.config({
	base : "/public/static/js/admin/"
}).use(['form','layer','jquery','layedit'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;


    //监听提交
    form.on('submit(addCategory)', function(data){
        var name = $(".name").val();
        var pName = $(".pName").val();
        var links = $(".links").val();
        var isShow = data.field.isShow=="on" ? 1 : 0;

        $.post("categoryAdd",
            {name:name,pName:pName,links:links, isShow:isShow},
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
    });
});
