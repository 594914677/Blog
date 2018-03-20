var $,tab;
layui.config({
    base : "/public/static/js/admin/"
}).use(['bodyTab','form','element','layer','jquery','carousel'],function() {
    var form = layui.form,
        layer = layui.layer,
        element = layui.element;
    $ = layui.jquery;
    var carousel = layui.carousel;
    //建造轮播图
    carousel.render({
        elem: '#carousel'
        ,width: '100%' //设置容器宽度
        ,arrow: 'always' //始终显示箭头

    });
    /*回到顶部 开始*/
    $(window).scroll(function () {
        if ($(window).scrollTop() > 103) {
            $('#to_top').css('display','block');    //<div id-'top'></div>假如有这么个div是那个向上图标的div。css默认none
        }
        else {
            $('#to_top').css('display','none');
        }
    });
    var timer  = null;
    to_top.onclick = function(){
        cancelAnimationFrame(timer);
        timer = requestAnimationFrame(function fn(){
            var oTop = document.body.scrollTop || document.documentElement.scrollTop;
            if(oTop > 0){
                document.body.scrollTop = document.documentElement.scrollTop = oTop - 50;
                timer = requestAnimationFrame(fn);
            }else{
                cancelAnimationFrame(timer);
            }
        });
    }
    /*回到顶部 结束*/

});
