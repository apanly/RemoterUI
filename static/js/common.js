;
var commonC={
    init:function(){
         this.initEvent();
    },
    initEvent:function(){
        var that=this;
        $(".container-fluid button").each(function(){
            $(this).click(function(){
                var uri="index.php?a=zmq&cmd="+$(this).val();
                that.commonajax(uri,commonC.callback,'tv');
            })
        });
    },
    commonajax:function(httpurl,callback,extra){
        $.ajax({
            type:'GET',
            url:httpurl,
            dataType:'json',
            success:function(res){
                callback({'data':res,"extra":extra});
            }
        });
    },
    callback:function(cldata){
        //console.log(cldata);
    }
}

$(document).ready(function(){
    commonC.init();
})
