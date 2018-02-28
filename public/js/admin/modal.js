;(function ($,window,undefined) {
    /**
     * modal 动态数据加载页面处理
     */

    $('#modal').on('show.bs.modal', function () {
        $(this).append("<img src='/images/loading.gif' class='modal-loading' style='width:60px;height:60px;position:absolute;top:50%;left:50%;margin-left:-30px;margin-top:-30px;z-index:98;' >");
    });
    $('#modal').on('hidden.bs.modal', function () {
        $(this).find(".modal-content").css("display","none").html('');
        $(this).removeData();
    });
    $("#modal").on('loaded.bs.modal',function(){//数据加载完成后删除loading
        $(this).find(".modal-content").css("display","block");
        $(this).find("img").remove();
    });


})(jQuery);