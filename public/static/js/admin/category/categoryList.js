layui.config({
    base : "/public/static/js/admin/"
}).use(['form','layer','jquery','laypage'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        laypage = layui.laypage,
        $ = layui.jquery;

    //加载页面数据
    var newsData = [];

    //添加文章
    //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
    $(window).one("resize",function(){
        $(".categoryAdd").click(function(){
            var url= $(".categoryAdd").attr("data-url");
            var index = layui.layer.open({
                title : "添加分类",
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
        $(".other .category_edit").click(function(){
            var url= $(this).attr("data-url");
            console.log(url);
            var index = layui.layer.open({
                title : "编辑分类",
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
    $("body").on("click",".category_del",function(){
        var _this = $(this);
        var cid = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
            $.post(url,
                {cid:cid},
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
    $(".categoryDel").click(function(){
        var $checkbox = $('.category_list tbody input[type="checkbox"][name="checked"]');
        var $checked = $('.category_list tbody input[type="checkbox"][name="checked"]:checked');
        var _this = $(this);
        var url = $(this).attr('data-url');
        if($checkbox.is(":checked")){
            layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
                var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
                setTimeout(function(){
                    var cid = [];
                    for(var j=0;j<$checked.length;j++){
                        var item = $checked.eq(j).parents("tr").find(".category_del").attr("data-id");
                        cid.push(item);
                    }
                    $.post(url,
                        {cid:cid},
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
                    $('.category_list thead input[type="checkbox"]').prop("checked",false);
                    form.render();
                    layer.close(index);
                },2000);
            })
        }else{
            layer.msg("请选择需要删除的分类");
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
});
