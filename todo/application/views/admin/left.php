<div id="leftSide" style="padding-top:30px;">

    <!-- Account panel -->

    <div class="sideProfile">
        <a href="#" title="" class="profileFace"><img src="<?php echo public_url();?>/admin/images/user.png" width="40"></a>
        <span>Hello: <strong>admin</strong></span>
        <span>Võ Tuấn Khôi</span>
        <div class="clear"></div>
    </div>
    <div class="sidebarSep"></div>
    <!-- Left navigation -->

    <ul id="menu" class="nav">

        <li class="tran">

            <a href="admin/tran.html" class="exp inactive">
                <span>Management</span>
                <strong>2</strong>
            </a>

            <ul class="sub" style="display: none;">
                <li>
                    <a href="<?php echo base_url('admin_category');?>">
                        Category
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin_item');?>">
                        Item
                    </a>
                </li>
            </ul>

        </li>

    </ul>

</div>

<div class="clear">

</div>