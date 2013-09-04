<div class="container-fluid">
    <?php if($data):?>
        <?php foreach($data as $item):?>
            <div class="row-fluid">
                <?php foreach($item as $key=>$subitem):?>
                 <button value="<?php echo $subitem;?>" class="span4 btn  btn-success btn-large"><?php echo $key;?></button>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="row-fluid">
        <div class="alert alert-success" id="msgtips"></div>
    </div>
</div>