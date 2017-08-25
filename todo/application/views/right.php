<div class="content col-md-10 col-sm-10 col-xs-12" style="float:right;">
    <br>
    <div class="container-fluid">
        <h3 class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" align="center"><strong>Activities</strong></h3>
        <?php if(isset($item)):?>
        <center>
            <p style="font-size:16px;"><br>---------------------------------------------------------------------------------------------<br><br>
                <?php echo $item->description;?><br><br>
                <?php echo get_date($item->created_at);?><br>
            </p>
        </center>
        <?php endif;?>
        <a class="btn btn-default" href="<?php echo base_url('admin_category/');?>" role="button" style="float: right">Admin</a>
    </div>
</div>