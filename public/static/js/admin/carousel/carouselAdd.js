layui.config({
    base : "/public/static/js/admin/"
}).use(['form','layer','jquery', 'upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
        upload = layui.upload;

        var upload_img = '';
    //普通图片上传
    var uploadInst = upload.render({
        elem: '#test1'
        ,url: '/admin/carousel/uploadImage'
        ,before: function(obj){
            //预读本地文件示例，不支持ie8
            obj.preview(function(index, file, result){
                $('#demo1').attr('src', result); //图片链接（base64）
            });
        }
        ,done: function(res){
            upload_img = res.data.src;
            //如果上传失败
            if(res.code > 0){
                return layer.msg('上传失败');
            }
            //上传成功
        }
        ,error: function(){
            //演示失败状态，并实现重传
            var demoText = $('#demoText');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
            demoText.find('.demo-reload').on('click', function(){
                uploadInst.upload();
            });
        }
    });


    form.on("submit(addCarousel)",function(data){
        var name = $(".name").val();
        var url = $(".url").val();
        //显示、审核状态
        var isShow = data.field.isShow=="on" ? 1 : 0;

        $.post("carouselAdd",
            {name:name,url:url,isShow:isShow,upload_img:upload_img},
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
