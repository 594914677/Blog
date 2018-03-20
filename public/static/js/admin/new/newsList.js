layui.config({
    base : "/public/static/js/admin/"
}).use(['form','layer','jquery','laypage'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        laypage = layui.laypage,
        $ = layui.jquery;



    //添加文章
    //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
    $(window).one("resize",function(){
        $(".newsAdd_btn").click(function(){
            var url= $(".newsAdd_btn").attr("data-url");
            var index = layui.layer.open({
                title : "添加文章",
                type : 2,
                content : url,
                success : function(layero, index){
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            });
            //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
            $(window).resize(function(){
                layui.layer.full(index);
            });
            layui.layer.full(index);
        })
    }).resize();

    //编辑
    $("body").one("resize",function(){
        $(".other .news_edit").click(function(){
            var url= $(this).attr("data-url");

            var index = layui.layer.open({
                title : "编辑文章",
                type : 2,
                content : url,
                success : function(layero, index){
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            });
            //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
            $(window).resize(function(){
                layui.layer.full(index);
            });
            layui.layer.full(index);
        })
    }).resize();

    //删除
    $("body").on("click",".news_del",function(){
        var _this = $(this);
        var newsId = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
            $.post(url,
                {newsId:newsId},
                function(res){
                    if(res.status){
                        layer.msg(res.info, {time: 2000});
                        _this.parents("tr").remove();
                    }else{
                        layer.msg(res.info, {time: 2000});
                    }
                },'json');
            //_this.parents("tr").remove();
            layer.close(index);
        });
    });

    //批量删除
    $(".batchDel").click(function(){
        var $checkbox = $('.news_list tbody input[type="checkbox"][name="checked"]');
        var $checked = $('.news_list tbody input[type="checkbox"][name="checked"]:checked');
        var _this = $(this);
        var url = $(this).attr('data-url');
        if($checkbox.is(":checked")){
            layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
                var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
                setTimeout(function(){
                    var newsId = [];
                    for(var j=0;j<$checked.length;j++){
                        var item = $checked.eq(j).parents("tr").find(".news_del").attr("data-id");
                        newsId.push(item);
                    }
                    $.post(url,
                        {newsId:newsId},
                        function(res){
                            if(res.status){
                                layer.msg(res.info, {time: 2000});
                                for(var j=0;j<$checked.length;j++){
                                    $checked.eq(j).parents("tr").remove();
                                }
                            }else{
                                layer.msg(res.info, {time: 2000});
                            }
                        },'json');
                    $('.news_list thead input[type="checkbox"]').prop("checked",false);
                    form.render();
                    layer.close(index);
                },2000);
            })
        }else{
            layer.msg("请选择需要删除的文章");
        }
    });

    //是否展示
    form.on('switch(isShow)', function(data){
        var index = layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.8});
        var url = $(this).attr('data-url');
        var newsId = $(this).attr('data-id');
        var isShow = data.elem.checked == true ? 1 : 0;
        setTimeout(function(){
            $.post(url,
                {newsId:newsId,isShow:isShow},
                function(res){
                    if(res.status){
                        layer.msg(res.info, {time: 2000});
                    }else{
                        layer.msg(res.info, {time: 2000});
                    }
                    layer.close(index);
                },'json');
        },2000);

    });

    //审核文章
    $(".audit_btn").click(function(){
        var $checkbox = $('.news_list tbody input[type="checkbox"][name="checked"]');
        var $checked = $('.news_list tbody input[type="checkbox"][name="checked"]:checked');
        var url = $(this).attr('data-url');
        if($checkbox.is(":checked")){
            var index = layer.msg('审核中，请稍候',{icon: 16,time:false,shade:0.8});
            setTimeout(function(){
                var newsId =[];
                for(var j=0;j<$checked.length;j++){
                    var item = $checked.eq(j).parents("tr").find(".news_del").attr("data-id");
                    newsId.push(item);
                }
                $.post(url,
                    {newsId:newsId},
                    function(res){
                        if(res.status){
                            layer.msg(res.info, {time: 2000});
                            for(var j=0;j<$checked.length;j++){
                                //修改列表中的文字
                                $checked.eq(j).parents("tr").find("td:eq(3)").text("审核通过").removeAttr("style");
                                //将选中状态删除
                                $checked.eq(j).parents("tr").find('input[type="checkbox"][name="checked"]').prop("checked",false);
                                form.render();
                            }
                        }else{
                            layer.msg(res.info, {time: 2000});
                        }
                        layer.close(index);
                    },'json');
            },2000);
        }else{
            layer.msg("请选择需要审核的文章");
        }
    });

    //推荐文章
    form.on('switch(tuijian)', function(data){
        var index = layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.8});
        var url = $(this).attr('data-url');
        var newsId = $(this).attr('data-id');
        var tuijian = data.elem.checked == true ? 1 : 0;
        setTimeout(function(){
            $.post(url,
                {newsId:newsId,tuijian:tuijian},
                function(res){
                    if(res.status){
                        layer.msg(res.info, {time: 2000});
                    }else{
                        layer.msg(res.info, {time: 2000});
                    }
                    layer.close(index);
                },'json');
        },2000);

    });

    //全选
    form.on('checkbox(allChoose)', function(data){
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
        child.each(function(index, item){
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });

    //通过判断文章是否全部选中来确定全选按钮是否选中
    form.on("checkbox(choose)",function(data){
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
        var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
        if(childChecked.length == child.length){
            $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
        }else{
            $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
        }
        form.render('checkbox');
    });


    //收藏.
    $("body").on("click",".news_collect",function(){
        if($(this).text().indexOf("已收藏") > 0){
            layer.msg("取消收藏成功！");
            $(this).html("<i class='layui-icon'>&#xe600;</i> 收藏");
        }else{
            layer.msg("收藏成功！");
            $(this).html("<i class='iconfont icon-star'></i> 已收藏");
        }
    });




});
