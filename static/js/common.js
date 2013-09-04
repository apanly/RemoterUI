;
var commonC={
    init:function(){
         this.initEvent();
         this.autofix();
    },
    initEvent:function(){
        var that=this;
        $(".container-fluid button").each(function(){
            $(this).click(function(){
                var code= $.trim($(this).val());
                if(code.length>0){
                    that.log("发送命令："+code);
                    var uri="index.php?a=zmq&cmd="+code;
                    that.commonajax(uri,commonC.callback,'tv');
                }else{
                    that.log("亲，发个命令撒");
                }
            })
        });
       $(".container-fluid #command").click(function(){
           var codecmd= $.trim($("#codecmd").val());
           var code= $.trim($("#code").val());
           if(codecmd.length>0 || code.length>0){
               if(/^[\d\w]+$/.test(code)){
                   codecmd=code;
                   that.log("发送命令："+codecmd);
               }else{
                   that.log("发送命令："+code);
               }
               var uri="index.php?a=zmq&cmd="+codecmd;
               that.commonajax(uri,commonC.callback,'custom');
           }else{
               that.log("亲，发个命令撒");
           }
       });
       $(".container-fluid #study").click(function(){
            var studyval= $.trim($(this).val());
            var command="f0";
            if(studyval=="进入学习模式"){
                command="f0";
                $(this).val("退出学习模式");
            }else if(studyval=="退出学习模式"){
                command="f2";
                $(this).val("进入学习模式");
            }
            that.log("发送命令："+studyval);
            var uri="index.php?a=zmq&cmd="+command;
            that.commonajax(uri,commonC.callback,'custom');
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
        commonC.log(cldata.data.message);
    },
    log:function(msg){
        var target=$("#msg");
       if(target){
           var content="<span>"+msg+"<br/></span>";
           target.append(content);
       }
    },
    autofix: function () {
        $.ajax({
            url: "index.php?a=getcmdtips",
            type: 'POST',
            dataType: "json",
            data: {
                type: "code",
                maxRows: 12
            },
            success: function (data) {
                var options={
                    source: data,
                    minChars: 2,
                    max: 5,
                    scroll: true,
                    autoFill: true,
                    mustMatch: true,
                    matchContains: false,
                    matchCase:true,
                    select:function( event, ui ){
                        $("#code").val(ui.item.label);
                        $("#codecmd").val(ui.item.value);
                        return false;
                    },
                    response: function( event, ui ) {
                    }
                };
                //添加autocomplete
                if($("#code")){
                    $("#code").autocomplete(options);
                }
            }
        });



    }
}

$(document).ready(function(){
    commonC.init();
})
