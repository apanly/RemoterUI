<style type="text/css">
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
        /* IE 6 doesn't support max-height
        * we use height instead, but this forces the menu to always be this tall
        */
    * html .ui-autocomplete {
        height: 100px;
    }
</style>
<div class="container-fluid" style="margin: 0 auto;padding:  0 0 ;">
    <div class="row-fluid"  id="msg">

    </div>
    <div class="row-fluid" style="text-align: center;">
        <form class="form-inline" onsubmit="return false;">
        编码:<input type="hidden" id="codecmd"/>
            <input type="text" id="code" placeholder="请输入发射关键字"/>
            <input type="button" class="btn" value="发送" id="command"/>
        </form>
    </div>
</div>