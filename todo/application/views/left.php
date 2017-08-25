<style>
    #catalog {
        color: #003399;
        padding-left: 10px;
        font-size: 30px;
    }
</style>
<div class="sidebar col-md-2 col-sm-2 col-xs-12" style="float:left;">
    <!--sidebar-->
    <div class="panel-group" id="accordion" style="background:#F2F2F2;">
        <div><br></div>
        <div id="catalog">Items</div>  <div><br></div>
        <?php if(isset($item_list)):?>
            <?php foreach ($item_list as $row):?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title" style="font-size: 14px;">
                        <a data-parent="#accordion" href="<?php echo base_url('item/view/'.$id.'/'.$row->id)?>"><?php echo $row->title;?></a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>