layui.config({
	base : "/public/static/js/admin/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;
	//创建一个编辑器
 	// var editIndex = layedit.build('news_content');
    var editIndex = layedit.build('news_content',{
        uploadImage: {url: 'uploadImage', type: 'post'}
    });


    //执行一个laydate实例
    laydate.render({
        elem: '.newsTime' //指定元素
    });

    //监听提交
    form.on('submit(addNews)', function(data){
       /* layedit.getContent(editIndex) //获取html
        layedit.getText(editIndex) // 获取纯文本*/
        var newsName = $(".newsName").val();
        /*var tuijian = $(".tuijian").val();
        var newsStatus = $(".newsStatus").val();
        var isShow = $(".isShow").val();*/
        var newsAuthor = $(".newsAuthor").val();
        var newsTime = $(".newsTime").val();
        var newsCid = $(".newsCid").val();
        var keyword = $(".keyword").val();
        var textarea = $(".textarea").val();
        var content = layedit.getContent(editIndex);

        //显示、审核状态
        var isShow = data.field.isShow=="on" ? 1 : 0,
            newsStatus = data.field.newsStatus=="on" ? 1 : 0,
            tuijian = data.field.tuijian=="on" ? 1 : 0;

        $.post("newsAdd",
            {newsName:newsName,tuijian:tuijian,newsStatus:newsStatus,isShow:isShow,newsAuthor:newsAuthor,newsTime:newsTime,newsCid:newsCid,keyword:keyword,textarea:textarea,content:content},
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
